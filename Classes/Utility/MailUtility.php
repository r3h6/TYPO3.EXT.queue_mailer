<?php
namespace MONOGON\QueueMailer\Utility;

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

use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * MailUtility
 */
class MailUtility {


	protected static $instance;

	public static function getInstance (){
		if (!static::$instance){
			static::$instance = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager')->get('MONOGON\\QueueMailer\\Service\\MailService');
		}
		return static::$instance;
	}

	public static function setMockInstance(\PHPUnit_Framework_MockObject_MockObject $mock){
		static::$instance = $mock;
	}

	public static function __callStatic($method, $args){

		$instance = static::getInstance();

		return call_user_func_array(array($instance, $method), $args);
	}

}