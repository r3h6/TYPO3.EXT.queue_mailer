<?php

namespace MONOGON\QueueMailer\Tests\Unit\Domain\Repository;

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

use TYPO3\CMS\Core\Mail\MailMessage;

/**
 * Test case for class \MONOGON\QueueMailer\Domain\Repository\MailRepository.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author R3 H6 <r3h6@outlook.com>
 */
class MailRepositoryTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \MONOGON\QueueMailer\Domain\Repository\MailRepository
	 */
	protected $subject = NULL;

	protected $persistenceManagerMock = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('MONOGON\\QueueMailer\\Domain\\Repository\\MailRepository', array('add'), array(), '', FALSE);

		$this->persistenceManagerMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager', array('persistAll'), array(), '', FALSE);
		$this->inject($this->subject, 'persistenceManager', $this->persistenceManagerMock);

		$configurationManagerMock = $this->getMock('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager', array('setConfiguration'), array(), '', FALSE);
		$this->inject($this->subject, 'configurationManager', $configurationManagerMock);

	}

	protected function tearDown() {
		unset($this->subject, $this->persistenceManagerMock);
	}

	/**
	 * @test
	 */
	public function addMessage (){

		// $mail = new \MONOGON\QueueMailer\Domain\Model\Mail();
		$sent = 3;
		$this->subject
			->expects($this->once())
			->method('add')
			->with($this->isInstanceOf('MONOGON\\QueueMailer\\Domain\\Model\\Mail'));


		$message = new MailMessage();
		$message
			->setFrom(array('test@phpunit.com' => 'PHP Unit'))
			->setTo(array('r3h6@outlook.com' => 'R3 H6'))
			->setSubject('Test')
			->setBody('Donec interdum metus et hendrerit.');

		$this->persistenceManagerMock
			->expects($this->once())
			->method('persistAll');

		$this->subject->addMessage($message, $sent);
	}

}
