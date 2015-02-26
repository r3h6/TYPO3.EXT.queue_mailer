<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_maillog_domain_model_attachment'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_maillog_domain_model_attachment']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'file, size, data, is_dummy_record',
	),
	'types' => array(
		'1' => array('showitem' => 'file, size, data, is_dummy_record, '),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(

		'file' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_maillog_domain_model_attachment.file',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'size' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_maillog_domain_model_attachment.size',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'data' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_maillog_domain_model_attachment.data',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'is_dummy_record' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_maillog_domain_model_attachment.is_dummy_record',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),

		'mail' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder