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
			foreach ($messages as $message){
				$message->send();
			}
			ExtConf::set('queueAllMessages', $queueAllMessages);
		} catch (Exception $exception){
			$this->getLogger()->error($exception->getMessage());
			throw $exception;
		}
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