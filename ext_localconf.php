<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE === 'BE') {
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = 'BeechIt\\NewsTtnewsimport\\Command\\TtNewsPluginMigrateCommandController';
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup('
    plugin.tx_news {
        persistence {
            classes {
                GeorgRinger\News\Domain\Model\News {
                    subclasses {
                        # three different classes are used for each news type
                        # 0 == default news
                        7 = BeechIt\NewsTtnewsimport\Domain\Model\Event
                        8 = BeechIt\NewsTtnewsimport\Domain\Model\EventInternal
                        9 = BeechIt\NewsTtnewsimport\Domain\Model\EventExternal
                    }
                }
                BeechIt\NewsTtnewsimport\Domain\Model\Event {
                    mapping {
                        recordType = 7
                        tableName = tx_news_domain_model_news
                        columns {
                            tx_aunewsevent_from.mapOnProperty = eventFrom
                            tx_aunewsevent_to.mapOnProperty = eventTo
                            tx_aunewsevent_where.mapOnProperty = eventWhere
                            tx_aunewsevent_organizer.mapOnProperty = eventOrganizer
                            tx_aunewsevent_organizer_email.mapOnProperty = eventOrganizerEmail
                            tx_aunewsevent_regfrom.mapOnProperty = eventRegfrom
                            tx_aunewsevent_regto.mapOnProperty = eventRegto
                            tx_aunewsevent_regurl.mapOnProperty = eventRegurl
                            tx_aunewsevent_preview_end.mapOnProperty = eventPreviewEnd
                            tx_aunewsevent_preview_hash.mapOnProperty = eventPreviewHash
                            tx_aunewsevent_showyear.mapOnProperty = eventShowyear
                        }
                    }
                }
                BeechIt\NewsTtnewsimport\Domain\Model\EventInternal {
                    mapping {
                        recordType = 8
                        tableName = tx_news_domain_model_news
                        columns {
                            tx_aunewsevent_from.mapOnProperty = eventFrom
                            tx_aunewsevent_to.mapOnProperty = eventTo
                            tx_aunewsevent_where.mapOnProperty = eventWhere
                            tx_aunewsevent_organizer.mapOnProperty = eventOrganizer
                            tx_aunewsevent_organizer_email.mapOnProperty = eventOrganizerEmail
                            tx_aunewsevent_regfrom.mapOnProperty = eventRegfrom
                            tx_aunewsevent_regto.mapOnProperty = eventRegto
                            tx_aunewsevent_regurl.mapOnProperty = eventRegurl
                            tx_aunewsevent_preview_end.mapOnProperty = eventPreviewEnd
                            tx_aunewsevent_preview_hash.mapOnProperty = eventPreviewHash
                            tx_aunewsevent_showyear.mapOnProperty = eventShowyear
                        }
                    }
                }
                BeechIt\NewsTtnewsimport\Domain\Model\EventExternal {
                    mapping {
                        recordType = 9
                        tableName = tx_news_domain_model_news
                        columns {
                            tx_aunewsevent_from.mapOnProperty = eventFrom
                            tx_aunewsevent_to.mapOnProperty = eventTo
                            tx_aunewsevent_where.mapOnProperty = eventWhere
                            tx_aunewsevent_organizer.mapOnProperty = eventOrganizer
                            tx_aunewsevent_organizer_email.mapOnProperty = eventOrganizerEmail
                            tx_aunewsevent_regfrom.mapOnProperty = eventRegfrom
                            tx_aunewsevent_regto.mapOnProperty = eventRegto
                            tx_aunewsevent_regurl.mapOnProperty = eventRegurl
                            tx_aunewsevent_preview_end.mapOnProperty = eventPreviewEnd
                            tx_aunewsevent_preview_hash.mapOnProperty = eventPreviewHash
                            tx_aunewsevent_showyear.mapOnProperty = eventShowyear
                        }
                    }
                }
            }
        }
    }
');
