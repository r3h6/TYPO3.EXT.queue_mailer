<?php

namespace MONOGON\QueueMailer\Tests\Unit\Domain\Model;

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
 * Test case for class \MONOGON\QueueMailer\Domain\Model\PendingMessage.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author R3 H6 <r3h6@outlook.com>
 */
class PendingMessageTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \MONOGON\QueueMailer\Domain\Model\PendingMessage
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \MONOGON\QueueMailer\Domain\Model\PendingMessage();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getMessageReturnsInitialValueForString() {
		$this->assertSame(
			NULL,
			$this->subject->getMessage()
		);
	}

	/**
	 * @test
	 */
	public function setMessageForStringSetsMessage() {
		$message = new \TYPO3\CMS\Core\Mail\MailMessage();

		$this->subject->setMessage($message);

		$this->assertAttributeInternalType(
			'string',
			'message',
			$this->subject
		);

		$this->assertInstanceOf('TYPO3\\CMS\\Core\\Mail\\MailMessage', $this->subject->getMessage());
	}

	/**
	 * @test
	 */
	public function getScheduledReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getScheduled()
		);
	}

	/**
	 * @test
	 */
	public function setScheduledForDateTimeSetsScheduled() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setScheduled($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'scheduled',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIsDummyRecordReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getIsDummyRecord()
		);
	}

	/**
	 * @test
	 */
	public function setIsDummyRecordForBooleanSetsIsDummyRecord() {
		$this->subject->setIsDummyRecord(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'isDummyRecord',
			$this->subject
		);
	}
}
