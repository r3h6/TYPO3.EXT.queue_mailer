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

		// $this->testingFramework = new \Tx_Phpunit_Framework('tx_queuemailer');
		// $this->testingFramework->createFakeFrontEnd(0);

		$this->subject = new \MONOGON\QueueMailer\Mail\MailMessage();

		$objectManager = new \TYPO3\CMS\Extbase\Object\ObjectManager();
		$this->inject($this->subject, 'objectManager', $objectManager);


		$configurationManager = $objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');

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
		// $this->testingFramework->cleanUp();
		unset($this->subject, $this->testingFramework);
	}

	/**
	 * @test
	 */
	public function setTemplateBodyPlainText (){
		$this->subject->setTemplateBody('Example', array(), 'text');
		$this->assertRegExp('/Hello/', $this->subject->getBody());
	}

	/**
	 * @test
	 */
	public function setTemplateBodyHtml (){
		$this->subject->setTemplateBody('Example', array(), 'html');
		$children = $this->subject->getChildren();
		$this->assertRegExp('/<html>/', $children[0]->getBody());
	}

	/**
	 * @test
	 */
	public function setTemplateBodyAuto (){
		$this->subject->setTemplateBody('Example');
		$this->assertRegExp('/Hello/', $this->subject->getBody());
		$children = $this->subject->getChildren();
		$this->assertRegExp('/<html>/', $children[0]->getBody());
	}

	/**
	 * @test
	 */
	public function setTemplateVariables (){
		$variables = array('test' => 'Success');
		$this->subject->setTemplateBody('Example', $variables, 'text');
		$this->assertSame($variables, $this->subject->getVariables());
		$this->assertRegExp('/Success/', $this->subject->getBody());
	}
}
