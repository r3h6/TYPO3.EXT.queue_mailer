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




		if (\MONOGON\QueueMailer\Configuration\ExtConf::get('queueAllMessages')){
			return $this->queue($message, $failedRecipients);
		}


		// try {
			$sent = parent::send($message, $failedRecipients);
		// } catch (Exception $exception){
		// 	$this->getLogger()->error($exception->message());
		// }
		MailUtility::log($message, $sent, $failedRecipients);
		return $sent;
	}

	public function queue(Swift_Mime_Message $message, &$failedRecipients = null){
		return MailUtility::queue($message);
	}

	// protected function getLogger (){
	// 	return \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\Log\LogManager')->getLogger(__CLASS__);
	// }
}