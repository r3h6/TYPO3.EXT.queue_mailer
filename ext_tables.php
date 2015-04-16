<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'MONOGON.' . $_EXTKEY,
		'user',	 // Make module a submodule of 'user'
		'mail',	// Submodule key
		'',						// Position
		array(
			'Mail' => 'list',

		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mail.xlf',
		)
	);

}

// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Queue Mailer');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_queuemailer_domain_model_mail', 'EXT:queue_mailer/Resources/Private/Language/locallang_csh_tx_queuemailer_domain_model_mail.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_queuemailer_domain_model_mail');
$GLOBALS['TCA']['tx_queuemailer_domain_model_mail'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_queuemailer_domain_model_mail',
		'label' => 'mail_subject',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'enablecolumns' => array(

		),
		'searchFields' => 'mail_subject,mail_to,mail_cc,mail_bcc,mail_from,mail_reply_to,mail_message,mail_date,failed_recipients,sent,variables,variables_key_hash,is_dummy_record,attachments,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Mail.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_queuemailer_domain_model_mail.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_queuemailer_domain_model_attachment', 'EXT:queue_mailer/Resources/Private/Language/locallang_csh_tx_queuemailer_domain_model_attachment.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_queuemailer_domain_model_attachment');
$GLOBALS['TCA']['tx_queuemailer_domain_model_attachment'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_queuemailer_domain_model_attachment',
		'label' => 'identifier',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'enablecolumns' => array(

		),
		'searchFields' => 'identifier,name,size,data,is_dummy_record,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Attachment.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_queuemailer_domain_model_attachment.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_queuemailer_domain_model_pendingmessage', 'EXT:queue_mailer/Resources/Private/Language/locallang_csh_tx_queuemailer_domain_model_pendingmessage.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_queuemailer_domain_model_pendingmessage');
$GLOBALS['TCA']['tx_queuemailer_domain_model_pendingmessage'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_queuemailer_domain_model_pendingmessage',
		'label' => 'message',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'enablecolumns' => array(

		),
		'searchFields' => 'message,scheduled,is_dummy_record,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/PendingMessage.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_queuemailer_domain_model_pendingmessage.gif'
	),
);
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

if (TYPO3_MODE == 'BE') {
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = 'MONOGON\\QueueMailer\\Command\\QueueCommandController';
}