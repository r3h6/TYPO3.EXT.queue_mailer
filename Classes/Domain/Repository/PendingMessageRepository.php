<?php
namespace MONOGON\QueueMailer\Domain\Repository;

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
 * The repository for QueuedMailMessages
 */
class PendingMessageRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * [$persistenceManager description]
	 * @var \MONOGON\QueueMailer\Persistence\PersistenceManager
	 * @inject
	 */
	protected $persistenceManager;

	// const STORAGE_PID = 0;
	protected $defaultOrderings = array(
		'crdate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
	);

	public function initializeObject() {
		/** @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
		$querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
		$querySettings->setRespectStoragePage(FALSE);
		$this->setDefaultQuerySettings($querySettings);
	}

	/**
	 * [push description]
	 * @param  \TYPO3\CMS\Core\Mail\MailMessage $message [description]
	 * @return boolean                                    [description]
	 */
	public function push(\TYPO3\CMS\Core\Mail\MailMessage $message) {
		$pendingMessage = GeneralUtility::makeInstance('MONOGON\\QueueMailer\\Domain\\Model\\PendingMessage');
		$pendingMessage->setMessage($message);
		// $pendingMessage->setPid(self::STORAGE_PID);
		$this->add($pendingMessage);
		$this->persistenceManager->persistAll();
		return $pendingMessage->getUid() !== NULL;
	}

	/**
	 * @param int $limit
	 * @return array<\TYPO3\CMS\Core\Mail\MailMessage>
	 */
	public function pop($limit) {
		// $querySettings = $this->defaultQuerySettings;
		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($querySettings); exit;
		$messages = array();
		$query = $this->createQuery();
		if ($limit) {
			$query->setLimit($limit);
		}
		$pendingMessages = $query->execute();
		foreach ($pendingMessages as $pendingMessage) {
			$message = $pendingMessage->getMessage();
			// if (!$message instanceof \TYPO3\CMS\Core\Mail\MailMessage) {
			// 	throw new Exception(sprintf('Pending message with uid %s is not a MailMessage!', $pendingMessage->getUid()));
			// }
			$messages[$pendingMessage->getUid()] = $message;
		}
		// $this->persistenceManager->persistAll();
		return $messages;
	}

	/**
	 * @param $uid
	 */
	public function deleteByUid($uid) {
		$GLOBALS['TYPO3_DB']->exec_DELETEquery('tx_queuemailer_domain_model_pendingmessage', sprintf('uid=%d', $uid));
	}

}