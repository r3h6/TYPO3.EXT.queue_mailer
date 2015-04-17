<?php
namespace MONOGON\QueueMailer\Command;

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
use MONOGON\QueueMailer\Configuration\ExtConf;

/**
 * QueueCommandController
 */
class QueueCommandController extends \TYPO3\CMS\Extbase\Mvc\Controller\CommandController {

	/**
	 * [$mailRepository description]
	 * @var \MONOGON\QueueMailer\Domain\Repository\PendingMessageRepository
	 * @inject
	 */
	protected $pendingMessageRepository = NULL;

	/**
	 * SignalSlotDispatcher
	 *
	 * @var TYPO3\CMS\Extbase\SignalSlot\Dispatcher
	 * @inject
	 */
	protected $signalSlotDispatcher = NULL;

	/**
	 * Send queued messages
	 *
	 * @param  integer $limit Limit of messages sent per call
	 * @return void
	 */
	public function sendCommand ($limit = 20){
		try {
			$messages = $this->pendingMessageRepository->pop($limit);
			// $this->getLogger()->info(print_r($messages, TRUE));
			$queueAllMessages = ExtConf::get('queueAllMessages');
			ExtConf::set('queueAllMessages', '0');
			foreach ($messages as $pendingMessageUid => $message){
				$sent = 0;
				try {
					if (!($message instanceof \TYPO3\CMS\Core\Mail\MailMessage)){
						throw new Exception("Message is not a MailMessage.", 1429298058);
					}
					$sent = $message->send();
				} catch (Exception $exception){
					$sent = 0;
					$this->getLogger()->error("Could not send pending message #$pendingMessageUid because " . $exception->getMessage());
				}

				if ($sent){
					$this->pendingMessageRepository->deleteByUid($pendingMessageUid);
				}
				$this->emitAfterSendMessage($message, $sent);
			}
			ExtConf::set('queueAllMessages', $queueAllMessages);
		} catch (Exception $exception){
			$this->getLogger()->error($exception->getMessage());
			throw $exception;
		}
	}

	/**
	 * [emitAfterSendMessage description]
	 * @param  \TYPO3\CMS\Core\Mail\MailMessage $message [description]
	 * @param  int                              $sent    [description]
	 * @return void                                    [description]
	 */
	protected function emitAfterSendMessage (\TYPO3\CMS\Core\Mail\MailMessage $message, $sent){
		$this->signalSlotDispatcher->dispatch(__CLASS__, 'afterSendMessage', array($message, $sent));
	}

	/**
	 * Returns logger
	 *
	 * @return [type] [description]
	 */
	protected function getLogger (){
		return \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Log\\LogManager')->getLogger(__CLASS__);
	}
}