<?php
namespace MONOGON\QueueMailer\Tests\Unit\Configuration;
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

use MONOGON\QueueMailer\Configuration\ExtConf;

/**
 * Test case for class MONOGON\QueueMailer\Configuration\ExtConf.
 *
 * @author R3 H6 <r3h6@outlook.com>
 */
class ExtConfTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	protected $extConf = NULL;

	protected function setUp() {
		$this->extConf = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][ExtConf::EXT_KEY];
		$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][ExtConf::EXT_KEY] = serialize(array(
				'queueAllMessages' => '0',
				'logAllMessages' => '0',
			));
	}

	protected function tearDown() {
		$GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][ExtConf::EXT_KEY] = $this->extConf;
		unset($this->extConf);
	}

	/**
	 * @test
	 */
	public function get (){
		$this->assertEquals('0', ExtConf::get('queueAllMessages'));
	}

	/**
	 * @test
	 * @depends get
	 */
	public function set (){
		ExtConf::set('queueAllMessages', '1');
		$this->assertEquals('1', ExtConf::get('queueAllMessages'));
	}
}
