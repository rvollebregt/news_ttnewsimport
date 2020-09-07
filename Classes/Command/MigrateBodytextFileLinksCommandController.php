<?php
namespace BeechIt\NewsTtnewsimport\Command;

use GeorgRinger\News\Utility\EmConfiguration;
use TYPO3\CMS\Core\Resource\Exception\FileDoesNotExistException;
use TYPO3\CMS\Core\Resource\Exception\ResourceDoesNotExistException;
use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;

/**
 * Class MigrateRteFileLinksCommandController
 */
class MigrateBodytextFileLinksCommandController extends CommandController
{
    /**
     * @var \GeorgRinger\News\Domain\Model\Dto\EmConfiguration
     */
    protected $emSettings;

    /**
     * @var \TYPO3\CMS\Core\Resource\Folder
     */
    protected $importFolder;

    /**
     * @var string
     */
    protected $regularExpression = '#
            (?\'tag\'<link\\s++(?\'typolink\'[^>]+)>)
            (?\'content\'(?:[^<]++|<(?!/link>))*+)
            </link>
            #xumsi';

    /**
     * @var string
     */
    protected $tableName = 'tx_news_domain_model_news';

    /**
     * Migrate
     */
    public function migrateCommand()
    {
        $this->emSettings = EmConfiguration::getSettings();

        $newsRecords = $this->getDatabaseConnection()->exec_SELECTgetRows(
            'uid,bodytext',
            $this->tableName,
            ''
        );
        foreach ($newsRecords as $record) {
            $bodytext = $record['bodytext'];
            if (stripos($bodytext, '<link') !== false || stripos($bodytext, '&lt;link') !== false) {
                $bodytext = preg_replace_callback(
                    $this->regularExpression,
                    function ($matches) {
                        if ($this->isValidFileLink($matches['typolink'])) {
                            preg_match('/file:([\d]+)/', $matches['typolink'], $uidMatches);

                            if (isset($uidMatches[1])) {
                                $file = $this->getOldFile($uidMatches[1]);

                                if ($file instanceof FileInterface) {
                                    $existingFile = $this->getExistingFile($file);
                                    $replaceFile = $existingFile instanceof FileInterface
                                        ? $existingFile : $this->copyFile($file);
                                    if ($replaceFile instanceof FileInterface) {
                                        return str_replace(
                                            'file:' . $uidMatches[1],
                                            'file:' . $replaceFile->getUid(),
                                            $matches[0]
                                        );
                                    }
                                }
                            }
                        }
                        return $matches[0];
                    },
                    $bodytext
                );
                if ($bodytext !== $record['bodytext']) {
                    $this->getDatabaseConnection()->exec_UPDATEquery(
                        $this->tableName,
                        'uid=' . $record['uid'],
                        ['bodytext' => $bodytext]
                    );
                }
            }
        }
    }

    /**
     * @param $link
     * @return bool
     */
    protected function isValidFileLink($link)
    {
        return strpos($link, 'file:') === 0 && strpos($link, 'file://') === false;
    }

    /**
     * @param $uid
     * @return \TYPO3\CMS\Core\Resource\File|\TYPO3\CMS\Core\Resource\FileInterface|\TYPO3\CMS\Core\Resource\Folder|\TYPO3\CMS\Core\Resource\ProcessedFile|null
     */
    protected function getOldFile($uid)
    {
        try {
            return $this->getResourceFactory()->retrieveFileOrFolderObject($uid);
        } catch (FileDoesNotExistException $e) {
            return null;
        }
    }

    /**
     * @param $file
     * @return \TYPO3\CMS\Core\Resource\File|\TYPO3\CMS\Core\Resource\FileInterface|\TYPO3\CMS\Core\Resource\Folder|\TYPO3\CMS\Core\Resource\ProcessedFile|null
     */
    protected function getExistingFile($file)
    {
        try {
            return $this->getResourceFactory()->retrieveFileOrFolderObject(
                rtrim($this->getImportFolderIdentifier(), '/') . '/' . $file->getName()
            );
        } catch (ResourceDoesNotExistException $e) {
            return null;
        }
    }

    /**
     * @param $file
     * @return \TYPO3\CMS\Core\Resource\FileInterface|null
     * @throws \TYPO3\CMS\Core\Resource\Exception\AbstractFileOperationException
     * @throws \TYPO3\CMS\Core\Resource\Exception\ExistingTargetFileNameException
     */
    protected function copyFile($file)
    {
        try {
            return $this->getResourceStorage()->copyFile(
                $file,
                $this->getImportFolder()
            );
        } catch (\InvalidArgumentException $e) {
            return null;
        }
    }

    /**
     * @return \TYPO3\CMS\Core\Resource\Folder
     */
    protected function getImportFolder()
    {
        if ($this->importFolder === null) {
            $this->importFolder = $this->getResourceFactory()->getFolderObjectFromCombinedIdentifier($this->getImportFolderIdentifier());
        }
        return $this->importFolder;
    }

    /**
     * @return string
     */
    protected function getImportFolderIdentifier()
    {
        return $this->emSettings->getStorageUidImporter() . ':' . $this->emSettings->getResourceFolderImporter();
    }

    /**
     * @return \TYPO3\CMS\Core\Resource\ResourceStorage|null
     */
    protected function getResourceStorage()
    {
        return $this->getResourceFactory()->getStorageObject($this->emSettings->getStorageUidImporter());
    }

    /**
     * @return \TYPO3\CMS\Core\Resource\ResourceFactory
     */
    protected function getResourceFactory()
    {
        return ResourceFactory::getInstance();
    }

    /**
     * @return \TYPO3\CMS\Core\Database\DatabaseConnection
     */
    protected function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }
}
