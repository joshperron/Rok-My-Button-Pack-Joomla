<?php
/**
* @version		$Id: myremotesite.php $
* @package		myremotesite
* @copyright	Copyright (C) 2008 - 2012 dailyfidelity, LLC. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

/**
 * Editor myremotesite buton
 *
 * @package Editors-xtd
 * @since 1.5
 */
class plgButtonmyremotesite extends JPlugin
{
	/**
	 * Constructor
	 *
	 * For php4 compatability we must not use the __constructor as a constructor for plugins
	 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
	 * This causes problems with cross-referencing necessary for the observer design pattern.
	 *
	 * @param object $subject The object to observe
	 * @param 	array  $config  An array that holds the plugin configuration
	 * @since 1.5
	 */
	function plgButtonmyremotesite(& $subject, $config)
	{
		parent::__construct($subject, $config);
	}

	/**
	 * @return array A two element array of ( imageName, textToInsert )
	 */
	function onDisplay($name)
	{
		global $mainframe;

		$doc 		=& JFactory::getDocument();
		$template 	= $mainframe->getTemplate();

		// button is not active in specific content components

		$getContent = $this->_subject->getContent($name);
		$js = "
			function insertmyremotesite(editor) {
				jInsertEditorText(\"{rokbox title=| TITLE HERE | size=|WIDTH HEIGHT| thumb=|images/location.jpg| album=| ALBUMTITLE|}http://www.urltoimage.com/image.jpg{/rokbox}\", editor);
			}
			";

		$doc->addScriptDeclaration($js);

		$button = new JObject();
		$button->set('modal', false);
		$button->set('onclick', 'insertmyremotesite(\''.$name.'\');return false;');
		$button->set('text', JText::_('RemoteSite'));
		$button->set('name', 'readmore');
		// TODO: The button writer needs to take into account the javascript directive
		//$button->set('link', 'javascript:void(0)');
		$button->set('link', '#');

		return $button;
	}
}