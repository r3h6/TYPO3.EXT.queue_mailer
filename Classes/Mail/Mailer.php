<?php
namespace MONOGON\QueueMailer\Mail;

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

use Exception;
use Swift_Transport;
use Swift_Mime_Message;
use MONOGON\QueueMailer\Utility\MailUtility;
use MONOGON\QueueMailer\Configuration\ExtConf;
use MONOGON\QueueMailer\Exception\MessageSendException;


/**
 * Mailer
 */
class Mailer extends \TYPO3\CMS\Core\Mail\Mailer {

	/**
	 * @param Swift_Mime_Message $message
	 * @param array              $failedRecipients An array of failures by-reference
	 * @return integer
	 */
	public function send(Swift_Mime_Message $message, &$failedRecipients = null){
		if (ExtConf::get('queueAllMessages')){
			return $this->queue($message) ? 1: 0;
		}

		try {
			$this->emitBeforeSendMessage($message);
			$sent = parent::send($message, $failedRecipients);
		} catch (Exception $exception){
			$sent = 0;
			$this->getLogger()->error("Could not send message because " . $exception->getMessage(), array($message->getTo(), $message->getSubject(), $message->getBody()));
		}

		$this->emitAfterSendMessage($message);

		if (ExtConf::get('logAllMessages') || ($message instanceof \MONOGON\QueueMailer\Mail\TemplateMailMessage)){
			$this->getMailService()->log($message, $sent);
		}

		if (isset($exception)){
			throw new MessageSendException("Could not send message", 1429216806, $exception);
		}

		return $sent;
	}

	public function queue(Swift_Mime_Message $message){
		return $this->getMailService()->queue($message);
	}

	protected function emitBeforeSendMessage (Swift_Mime_Message $message){
		$this->getSignalSlotDispatcher()->dispatch(__CLASS__, 'beforeSendMessage', array($message));
	}

	protected function emitAfterSendMessage (Swift_Mime_Message $message){
		$this->getSignalSlotDispatcher()->dispatch(__CLASS__, 'afterSendMessage', array($message));
	}

	protected function getLogger (){
		return \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\Log\LogManager')->getLogger(__CLASS__);
	}

	protected function getMailService (){
		return \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager')->get('MONOGON\\QueueMailer\\Service\\MailService');
	}

	protected function getSignalSlotDispatcher (){
		return \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager')->get('TYPO3\\CMS\\Extbase\\SignalSlot\\Dispatcher');
	}
}