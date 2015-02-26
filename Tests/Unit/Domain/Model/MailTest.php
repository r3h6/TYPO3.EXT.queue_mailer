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
 * Test case for class \MONOGON\QueueMailer\Domain\Model\Mail.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author R3 H6 <r3h6@outlook.com>
 */
class MailTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \MONOGON\QueueMailer\Domain\Model\Mail
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \MONOGON\QueueMailer\Domain\Model\Mail();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getMailSubjectReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getMailSubject()
		);
	}

	/**
	 * @test
	 */
	public function setMailSubjectForStringSetsMailSubject() {
		$this->subject->setMailSubject('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'mailSubject',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getMailToReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getMailTo()
		);
	}

	/**
	 * @test
	 */
	public function setMailToForStringSetsMailTo() {
		$this->subject->setMailTo('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'mailTo',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getMailCcReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getMailCc()
		);
	}

	/**
	 * @test
	 */
	public function setMailCcForStringSetsMailCc() {
		$this->subject->setMailCc('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'mailCc',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getMailBccReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getMailBcc()
		);
	}

	/**
	 * @test
	 */
	public function setMailBccForStringSetsMailBcc() {
		$this->subject->setMailBcc('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'mailBcc',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getMailFromReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getMailFrom()
		);
	}

	/**
	 * @test
	 */
	public function setMailFromForStringSetsMailFrom() {
		$this->subject->setMailFrom('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'mailFrom',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getMailReplyToReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getMailReplyTo()
		);
	}

	/**
	 * @test
	 */
	public function setMailReplyToForStringSetsMailReplyTo() {
		$this->subject->setMailReplyTo('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'mailReplyTo',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getMailMessageReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getMailMessage()
		);
	}

	/**
	 * @test
	 */
	public function setMailMessageForStringSetsMailMessage() {
		$this->subject->setMailMessage('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'mailMessage',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getMailDateReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getMailDate()
		);
	}

	/**
	 * @test
	 */
	public function setMailDateForDateTimeSetsMailDate() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setMailDate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'mailDate',
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

	/**
	 * @test
	 */
	public function getFailedRecipientsReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFailedRecipients()
		);
	}

	/**
	 * @test
	 */
	public function setFailedRecipientsForStringSetsFailedRecipients() {
		$this->subject->setFailedRecipients('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'failedRecipients',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSentReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getSent()
		);
	}

	/**
	 * @test
	 */
	public function setSentForIntegerSetsSent() {
		$this->subject->setSent(12);

		$this->assertAttributeEquals(
			12,
			'sent',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAttachmentsReturnsInitialValueForAttachment() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getAttachments()
		);
	}

	/**
	 * @test
	 */
	public function setAttachmentsForObjectStorageContainingAttachmentSetsAttachments() {
		$attachment = new \MONOGON\QueueMailer\Domain\Model\Attachment();
		$objectStorageHoldingExactlyOneAttachments = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneAttachments->attach($attachment);
		$this->subject->setAttachments($objectStorageHoldingExactlyOneAttachments);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneAttachments,
			'attachments',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addAttachmentToObjectStorageHoldingAttachments() {
		$attachment = new \MONOGON\QueueMailer\Domain\Model\Attachment();
		$attachmentsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$attachmentsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($attachment));
		$this->inject($this->subject, 'attachments', $attachmentsObjectStorageMock);

		$this->subject->addAttachment($attachment);
	}

	/**
	 * @test
	 */
	public function removeAttachmentFromObjectStorageHoldingAttachments() {
		$attachment = new \MONOGON\QueueMailer\Domain\Model\Attachment();
		$attachmentsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$attachmentsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($attachment));
		$this->inject($this->subject, 'attachments', $attachmentsObjectStorageMock);

		$this->subject->removeAttachment($attachment);

	}
}
