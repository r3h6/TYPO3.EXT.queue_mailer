#
# Table structure for table 'tx_queuemailer_domain_model_mail'
#
CREATE TABLE tx_queuemailer_domain_model_mail (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	subject varchar(255) DEFAULT '' NOT NULL,
	recipients text NOT NULL,
	sender varchar(255) DEFAULT '' NOT NULL,
	message text NOT NULL,
	failed_recipients text NOT NULL,
	sent int(11) DEFAULT '0' NOT NULL,
	variables text NOT NULL,
	variables_key_hash varchar(255) DEFAULT '' NOT NULL,
	source text NOT NULL,
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
	name varchar(255) DEFAULT '' NOT NULL,
	size int(11) DEFAULT '0' NOT NULL,
	data text NOT NULL,

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