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
	protected $mailSubject = '';

	/**
	 * To
	 *
	 * @var string
	 */
	protected $mailTo = '';

	/**
	 * CC
	 *
	 * @var string
	 */
	protected $mailCc = '';

	/**
	 * BCC
	 *
	 * @var string
	 */
	protected $mailBcc = '';

	/**
	 * From
	 *
	 * @var string
	 */
	protected $mailFrom = '';

	/**
	 * Reply to
	 *
	 * @var string
	 */
	protected $mailReplyTo = '';

	/**
	 * message
	 *
	 * @var string
	 */
	protected $mailMessage = '';

	/**
	 * Send time
	 *
	 * @var \DateTime
	 */
	protected $mailDate = NULL;

	/**
	 * isDummyRecord
	 *
	 * @var boolean
	 */
	protected $isDummyRecord = FALSE;

	/**
	 * Attachments
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\MONOGON\QueueMailer\Domain\Model\Attachment>
	 * @cascade remove
	 */
	protected $attachments = NULL;

	/**
	 * failedRecipients
	 *
	 * @var string
	 */
	protected $failedRecipients = '';

	/**
	 * sent
	 *
	 * @var integer
	 */
	protected $sent = 0;

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
	 * Returns the mailSubject
	 *
	 * @return string mailSubject
	 */
	public function getMailSubject() {
		return $this->mailSubject;
	}

	/**
	 * Sets the mailSubject
	 *
	 * @param string $mailSubject
	 * @return string mailSubject
	 */
	public function setMailSubject($mailSubject) {
		$this->mailSubject = $mailSubject;
	}

	/**
	 * Returns the mailTo
	 *
	 * @return string mailTo
	 */
	public function getMailTo() {
		return $this->mailTo;
	}

	/**
	 * Sets the mailTo
	 *
	 * @param string $mailTo
	 * @return string mailTo
	 */
	public function setMailTo($mailTo) {
		$this->mailTo = $mailTo;
	}

	/**
	 * Returns the mailCc
	 *
	 * @return string mailCc
	 */
	public function getMailCc() {
		return $this->mailCc;
	}

	/**
	 * Sets the mailCc
	 *
	 * @param string $mailCc
	 * @return string mailCc
	 */
	public function setMailCc($mailCc) {
		$this->mailCc = $mailCc;
	}

	/**
	 * Returns the mailBcc
	 *
	 * @return string mailBcc
	 */
	public function getMailBcc() {
		return $this->mailBcc;
	}

	/**
	 * Sets the mailBcc
	 *
	 * @param string $mailBcc
	 * @return string mailBcc
	 */
	public function setMailBcc($mailBcc) {
		$this->mailBcc = $mailBcc;
	}

	/**
	 * Returns the mailFrom
	 *
	 * @return string mailFrom
	 */
	public function getMailFrom() {
		return $this->mailFrom;
	}

	/**
	 * Sets the mailFrom
	 *
	 * @param string $mailFrom
	 * @return string mailFrom
	 */
	public function setMailFrom($mailFrom) {
		$this->mailFrom = $mailFrom;
	}

	/**
	 * Returns the mailReplyTo
	 *
	 * @return string mailReplyTo
	 */
	public function getMailReplyTo() {
		return $this->mailReplyTo;
	}

	/**
	 * Sets the mailReplyTo
	 *
	 * @param string $mailReplyTo
	 * @return string mailReplyTo
	 */
	public function setMailReplyTo($mailReplyTo) {
		$this->mailReplyTo = $mailReplyTo;
	}

	/**
	 * Returns the mailMessage
	 *
	 * @return string mailMessage
	 */
	public function getMailMessage() {
		return $this->mailMessage;
	}

	/**
	 * Sets the mailMessage
	 *
	 * @param string $mailMessage
	 * @return string mailMessage
	 */
	public function setMailMessage($mailMessage) {
		$this->mailMessage = $mailMessage;
	}

	/**
	 * Returns the mailDate
	 *
	 * @return \DateTime mailDate
	 */
	public function getMailDate() {
		return $this->mailDate;
	}

	/**
	 * Sets the mailDate
	 *
	 * @param \DateTime $mailDate
	 * @return \DateTime mailDate
	 */
	public function setMailDate(\DateTime $mailDate) {
		$this->mailDate = $mailDate;
	}

	/**
	 * Returns the isDummyRecord
	 *
	 * @return boolean $isDummyRecord
	 */
	public function getIsDummyRecord() {
		return $this->isDummyRecord;
	}

	/**
	 * Sets the isDummyRecord
	 *
	 * @param boolean $isDummyRecord
	 * @return void
	 */
	public function setIsDummyRecord($isDummyRecord) {
		$this->isDummyRecord = $isDummyRecord;
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

}