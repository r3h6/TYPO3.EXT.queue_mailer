<?php
namespace MONOGON\QueueMailer\Domain\Model;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 R3 H6 <r3h6@outlook.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Mail
 */
class Mail extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Subject
	 *
	 * @var string
	 */
	protected $subject = '';

	/**
	 * Recipients (to)
	 *
	 * @var string
	 */
	protected $recipients = '';

	/**
	 * Sender (from)
	 *
	 * @var string
	 */
	protected $sender = '';

	/**
	 * Message
	 *
	 * @var string
	 */
	protected $message = '';

	/**
	 * Failed recipients
	 *
	 * @var string
	 */
	protected $failedRecipients = '';

	/**
	 * Sent
	 *
	 * @var integer
	 */
	protected $sent = 0;

	/**
	 * Variables
	 *
	 * @var string
	 */
	protected $variables = '';

	/**
	 * Variables key hash
	 *
	 * @var string
	 */
	protected $variablesKeyHash = '';

	/**
	 * Attachments
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\MONOGON\QueueMailer\Domain\Model\Attachment>
	 * @cascade remove
	 */
	protected $attachments = NULL;

	/**
	 * Source
	 *
	 * @var string
	 */
	protected $source = '';

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->attachments = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Adds a Attachment
	 *
	 * @param \MONOGON\QueueMailer\Domain\Model\Attachment $attachment
	 * @return void
	 */
	public function addAttachment(\MONOGON\QueueMailer\Domain\Model\Attachment $attachment) {
		$this->attachments->attach($attachment);
	}

	/**
	 * Removes a Attachment
	 *
	 * @param \MONOGON\QueueMailer\Domain\Model\Attachment $attachmentToRemove The Attachment to be removed
	 * @return void
	 */
	public function removeAttachment(\MONOGON\QueueMailer\Domain\Model\Attachment $attachmentToRemove) {
		$this->attachments->detach($attachmentToRemove);
	}

	/**
	 * Returns the attachments
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\MONOGON\QueueMailer\Domain\Model\Attachment> $attachments
	 */
	public function getAttachments() {
		return $this->attachments;
	}

	/**
	 * Sets the attachments
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\MONOGON\QueueMailer\Domain\Model\Attachment> $attachments
	 * @return void
	 */
	public function setAttachments(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $attachments) {
		$this->attachments = $attachments;
	}

	/**
	 * Returns the boolean state of isDummyRecord
	 *
	 * @return boolean
	 */
	public function isIsDummyRecord() {
		return $this->isDummyRecord;
	}

	/**
	 * Returns the failedRecipients
	 *
	 * @return string $failedRecipients
	 */
	public function getFailedRecipients() {
		return $this->failedRecipients;
	}

	/**
	 * Sets the failedRecipients
	 *
	 * @param string $failedRecipients
	 * @return void
	 */
	public function setFailedRecipients($failedRecipients) {
		$this->failedRecipients = $failedRecipients;
	}

	/**
	 * Returns the sent
	 *
	 * @return integer $sent
	 */
	public function getSent() {
		return $this->sent;
	}

	/**
	 * Sets the sent
	 *
	 * @param integer $sent
	 * @return void
	 */
	public function setSent($sent) {
		$this->sent = $sent;
	}

	/**
	 * Returns the variables
	 *
	 * @return array $variables
	 */
	public function getVariables() {
		$variables = unserialize($this->variables);
		if (is_array($variables)) {
			return $variables;
		}
		return array();
	}

	/**
	 * Sets the variables
	 *
	 * @param array $variables
	 * @return void
	 */
	public function setVariables(array $variables) {
		$this->variables = empty($variables) ? '' : serialize($variables);
		$this->updateVariablesKeyHash();
	}

	/**
	 * Returns the variablesKeyHash
	 *
	 * @return string $variablesKeyHash
	 */
	public function getVariablesKeyHash() {
		return $this->variablesKeyHash;
	}

	/**
	 * Sets the variablesKeyHash
	 *
	 * @param string $variablesKeyHash
	 * @return void
	 */
	public function setVariablesKeyHash($variablesKeyHash = NULL) {
		// $this->variablesKeyHash = $variablesKeyHash;
		$this->updateVariablesKeyHash();
	}

	protected function updateVariablesKeyHash() {
		$this->variablesKeyHash = '';
		$variables = $this->getVariables();
		if (is_array($variables) && count($variables)) {
			$keys = array_keys($variables);
			sort($keys);
			$this->variablesKeyHash = md5(join(',', $keys));
		}
	}

	/**
	 * Returns the subject
	 *
	 * @return string subject
	 */
	public function getSubject() {
		return $this->subject;
	}

	/**
	 * Sets the subject
	 *
	 * @param string $subject
	 * @return string subject
	 */
	public function setSubject($subject) {
		$this->subject = $subject;
	}

	/**
	 * Returns the recipients
	 *
	 * @return string recipients
	 */
	public function getRecipients() {
		return $this->recipients;
	}

	/**
	 * Sets the recipients
	 *
	 * @param string $recipients
	 * @return string recipients
	 */
	public function setRecipients($recipients) {
		$this->recipients = $recipients;
	}

	/**
	 * Returns the sender
	 *
	 * @return string sender
	 */
	public function getSender() {
		return $this->sender;
	}

	/**
	 * Sets the sender
	 *
	 * @param string $sender
	 * @return string sender
	 */
	public function setSender($sender) {
		$this->sender = $sender;
	}

	/**
	 * Returns the message
	 *
	 * @return string message
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * Sets the message
	 *
	 * @param string $message
	 * @return string message
	 */
	public function setMessage($message) {
		$this->message = $message;
	}

	/**
	 * Returns the source
	 *
	 * @return string $source
	 */
	public function getSource() {
		return $this->source;
	}

	/**
	 * Sets the source
	 *
	 * @param string $source
	 * @return void
	 */
	public function setSource($source) {
		$this->source = $source;
	}

}