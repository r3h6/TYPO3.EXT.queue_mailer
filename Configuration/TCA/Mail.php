<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_maillog_domain_model_mail'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_maillog_domain_model_mail']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'mail_subject, mail_to, mail_cc, mail_bcc, mail_from, mail_reply_to, mail_message, mail_date, is_dummy_record, failed_recipients, sent, attachments',
	),
	'types' => array(
		'1' => array('showitem' => 'mail_subject, mail_to, mail_cc, mail_bcc, mail_from, mail_reply_to, mail_message, mail_date, is_dummy_record, failed_recipients, sent, attachments, '),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(

		'mail_subject' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_maillog_domain_model_mail.mail_subject',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'mail_to' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_maillog_domain_model_mail.mail_to',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'mail_cc' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_maillog_domain_model_mail.mail_cc',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'mail_bcc' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_maillog_domain_model_mail.mail_bcc',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'mail_from' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_maillog_domain_model_mail.mail_from',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'mail_reply_to' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_maillog_domain_model_mail.mail_reply_to',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'mail_message' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_maillog_domain_model_mail.mail_message',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'mail_date' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_maillog_domain_model_mail.mail_date',
			'config' => array(
				'type' => 'input',
				'size' => 7,
				'eval' => 'date',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'is_dummy_record' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_maillog_domain_model_mail.is_dummy_record',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'failed_recipients' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_maillog_domain_model_mail.failed_recipients',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'sent' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_maillog_domain_model_mail.sent',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'attachments' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_maillog_domain_model_mail.attachments',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_maillog_domain_model_attachment',
				'foreign_field' => 'mail',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),

		),

	),
);
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder