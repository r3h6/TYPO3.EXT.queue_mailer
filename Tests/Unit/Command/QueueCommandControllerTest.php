<?php
namespace MONOGON\QueueMailer\Tests\Unit\Command;
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
 * Test case for class MONOGON\QueueMailer\Command\QueueCommandController.
 *
 * @author R3 H6 <r3h6@outlook.com>
 */
class QueueCommandControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \MONOGON\QueueMailer\Command\QueueCommandController
	 */
	protected $subject = NULL;

	protected $pendingMessageRepositoryMock = NULL;

	protected function setUp() {
		// $this->subject = $this->getMock('MONOGON\\QueueMailer\\Command\\QueueCommandController', array(), array(), '', FALSE);

		$this->subject = new \MONOGON\QueueMailer\Command\QueueCommandController();
		// $this->subject = $this->getMock('MONOGON\\QueueMailer\\Command\\QueueCommandController', array(), array(), '', FALSE);

		$this->pendingMessageRepositoryMock = $this->getMock('MONOGON\\QueueMailer\\Domain\\Repository\\PendingMessageRepository', array('pop'), array(), '', FALSE);

		$this->inject($this->subject, 'pendingMessageRepository', $this->pendingMessageRepositoryMock);
	}

	protected function tearDown() {
		unset($this->subject, $this->pendingMessageRepositoryMock);
	}

	/**
	 * @test
	 */
	public function sendCommand (){
		$this->pendingMessageRepositoryMock
			->expects($this->once())
			->method('pop')
			->with(5)
			->will($this->returnValue(array(
				$this->getMockMailMessage(),
				$this->getMockMailMessage(),
				$this->getMockMailMessage(),
			)));

		$this->subject->sendCommand(5);
	}

	protected function getMockMailMessage (){
		$message = $this->getMock('TYPO3\\CMS\\Core\\Mail\\MailMessage', array('send'), array(), '', TRUE);
		$message
			->setFrom(array('test@phpunit.com' => 'PHP Unit'))
			->setTo(array('r3h6@outlook.com' => 'R3 H6'))
			->setSubject('Test')
			->setBody('Donec interdum metus et hendrerit.');
		$message
			->expects($this->once())
			->method('send')
			->will($this->returnValue(1));
		return $message;
	}
}
