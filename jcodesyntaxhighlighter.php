<?php
/**
 * @package	jCode Syntax Highlighter
 * @author	Konstantin Kolos
 * @copyright	Copyright (C) 2019 - 2022 Jnotes.net.ua. All rights reserved
 * @contact	https://jnotes.net.ua, admin@jnotes.net.ua
 * @license	https://gnu.org/licenses/gpl-3.0.html, GNU/GPLv3
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Uri\Uri;

class PlgContentjCodeSyntaxHighlighter extends CMSPlugin
{
	public function onContentPrepare($context, &$article, &$params, $page = 0)
	{
		$regular = '/<pre class=".*language-.*>/i';
		preg_match_all($regular, $article->text, $matches, PREG_SET_ORDER);

		if ($matches)
		{
			$app = Factory::getApplication();

			if ($app->isClient('site'))
			{
				$document = Factory::getDocument();
				$document->addStyleSheet(Uri::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/css/' . $this->params->def('template', 'default'), array('version' => 'auto'));

				// Load styles file depending on a combination of parameters
				$combcss = $this->params->get('linenumbers', '1') . $this->params->get('previewers', '1');

				if ($combcss == '01') {
					$document->addStyleSheet(Uri::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/combined/previewers.css', array('version' => 'auto'));

				} else if ($combcss == '10') {
					$document->addStyleSheet(Uri::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/combined/linenumbers.css', array('version' => 'auto'));

				} else if ($combcss == '11') {
					$document->addStyleSheet(Uri::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/combined/linenumbers-previewers.css', array('version' => 'auto'));

				}

				// Load script file depending on a combination of parameters
				$combjs = $this->params->get('autolinker', '1') . $this->params->get('previewers', '1') . $this->params->get('buttoncopy', '1');

				if ($combjs == '000') {
					$document->addScript(Uri::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/js/prism.js', array('version' => 'auto'), array('async' => 'async'));

				} else if ($combjs == '001') {
					$document->addScript(Uri::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/js/prism-copy.js', array('version' => 'auto'), array('async' => 'async'));

				} else if ($combjs == '010') {
					$document->addScript(Uri::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/js/prism-previewers.js', array('version' => 'auto'), array('async' => 'async'));

				} else if ($combjs == '011') {
					$document->addScript(Uri::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/js/prism-previewers-copy.js', array('version' => 'auto'), array('async' => 'async'));

				} else if ($combjs == '100') {
					$document->addScript(Uri::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/js/prism-link.js', array('version' => 'auto'), array('async' => 'async'));

				} else if ($combjs == '101') {
					$document->addScript(Uri::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/js/prism-link-copy.js', array('version' => 'auto'), array('async' => 'async'));

				} else if ($combjs == '110') {
					$document->addScript(Uri::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/js/prism-link-previewers.js', array('version' => 'auto'), array('async' => 'async'));

				} else if ($combjs == '111') {
					$document->addScript(Uri::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/js/prism-link-previewers-copy.js', array('version' => 'auto'), array('async' => 'async'));

				}
			}
		}
	}
}
?>
