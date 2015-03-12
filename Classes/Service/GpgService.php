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

// use TYPO3\CMS\Core\Utility\GeneralUtility;
// use MONOGON\QueueMailer\Mail\MailMessage;
// use Exception;

call_user_func(function(){
	$pear = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('queue_mailer') . 'Resources/Private/Pear/';
	set_include_path(get_include_path() . PATH_SEPARATOR . $pear);
});

require_once 'Crypt/GPG.php';

/**
 * GpgService
 */
class GpgService implements \TYPO3\CMS\Core\SingletonInterface {

	public function encrypt (\TYPO3\CMS\Core\Mail\MailMessage $message){
		$gpg = new \Crypt_GPG(array(
			'homedir' => $this->getHomeDir(),
		));
	}

	protected function getHomeDir (){
		// $gnupgHome = getenv('GNUPGHOME');
		// die($gnupgHome);

		$path = PATH_site . 'typo3temp/';
		$folder = 'gnupg';
		if (!is_dir($path . $folder)) {
			\TYPO3\CMS\Core\Utility\GeneralUtility::mkdir($path . $folder);
			if (@!is_dir($path . $folder)) {
				throw new \Exception("The directory $path$folder could not be created!");
			}
		}
		return $path . $folder;
	}
}