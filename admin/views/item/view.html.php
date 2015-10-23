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

class LBGalleryViewItem extends JViewLegacy
{
	protected $form = null;
 
	public function display($tpl = null)
	{
		// Get the Data
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');
		$this->script = $this->get('Script');
 
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
 
			return false;
		}
 
 		// Set the toolbar
		$this->addToolBar();
 
		// Display the template
		parent::display($tpl);

		// Set the document properties
		$this->setDocument();
	}
 
	protected function addToolBar()
	{
		$input = JFactory::getApplication()->input;
 
		// Hide Joomla Administrator Main menu
		$input->set('hidemainmenu', true);
 
		$isNew = ($this->item->id == 0);
 
		if ($isNew)
		{
			$title = JText::_('COM_LBGALLERY_MANAGER_ITEM_NEW');
		}
		else
		{
			$title = JText::_('COM_LBGALLERY_MANAGER_ITEM_EDIT');
		}
 
		JToolBarHelper::title($title, 'image');
		JToolBarHelper::save('item.save');
		JToolBarHelper::cancel(
			'item.cancel',
			$isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
		);
	}

	protected function setDocument() 
	{
		$isNew = ($this->item->id < 1);
		$document = JFactory::getDocument();
		$document->setTitle($isNew ? JText::_('COM_LBGALLERY_ITEM_CREATING') :
                JText::_('COM_LBGALLERY_ITEM_EDITING'));
		$document->addScript(JURI::root() . $this->script);
		$document->addScript(JURI::root() . "/administrator/components/com_lbgallery"
		                                  . "/views/item/submitbutton.js");
		JText::script('COM_LBGALLERY_ITEM_ERROR_UNACCEPTABLE');
	}

}