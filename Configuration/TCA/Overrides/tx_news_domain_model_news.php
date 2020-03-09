<?php

$fields = [
    'tx_aunewsevent_from' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:au_newsevent/locallang_db.xlf:tt_news.tx_aunewsevent_from',
        'config' => [
            'type' => 'input',
            'size' => '12',
            'max' => '20',
            'eval' => 'datetime,required',
            'default' => '0'
        ]
    ],
    'tx_aunewsevent_to' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:au_newsevent/locallang_db.xlf:tt_news.tx_aunewsevent_to',
        'config' => [
            'type' => 'input',
            'size' => '12',
            'max' => '20',
            'eval' => 'datetime,required',
            'default' => '0'
        ]
    ],
    'tx_aunewsevent_regfrom' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:au_newsevent/locallang_db.xlf:tt_news.tx_aunewsevent_regfrom',
        'config' => [
            'type' => 'input',
            'size' => '12',
            'max' => '20',
            'eval' => 'datetime',
            'default' => '0'
        ]
    ],
    'tx_aunewsevent_regto' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:au_newsevent/locallang_db.xlf:tt_news.tx_aunewsevent_regto',
        'config' => [
            'type' => 'input',
            'size' => '12',
            'max' => '20',
            'eval' => 'datetime',
            'default' => '0'
        ]
    ],
    'tx_aunewsevent_regurl' => [
        'l10n_mode' => 'mergeIfNotBlank',
        'label' => 'LLL:EXT:au_newsevent/locallang_db.xlf:tt_news.tx_aunewsevent_regurl',
        'config' => [
            'type' => 'input',
            'size' => '48',
            'max' => '256',
            'wizards' => [
                '_PADDING' => 2,
                'link' => [
                    'type' => 'popup',
                    'title' => 'Link',
                    'icon' => 'link_popup.gif',
                    'module' => [
                        'name' => 'wizard_element_browser',
                        'urlParameters' => [
                            'mode' => 'wizard',
                            'act' => 'file'
                        ]
                    ],
                ]
            ]
        ]
    ],
    'tx_aunewsevent_where' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:au_newsevent/locallang_db.xlf:tt_news.tx_aunewsevent_where',
        'l10n_mode' => 'mergeIfNotBlank',
        'config' => [
            'type' => 'input',
            'size' => '48',
            'max' => '256',
        ]
    ],
    'tx_aunewsevent_organizer' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:au_newsevent/locallang_db.xlf:tt_news.tx_aunewsevent_organizer',
        'l10n_mode' => 'mergeIfNotBlank',
        'config' => [
            'type' => 'input',
            'size' => '48',
            'max' => '256',
        ]
    ],
    'tx_aunewsevent_organizer_email' => [
        'exclude' => 1,
        'l10n_mode' => 'mergeIfNotBlank',
        'label' => 'LLL:EXT:lang/locallang_general.php:LGL.email',
        'config' => [
            'type' => 'input',
            'size' => '20',
            'eval' => 'trim',
            'max' => '80'
        ]
    ],
    'tx_aunewsevent_preview_end' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:au_newsevent/locallang_db.xlf:tt_news.tx_aunewsevent_preview_end',
        'l10n_display' => 'hideDiff',
        'config' => [
            'type' => 'input',
            'size' => '12',
            'max' => '20',
            'eval' => 'datetime',
            'default' => strtotime('+1 week')
        ]
    ],
    'tx_aunewsevent_preview_hash' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:au_newsevent/locallang_db.xlf:tt_news.tx_aunewsevent_preview_hash',
        'l10n_mode' => 'exclude',
        'l10n_display' => 'defaultAsReadonly',
        'config' => [
            'type' => 'user',
            'userFunc' => 'tx_aunewsevent_tceforms->getPreviewLink'
        ]
    ],
    'tx_aunewsevent_showyear' => [
        'label' => 'LLL:EXT:au_newsevent/locallang_db.xlf:tt_news.tx_aunewsevent_showyear',
        'exclude' => 0,
        'config' => [
            'type' => 'check',
        ]
    ]
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tx_news_domain_model_news', $fields);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_news_domain_model_news',
    'tx_aunewsevent_from,tx_aunewsevent_to,tx_aunewsevent_regfrom,tx_aunewsevent_regto,tx_aunewsevent_regurl,tx_aunewsevent_where,tx_aunewsevent_organizer,tx_aunewsevent_organizer_email,tx_aunewsevent_preview_end,tx_aunewsevent_preview_hash,tx_aunewsevent_showyear'
);

$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['type']['config']['items']['7'] = ['event', 7] ;
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['type']['config']['items']['8'] = ['eventInternal', 8] ;
$GLOBALS['TCA']['tx_news_domain_model_news']['columns']['type']['config']['items']['9'] = ['eventExternal', 9] ;
