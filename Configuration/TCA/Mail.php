<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_queuemailer_domain_model_mail'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_queuemailer_domain_model_mail']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'subject, recipients, sender, message, failed_recipients, sent, variables, variables_key_hash, source, attachments',
	),
	'types' => array(
		'1' => array('showitem' => 'subject, recipients, sender, message, failed_recipients, sent, variables, variables_key_hash, source, attachments, '),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(

		'subject' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_queuemailer_domain_model_mail.subject',
			'config' => array(
				'readOnly' =>1,
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'recipients' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_queuemailer_domain_model_mail.recipients',
			'config' => array(
				'readOnly' =>1,
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'sender' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_queuemailer_domain_model_mail.sender',
			'config' => array(
				'readOnly' =>1,
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'message' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_queuemailer_domain_model_mail.message',
			'config' => array(
				'readOnly' =>1,
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'failed_recipients' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_queuemailer_domain_model_mail.failed_recipients',
			'config' => array(
				'readOnly' =>1,
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'sent' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_queuemailer_domain_model_mail.sent',
			'config' => array(
				'readOnly' =>1,
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'variables' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_queuemailer_domain_model_mail.variables',
			'config' => array(
				'readOnly' =>1,
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'variables_key_hash' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_queuemailer_domain_model_mail.variables_key_hash',
			'config' => array(
				'readOnly' =>1,
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'source' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_queuemailer_domain_model_mail.source',
			'config' => array(
				'readOnly' =>1,
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'attachments' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_queuemailer_domain_model_mail.attachments',
			'config' => array(
				'readOnly' =>1,
				'type' => 'inline',
				'foreign_table' => 'tx_queuemailer_domain_model_attachment',
				'foreign_field' => 'mail',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 0,
					'showPossibleLocalizationRecords' => 0,
					'showAllLocalizationLink' => 0,
					'enabledControls' => array(
						'new' => 0,
						'delete' => 0,
					),
				),
			),

		),

	),
);
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder