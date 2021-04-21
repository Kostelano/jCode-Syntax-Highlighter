<?php
/**
 * @package	jCode Syntax Highlighter
 * @author	Konstantin Kolos
 * @copyright	Copyright (C) 2019 - 2021 Jnotes.net.ua. All rights reserved
 * @contact	https://jnotes.net.ua, admin@jnotes.net.ua
 * @license	https://gnu.org/licenses/gpl-3.0.html, GNU/GPLv3
 */

defined('_JEXEC') or die;

class PlgContentjCodeSyntaxHighlighterInstallerScript
{
	const MIN_VERSION_JOOMLA = '3.9.0';
	const MIN_VERSION_PHP = '7.2.0';

	/**
	 * Name of extension that is used in the error message
	 *
	 * @var string
	 */
	protected $extensionName = 'jCode Syntax Highlighter';

	/**
	 * Checks compatibility in the preflight event
	 *
	 * @param $type
	 * @param $parent
	 *
	 * @return bool
	 * @throws Exception
	 */
	public function preflight($type, $parent)
	{
		if (!$this->checkVersionJoomla()) {
			return false;
		}

		if (!$this->checkVersionPhp()) {
			return false;
		}

		return true;
	}

	/**
	 * Checking the used version of Joomla
	 *
	 * @return bool
	 * @throws Exception
	 */
	private function checkVersionJoomla()
	{
		$version = new JVersion();

		if (!$version->isCompatible(self::MIN_VERSION_JOOMLA)) {
			JFactory::getApplication()->enqueueMessage(JText::sprintf('JN_ERROR_JOOMLA_VERSION', $this->extensionName, self::MIN_VERSION_JOOMLA), 'error');

			return false;
		}

		return true;
	}

	/**
	 * Checking the used version of PHP
	 *
	 * @return bool
	 * @throws Exception
	 */
	private function checkVersionPhp()
	{
		if (!version_compare(phpversion(), self::MIN_VERSION_PHP, 'ge')) {
			JFactory::getApplication()->enqueueMessage(JText::sprintf('JN_ERROR_PHP_VERSION', $this->extensionName, self::MIN_VERSION_PHP), 'error');

			return false;
		}

		return true;
	}
}
