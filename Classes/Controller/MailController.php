<?php
namespace MONOGON\QueueMailer\Controller;

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
 * MailController
 */
class MailController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * mailRepository
	 *
	 * @var \MONOGON\QueueMailer\Domain\Repository\MailRepository
	 * @inject
	 */
	protected $mailRepository = NULL;

	/**
	 * action list
	 *
	 * @param \MONOGON\QueueMailer\Domain\Model\Dto\MailDemand $demand
	 * @return void
	 */
	public function listAction(\MONOGON\QueueMailer\Domain\Model\Dto\MailDemand $demand = NULL) {


		$mails = $this->mailRepository->findDemanded($demand);
		$this->view->assign('mails', $mails);

		if ($demand === NULL){
			$demand = $this->objectManager->get('MONOGON\\QueueMailer\\Domain\\Model\\Dto\\MailDemand');
			$demand->setPid(\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('id'));
		}
		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($demand);

		$this->view->assign('demand', $demand);
	}

	/**
	 * action show
	 *
	 * @param \MONOGON\QueueMailer\Domain\Model\Mail $mail
	 * @return void
	 */
	public function showAction(\MONOGON\QueueMailer\Domain\Model\Mail $mail) {
		$this->view->assign('mail', $mail);
	}

}