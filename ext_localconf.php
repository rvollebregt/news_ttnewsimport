<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

if (TYPO3_MODE === 'BE') {
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = 'BeechIt\\NewsTtnewsimport\\Command\\TtNewsPluginMigrateCommandController';
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = 'BeechIt\\NewsTtnewsimport\\Command\\MigrateEventFieldsCommandController';
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = 'BeechIt\\NewsTtnewsimport\\Command\\MigrateBodytextFileLinksCommandController';
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = 'BeechIt\\NewsTtnewsimport\\Command\\MigrateSharedNewsFilesCommandController';
}