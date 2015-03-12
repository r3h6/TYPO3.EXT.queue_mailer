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

use Swift_Transport;
use Swift_Mime_Message;
use MONOGON\QueueMailer\Utility\MailUtility;
use MONOGON\QueueMailer\Configuration\ExtConf;
use Exception;

/**
 * Mailer
 */
class Mailer extends \TYPO3\CMS\Core\Mail\Mailer {


	protected $signalSlotDispatcher;

	public function __construct(\Swift_Transport $transport = NULL) {
		parent::__construct($transport);
		$this->signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager')->get('TYPO3\\CMS\\Extbase\\SignalSlot\\Dispatcher');
	}

	/**
	 * @param Swift_Mime_Message $message
	 * @param array              $failedRecipients An array of failures by-reference
	 * @return integer
	 */
	public function send(Swift_Mime_Message $message, &$failedRecipients = null){
		if (ExtConf::get('queueAllMessages')){
			return $this->queue($message, $failedRecipients) ? 1: 0;
		}

		try {
			$this->emitBeforeSendSignal($message);
			$sent = parent::send($message, $failedRecipients);
		} catch (Exception $exception){
			$sent = 0;
			$this->getLogger()->error($exception->getMessage());
		}

		if (ExtConf::get('logAllMessages') || ($message instanceof \MONOGON\QueueMailer\Mail\TemplateMailMessage)){
			MailUtility::log($message, $sent);
		}

		return $sent;
	}

	protected function emitBeforeSendSignal ($message){
		$this->signalSlotDispatcher->dispatch('TYPO3\\CMS\\Core\\Mail\\Mailer', 'beforeSend', array($message));
	}

	public function queue(Swift_Mime_Message $message, &$failedRecipients = null){
		return MailUtility::queue($message);
	}

	protected function getLogger (){
		return \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\Log\LogManager')->getLogger(__CLASS__);
	}
}