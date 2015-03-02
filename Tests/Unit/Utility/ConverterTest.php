<?php

namespace MONOGON\QueueMailer\Tests\Unit\Utility;

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
use MONOGON\QueueMailer\Utility\Converter;

/**
 * Test case for class \MONOGON\QueueMailer\Utility\Converter.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author R3 H6 <r3h6@outlook.com>
 */
class ConverterTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {


	protected function setUp() {}

	protected function tearDown() {}


	/**
	 * @test
	 */
	public function convertEmailArrayToEmailString (){
		$this->assertEquals(
			'A <a@a.a>, B <b@b.b>',
			Converter::emailArray2emailString(array(
				'a@a.a' => 'A',
				'b@b.b' => 'B'
			))
		);
	}

	/**
	 * @test
	 */
	public function convertMessageToEmail () {
		$message = new MailMessage();
		$message
			->setFrom(array('test@phpunit.com' => 'PHP Unit'))
			->setTo(array('r3h6@outlook.com' => 'R3 H6'))
			->setSubject('Test')
			->setBody('Donec interdum metus et hendrerit.', 'text/plain');


		$mail = Converter::message2mail($message);

		$this->assertInstanceOf('MONOGON\\QueueMailer\\Domain\\Model\\Mail', $mail);
	}

	/**
	 * @test
	 */
	public function convertMessageWithAttachmentsToEmail () {
		$attachmentsDir = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('queue_mailer') . 'Tests/Resources/Private/Attachments/';
		$message = new MailMessage();
		$message
			->setFrom(array('test@phpunit.com' => 'PHP Unit'))
			->setTo(array('r3h6@outlook.com' => 'R3 H6'))
			->setSubject('Test')
			->setBody('Donec interdum metus et hendrerit.', 'text/plain')
			->addPart('<html><head></head><body>Donec!</body></html>', 'text/html')
			->attach(\Swift_Attachment::fromPath($attachmentsDir . 'Lorem_ipsum.docx'))
			->attach(\Swift_Attachment::fromPath($attachmentsDir . 'Lorem_ipsum.pdf'));


		$mail = Converter::message2mail($message);
// 		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($mail);
// exit;
		$this->assertInstanceOf('MONOGON\\QueueMailer\\Domain\\Model\\Mail', $mail);

		$attachments = $mail->getAttachments();
		$this->assertContainsOnly('MONOGON\\QueueMailer\\Domain\\Model\\Attachment', $attachments);
		$this->assertCount(2, $attachments);
	}
}
