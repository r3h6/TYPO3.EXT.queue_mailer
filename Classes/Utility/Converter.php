<?php
namespace MONOGON\QueueMailer\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;

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
 * Converter
 */
class Converter {

	public static function html2text ($html){
		$converter = new \Html2Text\Html2Text($html);
		return $converter->getText();
	}


	public static function message2mail (\TYPO3\CMS\Core\Mail\MailMessage $message){
		$mail = GeneralUtility::makeInstance('MONOGON\\QueueMailer\\Domain\\Model\\Mail');
		$mail->setSubject($message->getSubject());
		$mail->setRecipients(Converter::emailArray2emailString($message->getFrom()));
		$mail->setSender(Converter::emailArray2emailString($message->getTo()));
		$mail->setFailedRecipients(Converter::emailArray2emailString($message->getFailedRecipients()));

		$mail->setMessage($message->getBody());

		$mail->setSource($message->toString());

		if ($message instanceof \MONOGON\QueueMailer\Mail\TemplateMailMessage){
			$mail->setVariables($message->getVariables());
		}

		foreach ($message->getChildren() as $entity){
			if ($entity instanceof \Swift_Mime_Attachment){
				$mail->addAttachment(static::swift2attachment($entity));
			}
			// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($entity);
		}
		return $mail;
	}

	public static function swift2attachment (\Swift_Mime_Attachment $entity){
		$attachment = GeneralUtility::makeInstance('MONOGON\\QueueMailer\\Domain\\Model\\Attachment');

		$attachment->setName($entity->getFilename());
		$attachment->setSize($entity->getSize());


		$attachment->setData($entity->getBody());
		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($entity); exit;
		// $logger = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\Log\LogManager')->getLogger(__CLASS__);

		// $logger->info(print_r($entity, TRUE));
		// exit;

		return $attachment;
	}

	public static function emailArray2emailString ($source){
		$value = array();
		if (is_array($source)){
			foreach ($source as $email => $name) {
				$value[] = "$name <$email>";
			}
		}
		return join(', ', $value);
	}

}