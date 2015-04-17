<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_queuemailer_domain_model_attachment'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_queuemailer_domain_model_attachment']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'identifier, name, size, data',
	),
	'types' => array(
		'1' => array('showitem' => 'identifier, name, size, data, '),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(

		'identifier' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_queuemailer_domain_model_attachment.identifier',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_queuemailer_domain_model_attachment.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'size' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_queuemailer_domain_model_attachment.size',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'data' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:queue_mailer/Resources/Private/Language/locallang_db.xlf:tx_queuemailer_domain_model_attachment.data',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
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