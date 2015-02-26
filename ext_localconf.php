<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

if (\MONOGON\QueueMailer\Configuration\ExtConf::get('xclassMailMessage')){
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Core\\Mail\\MailMessage'] = array(
	 'className' => 'MONOGON\\QueueMailer\\Mail\\MailMessage'
	);
}

// $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['MONOGON\\QueueMailer\\Command\\QueueCommand'] = array(
// 	'extension' => $_EXTKEY,
// 	'title' => 'Mail Queue',
// 	'description' => 'Sending queued mail messages.',
// );
//
