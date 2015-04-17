<?php
namespace MONOGON\QueueMailer\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use MONOGON\QueueMailer\Utility\Converter;
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
 * The repository for Mails
 */
class MailRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * [$persistenceManager description]
	 * @var \MONOGON\QueueMailer\Persistence\PersistenceManager
	 * @inject
	 */
	protected $persistenceManager;

	/**
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManager
	 * @inject
	 */
	protected $configurationManager = NULL;

	/**
	 * @param \TYPO3\CMS\Core\Mail\MailMessage $message
	 * @param $sent
	 * @return boolean
	 */
	public function addMessage(\TYPO3\CMS\Core\Mail\MailMessage $message, $sent) {
		$mail = Converter::message2mail($message);
		$mail->setSent($sent);
		// if (is_callable(array($message, 'getPid'))) {
		// 	$mail->setPid($message->getPid());
		// } else {
		// 	if (isset($GLOBALS['TSFE'])) {
		// 		$mail->setPid($GLOBALS['TSFE']->id);
		// 	}
		// }
		$this->configurationManager->setConfiguration(array(
				'persistence.' => array(
					'classes.' => array(
						'MONOGON\\QueueMailer\\Domain\\Model\\Mail.' => array(
							'newRecordStoragePid' => $GLOBALS['TSFE']->id
						),
						'MONOGON\\QueueMailer\\Domain\\Model\\Attachment.' => array(
							'newRecordStoragePid' => $GLOBALS['TSFE']->id
						)
					)
				)
			));
		// $frameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($frameworkConfiguration); exit;
		// exit;
		// $pid = $GLOBALS['TSFE']->id;
		// if (is_callable(array($message, 'getPid')) && $message->getPid()){
		// 	$pid = $message->getPid();
		// }
		// $mail->setPid($pid);
		// 		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($pid);exit;
		// 		if ($pid){
		// /** @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
		// 			$querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
		// 			$querySettings->setRespectStoragePage(TRUE);
		// 			$querySettings->setStoragePageIds(array($pid));
		// 			$this->setDefaultQuerySettings($querySettings);
		// 		}
		$this->add($mail);
		$this->persistenceManager->persistAll();
		return $mail->getUid() !== NULL;
	}

}