<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_lbgallery
 *
 * @copyright   Copyright (C) 2015 Laurens Bakker. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

abstract class LBGalleryHelper
{

	public static function addSubmenu($vName)
	{
		
		JHtmlSidebar::addEntry(
			JText::_('COM_LBGALLERY_SUBMENU_ITEMS'),
			'index.php?option=com_lbgallery&view=items',
			$vName == 'items');

		JHtmlSidebar::addEntry(
			JText::_('COM_LBGALLERY_SUBMENU_CATEGORIES'),
			'index.php?option=com_categories&extension=com_lbgallery',
			$vName == 'categories');

		// Set some global property
		$document = JFactory::getDocument();
		
		if ($vName == 'categories') 
		{
			$document->setTitle(JText::_('COM_LBGALLERY_ADMINISTRATION_CATEGORIES'));
		}

	}

}
