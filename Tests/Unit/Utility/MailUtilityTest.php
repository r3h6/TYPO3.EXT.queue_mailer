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

use MONOGON\QueueMailer\Utility\MailUtility;

/**
 * Test case for class \MONOGON\QueueMailer\Utility\MailUtility.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author R3 H6 <r3h6@outlook.com>
 */
class MailUtilityTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {


	protected function setUp() {}

	protected function tearDown() {}

	/**
	 * @test
	 */
	public function queue (){
		$this->markTestIncomplete("Not yet implemented!");
		// $this->assertTrue(MailUtility::queue(function ($message){
		// 	$message
		// 		->setTo(array('r3h6@outlook' => 'R3 H6'))
		// 		->setSubject('Test')
		// 		->setBody('Curabitur ligula sapien tincidunt non.');
		// }));
	}
}
