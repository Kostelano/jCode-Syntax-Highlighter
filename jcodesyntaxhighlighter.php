<?php
/**
 * @package	jCode Syntax Highlighter
 * @author	Konstantin Kolos
 * @copyright	Copyright (C) 2019-2020 Jnotes.net.ua. All rights reserved
 * @contact	http://jnotes.net.ua, admin@jnotes.net.ua
 * @license	http://gnu.org/licenses/gpl-3.0.html, GNU/GPLv3
**/

defined('_JEXEC') or die;

class plgContentjCodeSyntaxHighlighter extends JPlugin
{
	public function onContentPrepare($context, &$article, &$params, $page = 0)
	{
		$regex = '/<pre class=".*language-.*>/i';
		preg_match_all($regex, $article->text, $matches, PREG_SET_ORDER);

		if ($matches)
		{
			$app = JFactory::getApplication();

			if ($app->isClient('site'))
			{
				$document = JFactory::getDocument();
				$document->addStyleSheet(JURI::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/css/' . $this->params->def('template', 'default') . '.css', array('version' => 'auto'));

				$combcss = $this->params->get('linenumbers', '1') . $this->params->get('previewers', '1');

				if ($combcss == '01') {
					$document->addStyleSheet(JURI::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/css/previewers.css', array('version' => 'auto'));

				} else if ($combcss == '10') {
					$document->addStyleSheet(JURI::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/css/linenumbers.css', array('version' => 'auto'));

				} else if ($combcss == '11') {
					$document->addStyleSheet(JURI::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/css/linenumbers-previewers.css', array('version' => 'auto'));

				}

				$combjs = $this->params->get('autolinker', '1') . $this->params->get('previewers', '1') . $this->params->get('buttoncopy', '1');

				if ($combjs == '000') {
					$document->addScript(JURI::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/js/prism.js', array('version' => 'auto'), array('async' => 'async'));

				} else if ($combjs == '001') {
					$document->addScript(JURI::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/js/prism-copy.js', array('version' => 'auto'), array('async' => 'async'));

				} else if ($combjs == '010') {
					$document->addScript(JURI::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/js/prism-previewers.js', array('version' => 'auto'), array('async' => 'async'));

				} else if ($combjs == '011') {
					$document->addScript(JURI::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/js/prism-previewers-copy.js', array('version' => 'auto'), array('async' => 'async'));

				} else if ($combjs == '100') {
					$document->addScript(JURI::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/js/prism-link.js', array('version' => 'auto'), array('async' => 'async'));

				} else if ($combjs == '101') {
					$document->addScript(JURI::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/js/prism-link-copy.js', array('version' => 'auto'), array('async' => 'async'));

				} else if ($combjs == '110') {
					$document->addScript(JURI::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/js/prism-link-previewers.js', array('version' => 'auto'), array('async' => 'async'));

				} else if ($combjs == '111') {
					$document->addScript(JURI::base($pathonly = true) . '/media/plg_content_jcodesyntaxhighlighter/js/prism-link-previewers-copy.js', array('version' => 'auto'), array('async' => 'async'));

				}
			}
		}
	}
}
?>
