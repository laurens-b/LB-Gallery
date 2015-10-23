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

class LBGalleryViewItems extends JViewLegacy
{
	function display($tpl = null)
	{
		if ($this->getLayout() !== 'modal')
		{
			LBGalleryHelper::addSubmenu('items');
		}

		// Get data from the model
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
 
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
 
			return false;
		}
 
		// We don't need toolbar in the modal window.
		if ($this->getLayout() !== 'modal')
		{
			$this->addToolbar();
			$this->sidebar = JHtmlSidebar::render();
		}

		// Display the template
		parent::display($tpl);

		// Set the document properties
		$this->setDocument();

	}

	protected function addToolBar()
	{
		JToolBarHelper::title(JText::_('COM_LBGALLERY_MANAGER_ITEMS'), 'folder');
		JToolBarHelper::addNew('item.add');
		JToolBarHelper::editList('item.edit');
		JToolBarHelper::deleteList('', 'items.delete');
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() 
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_LBGALLERY_ADMINISTRATION'));
	}	

}