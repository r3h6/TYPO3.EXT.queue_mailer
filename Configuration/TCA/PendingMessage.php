<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_queuemailer_domain_model_pendingmessage'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_queuemailer_domain_model_pendingmessage']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'message, scheduled, is_dummy_record',
	),
	'types' => array(
		'1' => array('showitem' => 'message, scheduled, is_dummy_record, '),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(

		'message' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_queuemailer_domain_model_pendingmessage.message',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'scheduled' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_queuemailer_domain_model_pendingmessage.scheduled',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'datetime',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'is_dummy_record' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_queuemailer_domain_model_pendingmessage.is_dummy_record',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		
	),
);
## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder