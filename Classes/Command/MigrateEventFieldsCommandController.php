<?php
namespace BeechIt\NewsTtnewsimport\Command;

use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class MigrateEventFieldsCommandController extends CommandController
{
    public function migrateCommand()
    {
        $result = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*',
            'tx_news_domain_model_news',
            'import_source = "TT_NEWS_IMPORT"',
            '',
            'import_id ASC'
        );

        $results = [];
        while ($newsRecord = $result->fetch_assoc()) {
            $oldResult = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*',
                'tt_news',
                'uid = "' . $newsRecord['import_id'] . '"',
                ''
            );

            $oldNewsRecord = $oldResult->fetch_assoc();

            $fieldsToBeUpdated = [
                'tx_aunewsevent_from' => $oldNewsRecord['tx_aunewsevent_from'],
                'tx_aunewsevent_to' => $oldNewsRecord['tx_aunewsevent_to'],
                'tx_aunewsevent_where' => $oldNewsRecord['tx_aunewsevent_where'],
                'tx_aunewsevent_organizer' => $oldNewsRecord['tx_aunewsevent_organizer'],
                'tx_aunewsevent_organizer_email' => $oldNewsRecord['tx_aunewsevent_organizer_email'],
                'tx_aunewsevent_regfrom' => $oldNewsRecord['tx_aunewsevent_regfrom'],
                'tx_aunewsevent_regto' => $oldNewsRecord['tx_aunewsevent_regto'],
                'tx_aunewsevent_regurl' => $oldNewsRecord['tx_aunewsevent_regurl'],
                'tx_aunewsevent_preview_end' => $oldNewsRecord['tx_aunewsevent_preview_end'],
                'tx_aunewsevent_preview_hash' => $oldNewsRecord['tx_aunewsevent_preview_hash'],
                'tx_aunewsevent_showyear' => $oldNewsRecord['tx_aunewsevent_showyear'],
                'tx_lfaunewsserver_emne' => $oldNewsRecord['tx_lfaunewsserver_emne']
            ];

            $GLOBALS['TYPO3_DB']->exec_UPDATEquery(
                'tx_news_domain_model_news',
                'uid = ' . $newsRecord['uid'],
                $fieldsToBeUpdated
            );
        }
    }
}
