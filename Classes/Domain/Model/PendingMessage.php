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
 * PendingMessage
 */
class PendingMessage extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Message
	 *
	 * @var string
	 */
	protected $message = '';

	/**
	 * Scheduled time
	 *
	 * @var \DateTime
	 */
	protected $scheduled = NULL;

	/**
	 * isDummyRecord
	 *
	 * @var boolean
	 */
	protected $isDummyRecord = FALSE;

	/**
	 * Returns the unserialzed message
	 *
	 * @return \TYPO3\CMS\Core\Mail\MailMessage message
	 */
	public function getMessage() {
		$message = NULL;
		if ($this->message) {
			$message = unserialize($this->message);
		}
		return $message;
	}

	/**
	 * Serializes and sets the message
	 *
	 * @param \TYPO3\CMS\Core\Mail\MailMessage $message
	 * @return string message
	 */
	public function setMessage(\TYPO3\CMS\Core\Mail\MailMessage $message) {
		$this->message = serialize($message);
	}

	/**
	 * Returns the scheduled
	 *
	 * @return \DateTime $scheduled
	 */
	public function getScheduled() {
		return $this->scheduled;
	}

	/**
	 * Sets the scheduled
	 *
	 * @param \DateTime $scheduled
	 * @return void
	 */
	public function setScheduled(\DateTime $scheduled) {
		$this->scheduled = $scheduled;
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

}