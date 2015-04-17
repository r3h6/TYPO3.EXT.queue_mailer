<?php

namespace MONOGON\QueueMailer\Tests\Unit\Mail;

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

use MONOGON\QueueMailer\Utility\MailUtility;
use MONOGON\QueueMailer\Configuration\ExtConf;

require_once PATH_typo3 . 'contrib/swiftmailer/swift_required.php';


class TransportMock extends \Swift_Transport_NullTransport {
	const SEND_RETURN_VALUE = 5; // Not 1
	public function __construct(){
		parent::__construct(new \Swift_Events_SimpleEventDispatcher());
	}
	public function send(\Swift_Mime_Message $message, &$failedRecipients = null){
		parent::send($message, $failedRecipients);

		return self::SEND_RETURN_VALUE;
	}
}

class MailerMock extends \MONOGON\QueueMailer\Mail\Mailer {
	protected $mailSettings = array(
		'transport' => 'MONOGON\\QueueMailer\\Tests\\Unit\\Mail\\TransportMock'
	);

	public $mailServiceMock = NULL;

	protected function getMailService(){
		return $this->mailServiceMock;
	}
}

/**
 * Test case for class \MONOGON\QueueMailer\Mail\Mailer.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author R3 H6 <r3h6@outlook.com>
 */
class MailerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \MONOGON\QueueMailer\Mail\Mailer
	 */
	protected $subject = NULL;

	protected $transportMock;

	protected $extConf = NULL;

	protected function setUp() {
		$this->subject = new MailerMock();

		//$this->subject = $this->getMock('MailerMock', array('getMailService'), array(), '', TRUE);

		$this->subject->mailServiceMock = $this->getMock('MONOGON\\QueueMailer\\Service\\MailService', array('send', 'queue', 'log'), array(), '', FALSE);
		//$this->inject($this->subject)
		//MailUtility::setMockInstance($this->subject->mailServiceMock);

		// $this->subject->method('getMailService')
		// ->will($this->returnValue($this->subject->mailServiceMock));

		$this->extConf = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][ExtConf::EXT_KEY];
		$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][ExtConf::EXT_KEY] = serialize(array(
			'queueAllMessages' => '0',
			'logAllMessages' => '0',
		));
	}

	protected function tearDown() {
		$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][ExtConf::EXT_KEY] = $this->extConf;
		unset(
			$this->subject,
			$this->extConf,
			$this->transportMock
		);
	}

	/**
	 * @test
	 */
	public function sendCoreMessage (){
		$message = $this->createMessage();

		// $this->transportMock
		// 	->expects($this->once())
		// 	->method('send')
		// 	->with(
		// 		$this->identicalTo($message),
		// 		$this->identicalTo(array())
		// 	)
		// 	->will($this->returnValue(5));

		$this->assertEquals(
			TransportMock::SEND_RETURN_VALUE,
			$this->subject->send($message)
		);
	}

	/**
	 * @test
	 */
	public function sendQueueMailerMessage (){
		$message = $this->createMailQueueMessage();

		// $this->transportMock
		// 	->expects($this->once())
		// 	->method('send')
		// 	->with(
		// 		$this->identicalTo($message),
		// 		$this->identicalTo(array())
		// 	)
		// 	->will($this->returnValue(5));

		$this->subject->mailServiceMock
			->expects($this->once())
			->method('log')
			->with($this->identicalTo($message));

		$this->assertEquals(
			TransportMock::SEND_RETURN_VALUE,
			$this->subject->send($message)
		);
	}

	/**
	 * @test
	 */
	public function queueAllMessages (){
		ExtConf::set('queueAllMessages', '1');

		$message = $this->createMessage();

		// $this->transportMock
		// 	->expects($this->never())
		// 	->method('send');

		$this->subject->mailServiceMock
			->expects($this->once())
			->method('queue')
			->with($this->identicalTo($message))
			->will($this->returnValue(TRUE));

		$this->assertEquals(
			1,
			$this->subject->send($message)
		);
	}

	/**
	 * @test
	 */
	public function logAllMessages (){

		ExtConf::set('logAllMessages', '1');
		$message = $this->createMessage();

		// $this->transportMock
		// 	->expects($this->once())
		// 	->method('send')
		// 	->with(
		// 		$this->identicalTo($message),
		// 		$this->identicalTo(array())
		// 	)
		// 	->will($this->returnValue(7));


		$this->subject->mailServiceMock
			->expects($this->once())
			->method('log')
			->with($this->identicalTo($message));

		$this->assertEquals(
			TransportMock::SEND_RETURN_VALUE,
			$this->subject->send($message)
		);
	}

	protected function createMailQueueMessage (){
		return $this->createMessage('MONOGON\\QueueMailer\\Mail\\TemplateMailMessage');
	}

	protected function createMessage ($className = 'TYPO3\\CMS\\Core\\Mail\\MailMessage'){
		$message = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance($className);
		$message
			->setFrom(array('test@phpunit.com' => 'PHP Unit'))
			->setTo(array('r3h6@outlook.com' => 'R3 H6'))
			->setSubject('Test')
			->setBody('Donec interdum metus et hendrerit.');
		return $message;
	}
}
