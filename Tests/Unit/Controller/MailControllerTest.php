<?php
namespace MONOGON\QueueMailer\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 R3 H6 <r3h6@outlook.com>
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class MONOGON\QueueMailer\Controller\MailController.
 *
 * @author R3 H6 <r3h6@outlook.com>
 */
class MailControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \MONOGON\QueueMailer\Controller\MailController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('MONOGON\\QueueMailer\\Controller\\MailController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllMailsFromRepositoryAndAssignsThemToView() {

		$allMails = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$mailRepository = $this->getMock('MONOGON\\QueueMailer\\Domain\\Repository\\MailRepository', array('findAll'), array(), '', FALSE);
		$mailRepository->expects($this->once())->method('findAll')->will($this->returnValue($allMails));
		$this->inject($this->subject, 'mailRepository', $mailRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('mails', $allMails);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenMailToView() {
		$mail = new \MONOGON\QueueMailer\Domain\Model\Mail();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('mail', $mail);

		$this->subject->showAction($mail);
	}
}
