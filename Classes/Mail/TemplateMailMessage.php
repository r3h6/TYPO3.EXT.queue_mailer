<?php
namespace MONOGON\QueueMailer\Mail;

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

use Exception;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * TemplateMailMessage
 */
class TemplateMailMessage extends \TYPO3\CMS\Core\Mail\MailMessage{

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManager
	 * @inject
	 */
	protected $objectManager;

	/**
	 * [$configurationManager description]
	 * @var TYPO3\CMS\Extbase\Configuration\ConfigurationManager
	 * @inject
	 */
	protected $configurationManager;

	/**
	 * [$variables description]
	 * @var array
	 */
	protected $variables = array();

	/**
	 * @return void
	 */
	private function initializeMailer() {
		$this->mailer = GeneralUtility::makeInstance('MONOGON\\QueueMailer\\Mail\\Mailer');
	}

	/**
	 * Sends the message.
	 * Must overwrite this method for calling our initializeMailer method!
	 *
	 * @return integer the number of recipients who were accepted for delivery
	 * @author Karsten Dambekalns <karsten@typo3.org>
	 */
	public function send() {
		$this->initializeMailer();
		$this->sent = TRUE;
		$this->getHeaders()->addTextHeader('X-Mailer', $this->mailerHeader);
		return $this->mailer->send($this, $this->failedRecipients);
	}

	/**
	 * [queue description]
	 * @return boolean [description]
	 */
	public function queue (){
		$this->initializeMailer();
		$this->getHeaders()->addTextHeader('X-Mailer', $this->mailerHeader);
		return $this->mailer->queue($this, $this->failedRecipients);
	}

	/**
	 * [getVariables description]
	 * @return array [description]
	 */
	public function getVariables (){
		return $this->variables;
	}

	/**
	 * [setBodyFromTemplate description]
	 * @param string $templateName Template name
	 * @param array  $variables    [description]
	 * @param string $format html or text
	 * @return  TemplateMailMessage [description]
	 */
	public function setBodyFromTemplate ($templateName, $variables = array(), $format = NULL){
		$this->variables = $variables;
		if ($format === NULL || $format === 'text'){
			try {
				$content = $this->renderTemplate($templateName, $variables, 'txt');
				if ($content){
					$this->setBody($content, 'text/plain');
				}
			}catch (Exception $exception){
				$this->getLogger()->error($exception->getMessage());
			}
		}
		if ($format === NULL || $format === 'html'){
			try {
				$content = $this->renderTemplate($templateName, $variables, 'html');
				if ($content){
					$this->addPart($content, 'text/html');
				}
			} catch (Exception $exception){
				$this->getLogger()->error($exception->getMessage());
			}
		}
		return $this;
	}

	/**
	 * [renderTemplate description]
	 * @param  string $templateName Template name
	 * @param  array $variables
	 * @param  string $format       [description]
	 * @return string               [description]
	 */
	protected function renderTemplate ($templateName, $variables, $format){

//CONFIGURATION_TYPE_FRAMEWORK
		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$templateRootPath = GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);
		$templatePathAndFilename = $templateRootPath . 'MailMessage/' . $templateName . '.' . $format;


		$layoutRootPath = GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['layoutRootPath']);
		$partialRootPath = GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['partialRootPath']);
		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($extbaseFrameworkConfiguration);
		// \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($templateRootPath);

		/** @var \TYPO3\CMS\Fluid\View\StandaloneView $emailView */
		$emailView = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
		$emailView->setFormat($format);
		$emailView->setTemplatePathAndFilename($templatePathAndFilename);
		$emailView->setLayoutRootPath($layoutRootPath);
		$emailView->setPartialRootPath($partialRootPath);
		$emailView->assignMultiple($variables);
		return $emailView->render();
	}

	/**
	 * [getLogger description]
	 * @return TYPO3\CMS\Core\Log\LogManager
	 */
	protected function getLogger (){
		return GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Log\\LogManager')->getLogger(__CLASS__);
	}
}