#
# Table structure for table 'tx_queuemailer_domain_model_mail'
#
CREATE TABLE tx_queuemailer_domain_model_mail (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	mail_subject varchar(255) DEFAULT '' NOT NULL,
	mail_to text NOT NULL,
	mail_cc text NOT NULL,
	mail_bcc text NOT NULL,
	mail_from varchar(255) DEFAULT '' NOT NULL,
	mail_reply_to varchar(255) DEFAULT '' NOT NULL,
	mail_message text NOT NULL,
	mail_date int(11) DEFAULT '0' NOT NULL,
	failed_recipients text NOT NULL,
	sent int(11) DEFAULT '0' NOT NULL,
	variables text NOT NULL,
	variables_key_hash varchar(255) DEFAULT '' NOT NULL,
	is_dummy_record tinyint(1) unsigned DEFAULT '0' NOT NULL,
	attachments int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),

);

#
# Table structure for table 'tx_queuemailer_domain_model_attachment'
#
CREATE TABLE tx_queuemailer_domain_model_attachment (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	mail int(11) unsigned DEFAULT '0' NOT NULL,

	identifier varchar(255) DEFAULT '' NOT NULL,
	name tinyint(1) unsigned DEFAULT '0' NOT NULL,
	size int(11) DEFAULT '0' NOT NULL,
	data text NOT NULL,
	is_dummy_record tinyint(1) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),

);

#
# Table structure for table 'tx_queuemailer_domain_model_pendingmessage'
#
CREATE TABLE tx_queuemailer_domain_model_pendingmessage (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	message text NOT NULL,
	scheduled int(11) DEFAULT '0' NOT NULL,
	is_dummy_record tinyint(1) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),

);

#
# Table structure for table 'tx_queuemailer_domain_model_attachment'
#
CREATE TABLE tx_queuemailer_domain_model_attachment (

	mail  int(11) unsigned DEFAULT '0' NOT NULL,

);

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder

#
# Table structure for table 'tx_queuemailer_domain_model_mail'
#
CREATE TABLE tx_queuemailer_domain_model_mail (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	mail_subject varchar(255) DEFAULT '' NOT NULL,
	mail_to text NOT NULL,
	mail_cc text NOT NULL,
	mail_bcc text NOT NULL,
	mail_from varchar(255) DEFAULT '' NOT NULL,
	mail_reply_to varchar(255) DEFAULT '' NOT NULL,
	mail_message text NOT NULL,
	mail_date int(11) DEFAULT '0' NOT NULL,
	is_dummy_record tinyint(1) unsigned DEFAULT '0' NOT NULL,
	failed_recipients text NOT NULL,
	sent int(11) DEFAULT '0' NOT NULL,
	attachments int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY phpunit_dummy (is_dummy_record),

);

#
# Table structure for table 'tx_queuemailer_domain_model_attachment'
#
CREATE TABLE tx_queuemailer_domain_model_attachment (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	mail int(11) unsigned DEFAULT '0' NOT NULL,

	file varchar(255) DEFAULT '' NOT NULL,
	size int(11) DEFAULT '0' NOT NULL,
	data text NOT NULL,
	is_dummy_record tinyint(1) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY phpunit_dummy (is_dummy_record),

);

#
# Table structure for table 'tx_queuemailer_domain_model_pendingmessage'
#
CREATE TABLE tx_queuemailer_domain_model_pendingmessage (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	message text NOT NULL,
	scheduled int(11) DEFAULT '0' NOT NULL,
	is_dummy_record tinyint(1) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY phpunit_dummy (is_dummy_record),

);

#
# Table structure for table 'tx_queuemailer_domain_model_attachment'
#
CREATE TABLE tx_queuemailer_domain_model_attachment (

	mail  int(11) unsigned DEFAULT '0' NOT NULL,

);