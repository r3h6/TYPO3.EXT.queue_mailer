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


require_once PATH_typo3 . 'contrib/swiftmailer/classes/Swift/Events/EventListener.php';
require_once PATH_typo3 . 'contrib/swiftmailer/classes/Swift/Mime/EncodingObserver.php';
require_once PATH_typo3 . 'contrib/swiftmailer/classes/Swift/Mime/CharsetObserver.php';
require_once PATH_typo3 . 'contrib/swiftmailer/classes/Swift/Mime/MimeEntity.php';
require_once PATH_typo3 . 'contrib/swiftmailer/classes/Swift/Mime/Message.php';
require_once PATH_typo3 . 'contrib/swiftmailer/classes/Swift/Transport.php';
require_once PATH_typo3 . 'contrib/swiftmailer/classes/Swift/Transport/NullTransport.php';


// require_once PATH_typo3 . 'contrib/swiftmailer/classes/Swift/NullTransport.php';

// require_once PATH_typo3 . 'contrib/swiftmailer/classes/Swift/DependencyContainer.php';


// require_once PATH_typo3 . 'contrib/swiftmailer/classes/Swift/Events/EventDispatcher.php';


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

	protected $mailServiceMock;

	protected $transportMock;

	protected $extConf = NULL;

	protected function setUp() {

		// $this->transportMock = $this->getMock('Swift_Transport_MailTransport', array('start', 'send', 'isStarted', 'stop', 'registerPlugin'), array(), '', FALSE);

		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(class_implements($this->transportMock)); exit;

		// $nullTransport = \Swift_NullTransport::newInstance();

		$this->transportMock = $this->getMock('Swift_Transport_NullTransport', array('send', 'registerPlugin'), array(), '', FALSE);

		$this->subject = new \MONOGON\QueueMailer\Mail\Mailer($this->transportMock);
		// $this->subject = new \MONOGON\QueueMailer\Mail\Mailer($nullTransport);


		// $this->subject = $this->getMock('MONOGON\\QueueMailer\\Mail\\Mailer', array(), array(), '', FALSE);

		// $this->inject($this->subject, '_transport', $this->transportMock);

		$this->mailServiceMock = $this->getMock('MONOGON\\QueueMailer\\Service\\MailService', array('send', 'queue', 'log'), array(), '', FALSE);

		MailUtility::setMockInstance($this->mailServiceMock);
		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(class_implements($mailServiceMock)); exit;
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
			$this->mailServiceMock,
			$this->transportMock
		);
	}

	/**
	 * @test
	 */
	public function sendCoreMessage (){
		$message = $this->createMessage();

		$this->transportMock
			->expects($this->once())
			->method('send')
			->with(
				$this->identicalTo($message),
				$this->identicalTo(array())
			)
			->will($this->returnValue(5));

		$this->assertEquals(
			5,
			$this->subject->send($message)
		);
	}

	/**
	 * @test
	 */
	public function sendQueueMailerMessage (){
		$message = $this->createMailQueueMessage();

		$this->transportMock
			->expects($this->once())
			->method('send')
			->with(
				$this->identicalTo($message),
				$this->identicalTo(array())
			)
			->will($this->returnValue(5));

		$this->mailServiceMock
			->expects($this->once())
			->method('log')
			->with($message);

		$this->assertEquals(
			5,
			$this->subject->send($message)
		);
	}

	/**
	 * @test
	 */
	public function queueAllMessages (){
		ExtConf::set('queueAllMessages', '1');

		$message = $this->createMessage();

		$this->transportMock
			->expects($this->never())
			->method('send');

		$this->mailServiceMock
			->expects($this->once())
			->method('queue')
			->with($this->identicalTo($message))
			->will($this->returnValue(1));

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

		$this->transportMock
			->expects($this->once())
			->method('send')
			->with(
				$this->identicalTo($message),
				$this->identicalTo(array())
			)
			->will($this->returnValue(7));


		$this->mailServiceMock
			->expects($this->once())
			->method('log')
			->with(
				$this->identicalTo($message),
				$this->identicalTo(7),
				$this->identicalTo(array())
			);

		$this->assertEquals(
			7,
			$this->subject->send($message)
		);
	}

	protected function createMailQueueMessage (){
		return $this->createMessage('MONOGON\\QueueMailer\\Mail\\MailMessage');
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
