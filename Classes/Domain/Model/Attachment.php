<?php
namespace MONOGON\QueueMailer\Domain\Model;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 R3 H6 <r3h6@outlook.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 * Attachment
 */
class Attachment extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * File
	 *
	 * @var string
	 */
	protected $identifier = '';

	/**
	 * Name
	 *
	 * @var string
	 */
	protected $name = '';

	/**
	 * Size (bytes)
	 *
	 * @var integer
	 */
	protected $size = 0;

	/**
	 * Data
	 *
	 * @var string
	 */
	protected $data = '';

	/**
	 * Returns the size
	 *
	 * @return integer $size
	 */
	public function getSize() {
		return $this->size;
	}

	/**
	 * Sets the size
	 *
	 * @param integer $size
	 * @return void
	 */
	public function setSize($size) {
		$this->size = $size;
	}

	/**
	 * Returns the data
	 *
	 * @return string $data
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * Sets the data
	 *
	 * @param string $data
	 * @return void
	 */
	public function setData($data) {
		$this->data = $data;
	}

	/**
	 * Returns the boolean state of isDummyRecord
	 *
	 * @return boolean
	 */
	public function isIsDummyRecord() {
		return $this->isDummyRecord;
	}

	/**
	 * Returns the identifier
	 *
	 * @return string identifier
	 */
	public function getIdentifier() {
		return $this->identifier;
	}

	/**
	 * Sets the identifier
	 *
	 * @param string $identifier
	 * @return void
	 */
	public function setIdentifier($identifier) {
		$this->identifier = $identifier;
	}

	/**
	 * Returns the name
	 *
	 * @return string name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

}