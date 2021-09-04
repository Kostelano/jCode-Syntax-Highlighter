<?php
/**
 * @package	Joomla.Platform
 * @subpackage	Content.jCodeSyntaxHighlighter
 *
 * @copyright	Copyright (C) 2005 - 2021 Open Source Matters, Inc. <https://www.joomla.org>
 * @license	GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormField;

/**
 * Form Field class for the Joomla Platform
 * Supports a one line text field
 *
 * @link    https://html.spec.whatwg.org/multipage/input.html#input.text
 * @since   11.1
 */
class JFormFieldjCodeSyntaxHighlighter extends FormField
{
	/**
	 * The form field type
	 *
	 * @var     string
	 * @since   11.1
	 */
	protected $type = 'jcodesyntaxhighlighter';

	/**
	 * Name of the layout being used to render the field
	 *
	 * @var     string
	 * @since   3.7
	 */
	protected $layout = 'joomla.form.field.jcodesyntaxhighlighter';

	/**
	 * Method to attach a JForm object to the field
	 *
	 * @param   \SimpleXMLElement  $element  The SimpleXMLElement object representing the <field> tag for the form field object
	 * @param   mixed              $value    The form field value to validate
	 * @param   string             $group    The field name group control value. This acts as an array container for the field
	 *                                       For example if the field has name="foo" and the group value is set to "bar" then the
	 *                                       full field name would end up being "bar[foo]"
	 *
	 * @return  boolean  True on success
	 *
	 * @see     \Joomla\CMS\Form\FormField::setup()
	 * @since   3.9.1
	 */
	public function setup(\SimpleXMLElement $element, $value, $group = null)
	{
		$result = parent::setup($element, $value, $group);

		return $result;
	}

	/**
	 * Method to get the field input markup
	 *
	 * @return  string  The field input markup
	 * @since   11.1
	 */
	protected function getInput()
	{
		$display = 'display_' . $this->getAttribute('display', '');

		if (method_exists($this, $display))
		{
			$output = $this->$display();

		} else {
			$ouput = '';

		}

		return $output;
	}

	private function display_jtext()
	{
		$output = '<p>' . JText::_($this->getAttribute('value')) . '</p>';

		return $output;		
	}

	private function display_changelog()
	{
		jimport('joomla.filesystem.file');
		$output = JPATH_PLUGINS . '/content/jcodesyntaxhighlighter/changelog/changelog';

		$lang = substr(Factory::getLanguage()->getTag(), 0, 2);
		$file = $output . '_' . $lang . '.txt';

		if (!file_exists($file))
		{
			$file = $output . '.txt';
		}

		if (file_exists($file))
		{
			$output = @file_get_contents($file);

		} else {
			$output = '';

		}

		$output = '<pre style="display: inline-block; width: 98%; overflow: visible;">' .$output. '</pre>';

		return $output;
	}
}
