<?php
namespace BeechIt\NewsTtnewsimport\Command;

use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;

class MigrateSharedNewsFilesCommandController extends CommandController
{
    public function migrateCommand()
    {
        /** @var $logger \TYPO3\CMS\Core\Log\Logger */
        $logger = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Log\\LogManager')->getLogger(__CLASS__);

        /** @var DatabaseConnection $databaseConnection */
        $databaseConnection = $GLOBALS['TYPO3_DB'];

        $result = $databaseConnection->sql_query(
            'SELECT ref.* FROM sys_file_reference AS ref JOIN sys_file AS file ON ref.uid_local = file.uid WHERE tablenames = "tx_news_domain_model_news" AND ref.deleted = 0 AND file.identifier NOT LIKE "/news_import%";'
        );

        $resourceFactory = ResourceFactory::getInstance();
        $folder = $resourceFactory->getFolderObjectFromCombinedIdentifier('1:/news_import');

        while ($row = $result->fetch_assoc()) {
            try {
                $file = $resourceFactory->getFileObject($row['uid_local']);

                if ($file instanceof File) {
                    $file->moveTo($folder);
                }
            } catch (\Exception $e) {
                $logger->error('sys_file UID ' . $row['uid_local'] . ': ' . $e->getMessage());
            }
        }
    }
}
