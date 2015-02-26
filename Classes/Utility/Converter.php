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

	public static function message2mail (\TYPO3\CMS\Core\Mail\MailMessage $message){
		$mail = GeneralUtility::makeInstance('MONOGON\\QueueMailer\\Domain\\Model\\Mail');
		$mail->setMailSubject($message->getSubject());
		$mail->setMailFrom(Converter::emailArray2emailString($message->getFrom()));
		$mail->setMailTo(Converter::emailArray2emailString($message->getTo()));

		return $mail;
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