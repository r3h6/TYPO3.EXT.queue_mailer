<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

if (\MONOGON\QueueMailer\Configuration\ExtConf::get('queueAllMessages') || \MONOGON\QueueMailer\Configuration\ExtConf::get('logAllMessages')){
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Core\\Mail\\Mailer'] = array(
	 'className' => 'MONOGON\\QueueMailer\\Mail\\Mailer'
	);
}

$GLOBALS['TYPO3_CONF_VARS']['LOG']['MONOGON']['QueueMailer']['writerConfiguration'] = array(
	\TYPO3\CMS\Core\Log\LogLevel::DEBUG => array(
		'TYPO3\\CMS\\Core\\Log\\Writer\\FileWriter' => array(
			'logFile' => 'typo3temp/logs/tx_queuemailer.log',
		),
	),
);
