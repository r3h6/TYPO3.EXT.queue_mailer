<?php

namespace MONOGON\QueueMailer\Tests\Unit\Service;

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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Swift_Attachment;

/**
 * Test case for class \MONOGON\QueueMailer\Service\MailService.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author R3 H6 <r3h6@outlook.com>
 */
class MailServiceTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \MONOGON\QueueMailer\Service\MailService
	 */
	protected $subject = NULL;

	protected $mailRepositoryMock;

	protected $pendingMessageRepositoryMock;

	protected $objectManagerMock;

	protected function setUp() {
		$this->subject = new \MONOGON\QueueMailer\Service\MailService();



		$this->objectManagerMock = $this->getMock('TYPO3\\CMS\\Extbase\\Object\\ObjectManager', array('get'), array(), '', FALSE);
		$this->inject($this->subject, 'objectManager', $this->objectManagerMock);

		$this->mailRepositoryMock = $this->getMock('MONOGON\\QueueMailer\\Domain\\Repository\\MailRepository', array('addMessage'), array(), '', FALSE);
		$this->inject($this->subject, 'mailRepository', $this->mailRepositoryMock);


		$this->pendingMessageRepositoryMock = $this->getMock('MONOGON\\QueueMailer\\Domain\\Repository\\PendingMessageRepository', array('push'), array(), '', FALSE);
		$this->inject($this->subject, 'pendingMessageRepository', $this->pendingMessageRepositoryMock);

	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function sendWithCallback() {

		$messageMock = $this->getMessageMock();
		$messageMock
			->expects($this->once())
			->method('send');

		$this->objectManagerMock
			->expects($this->once())
			->method('get')
			->with('MONOGON\\QueueMailer\\Mail\\TemplateMailMessage')
			->will($this->returnValue($messageMock));

		$this->subject->send(function ($message){
			$message
				->setTo('r3h6@outlook')
				->setBody('Test ' . __FUNCTION__);
		});
	}

	/**
	 * @test
	 */
	public function sendWithMessage (){
		$messageMock = $this->getMessageMock();
		$messageMock
			->expects($this->once())
			->method('send');

		$this->subject->send($messageMock);
	}

	/**
	 * @test
	 */
	public function log (){
		$messageMock = $this->getMessageMock();
		$messageMock
			->expects($this->any())
			->method('isSent')
			->will($this->returnValue(TRUE));

		$this->mailRepositoryMock
			->expects($this->once())
			->method('addMessage')
			->with($this->identicalTo($messageMock));

		$this->subject->log($messageMock);
	}


	/**
	 * @test
	 */
	public function sendWithSentMessage (){
		$messageMock = $this->getMessageMock();
		$messageMock
			->expects($this->any())
			->method('isSent')
			->will($this->returnValue(TRUE));

		$sent = $this->subject->send($messageMock);
		$this->assertFalse($sent);
	}

	/**
	 * @test
	 */
	public function queueWithCallback() {

		$messageMock = $this->getMessageMock();

		$this->objectManagerMock
			->expects($this->once())
			->method('get')
			->with('MONOGON\\QueueMailer\\Mail\\TemplateMailMessage')
			->will($this->returnValue($messageMock));

		$this->pendingMessageRepositoryMock
			->expects($this->once())
			->method('push')
			->with($this->identicalTo($messageMock))
			->will($this->returnValue(TRUE));

		$this->subject->queue(function ($message){
			$message
				->setTo('r3h6@outlook')
				->setBody('Test ' . __FUNCTION__);
		});
	}

	protected function getMessageMock (){
		return $this->getMock('MONOGON\\QueueMailer\\Mail\\TemplateMailMessage', array('send', 'isSent'), array(), '', TRUE);
	}
}
