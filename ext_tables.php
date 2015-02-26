<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Queue Mailer');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_maillog_domain_model_mail', 'EXT:queue_mailer/Resources/Private/Language/locallang_csh_tx_maillog_domain_model_mail.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_maillog_domain_model_mail');
$GLOBALS['TCA']['tx_maillog_domain_model_mail'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_maillog_domain_model_mail',
		'label' => 'mail_subject',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'enablecolumns' => array(

		),
		'searchFields' => 'mail_subject,mail_to,mail_cc,mail_bcc,mail_from,mail_reply_to,mail_message,mail_date,is_dummy_record,attachments,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Mail.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_maillog_domain_model_mail.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_maillog_domain_model_attachment', 'EXT:queue_mailer/Resources/Private/Language/locallang_csh_tx_maillog_domain_model_attachment.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_maillog_domain_model_attachment');
$GLOBALS['TCA']['tx_maillog_domain_model_attachment'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_maillog_domain_model_attachment',
		'label' => 'file',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'enablecolumns' => array(

		),
		'searchFields' => 'file,size,data,is_dummy_record,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Attachment.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_maillog_domain_model_attachment.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_maillog_domain_model_pendingmessage', 'EXT:queue_mailer/Resources/Private/Language/locallang_csh_tx_maillog_domain_model_pendingmessage.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_maillog_domain_model_pendingmessage');
$GLOBALS['TCA']['tx_maillog_domain_model_pendingmessage'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_maillog_domain_model_pendingmessage',
		'label' => 'message',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'enablecolumns' => array(

		),
		'searchFields' => 'message,scheduled,is_dummy_record,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/PendingMessage.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_maillog_domain_model_pendingmessage.gif'
	),
);


if (TYPO3_MODE == 'BE') {
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = 'MONOGON\\QueueMailer\\Command\\QueueCommandController';
}