<?php
namespace MONOGON\QueueMailer\Domain\Model\Dto;

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
class MailDemand extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	const SENT_SUCCESS = 1;
	const SENT_FAILURE = 0;
	const FAILED_RECIPIENTS_NONE = 0;
	const FAILED_RECIPIENTS_YES = 1;

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
	 * @var int
	 */
	protected $failedRecipients = NULL;

	/**
	 * Sent
	 *
	 * @var int
	 */
	protected $sent = NULL;

	/**
	 * Variables key hash
	 *
	 * @var string
	 */
	protected $variablesKeyHash = '';

	/**
	 * [$search description]
	 * @var string
	 */
	protected $search = '';

	/**
	 * [$pid description]
	 * @var int
	 */
	protected $pid;

	/**
	 * [$depth description]
	 * @var int
	 */
	protected $depth = 1;

	/**
	 * Returns the subject
	 *
	 * @return [type] $subject
	 */
	public function getSubject(){
		return $this->subject;
	}

	/**
	 * Sets the subject
	 *
	 * @param [type] $subject
	 * @return object $this
	 */
	public function setSubject($subject){
		$this->subject = $subject;
		return $this;
	}

	/**
	 * Returns the recipients
	 *
	 * @return [type] $recipients
	 */
	public function getRecipients(){
		return $this->recipients;
	}

	/**
	 * Sets the recipients
	 *
	 * @param [type] $recipients
	 * @return object $this
	 */
	public function setRecipients($recipients){
		$this->recipients = $recipients;
		return $this;
	}

	/**
	 * Returns the sender
	 *
	 * @return [type] $sender
	 */
	public function getSender(){
		return $this->sender;
	}

	/**
	 * Sets the sender
	 *
	 * @param [type] $sender
	 * @return object $this
	 */
	public function setSender($sender){
		$this->sender = $sender;
		return $this;
	}

	/**
	 * Returns the message
	 *
	 * @return [type] $message
	 */
	public function getMessage(){
		return $this->message;
	}

	/**
	 * Sets the message
	 *
	 * @param [type] $message
	 * @return object $this
	 */
	public function setMessage($message){
		$this->message = $message;
		return $this;
	}

	/**
	 * Returns the failedRecipients
	 *
	 * @return [type] $failedRecipients
	 */
	public function getFailedRecipients(){
		return $this->failedRecipients;
	}

	/**
	 * Sets the failedRecipients
	 *
	 * @param [type] $failedRecipients
	 * @return object $this
	 */
	public function setFailedRecipients($failedRecipients){
		$this->failedRecipients = $failedRecipients;
		return $this;
	}

	/**
	 * Returns the sent
	 *
	 * @return [type] $sent
	 */
	public function getSent(){
		return $this->sent;
	}

	/**
	 * Sets the sent
	 *
	 * @param [type] $sent
	 * @return object $this
	 */
	public function setSent($sent){
		$this->sent = $sent;
		return $this;
	}

	/**
	 * Returns the variablesKeyHash
	 *
	 * @return [type] $variablesKeyHash
	 */
	public function getVariablesKeyHash(){
		return $this->variablesKeyHash;
	}

	/**
	 * Sets the variablesKeyHash
	 *
	 * @param [type] $variablesKeyHash
	 * @return object $this
	 */
	public function setVariablesKeyHash($variablesKeyHash){
		$this->variablesKeyHash = $variablesKeyHash;
		return $this;
	}

	/**
	 * Returns the search
	 *
	 * @return [type] $search
	 */
	public function getSearch(){
		return $this->search;
	}

	/**
	 * Sets the search
	 *
	 * @param [type] $search
	 * @return object $this
	 */
	public function setSearch($search){
		$this->search = $search;
		return $this;
	}

	/**
	 * Returns the pid
	 *
	 * @return [type] $pid
	 */
	public function getPid(){
		return $this->pid;
	}

	/**
	 * Sets the pid
	 *
	 * @param [type] $pid
	 * @return object $this
	 */
	public function setPid($pid){
		$this->pid = $pid;
		return $this;
	}

	/**
	 * Returns the depth
	 *
	 * @return [type] $depth
	 */
	public function getDepth(){
		return $this->depth;
	}

	/**
	 * Sets the depth
	 *
	 * @param [type] $depth
	 * @return object $this
	 */
	public function setDepth($depth){
		$this->depth = $depth;
		return $this;
	}
}