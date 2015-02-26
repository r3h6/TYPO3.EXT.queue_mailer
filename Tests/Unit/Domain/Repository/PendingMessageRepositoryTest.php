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

use \TYPO3\CMS\Core\Mail\MailMessage;
use Tx_Phpunit_Framework;

/**
 * Test case for class \MONOGON\QueueMailer\Domain\Repository\PendingMessageRepository.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author R3 H6 <r3h6@outlook.com>
 */
class PendingMessageRepositoryTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \MONOGON\QueueMailer\Domain\Repository\PendingMessageRepository
	 */
	protected $subject = NULL;

	protected $testingFramework = NULL;

	protected function setUp() {
		$this->testingFramework = new Tx_Phpunit_Framework('tx_queuemailer');

		$this->subject = $this->getMock('MONOGON\\QueueMailer\\Domain\\Repository\\PendingMessageRepository', array('add', 'remove', 'createQuery'), array(''), '', FALSE);

		$persistenceManagerMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager', array('persistAll'), array(), '', FALSE);

		$this->inject($this->subject, 'persistenceManager', $persistenceManagerMock);
	}

	protected function tearDown() {
		$this->testingFramework->cleanUp();
		unset($this->subject, $this->testingFramework);
	}

	/**
	 * @test
	 */
	public function push (){
		$message = new MailMessage();
		$message
			->setFrom(array('test@phpunit.com' => 'PHP Unit'))
			->setTo(array('r3h6@outlook.com' => 'R3 H6'))
			->setSubject('Test')
			->setBody('Donec interdum metus et hendrerit.');

		$this->subject
			->expects($this->once())
			->method('add')
			->with($this->callback(function ($pendingMessage) use ($message){
				return $pendingMessage->getMessage() instanceof MailMessage;
			}));

		$this->subject->push($message);
	}

	/**
	 * @test
	 */
	public function pop (){
		$pendingMessages = array(
			$this->createPendingMessage(),
			$this->createPendingMessage(),
			$this->createPendingMessage(),
		);

		$query = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Query', array('setLimit', 'execute'), array(''), '', FALSE);
		$query
			->expects($this->once())
			->method('execute')
			->will($this->returnValue($pendingMessages));

		$this->subject
			->expects($this->once())
			->method('createQuery')
			->will($this->returnValue($query));

		$this->subject
			->expects($this->exactly(3))
			->method('remove');

		$messages = $this->subject->pop(20);
	}

	/**
	 * @test
	 */
	public function functionalTestPop (){
		$record = array(
			'message' => serialize($this->createMessage()),
		);

		$this->testingFramework->createRecord('tx_queuemailer_domain_model_pendingmessage', $record);
		$this->testingFramework->createRecord('tx_queuemailer_domain_model_pendingmessage', $record);
		$this->testingFramework->createRecord('tx_queuemailer_domain_model_pendingmessage', $record);


		$objectManager = new \TYPO3\CMS\Extbase\Object\ObjectManager();

		$pendingMessageRepository = $objectManager->get('MONOGON\\QueueMailer\\Domain\\Repository\\PendingMessageRepository');


		/** @var $querySettings Typo3QuerySettings */
		$querySettings = $objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
		$querySettings->setStoragePageIds(array(0));
		$pendingMessageRepository->setDefaultQuerySettings($querySettings);

		$messages = $pendingMessageRepository->pop(20);

		$this->assertCount(3, $messages);
		$this->assertContainsOnly('TYPO3\\CMS\\Core\\Mail\\MailMessage', $messages);
	}

	protected function createPendingMessage (){
		$pendingMessage = new \MONOGON\QueueMailer\Domain\Model\PendingMessage();
		$pendingMessage->setMessage($this->createMessage());
		return $pendingMessage;
	}

	protected function createMessage (){
		$message = new MailMessage();
		$message
			->setFrom(array('test@phpunit.com' => 'PHP Unit'))
			->setTo(array('r3h6@outlook.com' => 'R3 H6'))
			->setSubject('Test')
			->setBody('Donec interdum metus et hendrerit.');
		return $message;
	}

}
