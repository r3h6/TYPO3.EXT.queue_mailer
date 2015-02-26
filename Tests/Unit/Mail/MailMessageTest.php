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


/**
 * Test case for class \MONOGON\QueueMailer\Mail\MailMessage.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author R3 H6 <r3h6@outlook.com>
 */
class MailMessageTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \MONOGON\QueueMailer\Mail\MailMessage
	 */
	protected $subject = NULL;

	protected $testingFramework;


	protected function setUp() {

		$this->testingFramework = new \Tx_Phpunit_Framework('tx_queuemailer');

		// $uid = $this->testingFramework->createFrontEndPage(0, array(
		// 	'title' => 'Test ' . date('c'),
		// ));
		// $this->testingFramework->createTemplate($uid, array(
		// 	'title' => 'Test ' . date('c'),
		// 	'include_static_file' => 'EXT:queue_mailer/Configuration/TypoScript/',
		// 	'root' => '1',
		// 	'clear' => '3',
		// 	// 'config' => 'test = 1',
		// ));
		// $this->testingFramework->createFakeFrontEnd($uid);
		$this->testingFramework->createFakeFrontEnd(0);


		$this->subject = new \MONOGON\QueueMailer\Mail\MailMessage();

		// $objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		$objectManager = new \TYPO3\CMS\Extbase\Object\ObjectManager();
		$this->inject($this->subject, 'objectManager', $objectManager);

		// $configurationManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');



		$configurationManager = $objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');

		// $configurationManager = new \TYPO3\CMS\Extbase\Configuration\ConfigurationManager();
		// $this->inject($configurationManager, 'objectManager', $objectManager);

		// $environmentServiceMock = $this->getMock('TYPO3\\CMS\\Extbase\\Service\\EnvironmentService', array('isEnvironmentInFrontendMode')); // , array(), '', FALSE
		// $environmentServiceMock
		// 	->method('isEnvironmentInFrontendMode')
		// 	->will($this->returnValue(TRUE));

		// $this->inject($configurationManager, 'environmentService', $environmentServiceMock);
		// $configurationManager->initializeObject();

		$configurationManager->setConfiguration(array(
			'view.' => array(
				'templateRootPath' => 'EXT:queue_mailer/Tests/Resources/Private/Templates/',
				'partialRootPath' => 'EXT:queue_mailer/Tests/Resources/Private/Partials/',
				'layoutRootPath' => 'EXT:queue_mailer/Tests/Resources/Private/Layouts/',
			),
		));

		$this->inject($this->subject, 'configurationManager', $configurationManager);


	}

	protected function tearDown() {
		$this->testingFramework->cleanUp();
		unset($this->subject, $this->testingFramework);
	}

	/**
	 * @test
	 */
	public function setTemplateBodyPlainText (){
		$this->subject->setTemplateBody('Example', array(), 'text');
		$body = $this->subject->toString();
	}

	/**
	 * @test
	 */
	public function setTemplateBodyHtml (){
		$this->subject->setTemplateBody('Example', array(), 'html');
		$body = $this->subject->toString();
	}

	/**
	 * @test
	 */
	public function setTemplateBodyAuto (){
		$this->subject->setTemplateBody('Example');
		$body = $this->subject->toString();
	}
}
