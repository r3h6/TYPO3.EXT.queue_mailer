<?php
namespace MONOGON\QueueMailer\Service;

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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use MONOGON\QueueMailer\Mail\MailMessage;
use Exception;

/**
 * MailService
 */
class MailService implements \TYPO3\CMS\Core\SingletonInterface {

	/**
	 * [$objectManager description]
	 * @var TYPO3\CMS\Extbase\Object\ObjectManager
	 * @inject
	 */
	protected $objectManager = NULL;

	/**
	 * [$mailRepository description]
	 * @var MONOGON\QueueMailer\Domain\Repository\MailRepository
	 * @inject
	 */
	protected $mailRepository = NULL;

	/**
	 * [$mailRepository description]
	 * @var MONOGON\QueueMailer\Domain\Repository\PendingMessageRepository
	 * @inject
	 */
	protected $pendingMessageRepository = NULL;

	/**
	 * [send description]
	 * @param  \TYPO3\CMS\Core\Mail\MailMessage|callable $arg [description]
	 * @return boolean      [description]
	 */
	public function send ($arg){
		if (is_callable($arg)){
			$message = $this->createTemplateMailMessage();
			call_user_func($arg, $message);
		} else {
			$message = $arg;
		}
		if ($message instanceof \TYPO3\CMS\Core\Mail\MailMessage){

			if (!$message->isSent()){
				try {
					return $message->send() ? TRUE: FALSE;
				} catch (Exception $exception){
					$this->getLogger()->error($exception->getMessage());
				}
			}
		}
		return FALSE;
	}

	public function log (\TYPO3\CMS\Core\Mail\MailMessage $message, $sent = NULL){

		$this->mailRepository->addMessage($message, $sent);
	}

	public function queue ($arg){
		if (is_callable($arg)){
			$message = $this->createTemplateMailMessage();
			call_user_func($arg, $message);
		} else {
			$message = $arg;
		}
		if ($message instanceof \TYPO3\CMS\Core\Mail\MailMessage){
			return $this->pendingMessageRepository->push($message);
		}
		return FALSE;
	}

	protected function createTemplateMailMessage (){
		$message = $this->objectManager->get('MONOGON\\QueueMailer\\Mail\\TemplateMailMessage');

		$fromMail = isset($GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromAddress']) ? $GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromAddress']: '';

		$fromName = isset($GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromName']) ? $GLOBALS['TYPO3_CONF_VARS']['MAIL']['defaultMailFromName']: '';

		$message->setFrom($fromMail, $fromName);
		return $message;
	}

	protected function getLogger (){
		return \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\Log\LogManager')->getLogger(__CLASS__);
	}
}