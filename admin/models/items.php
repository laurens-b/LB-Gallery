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

class LBGalleryModelItems extends JModelList
{
	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   An optional ordering field.
	 * @param   string  $direction  An optional direction (asc|desc).
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication();

		// Adjust the context to support modal layouts.
		if ($layout = $app->input->get('layout'))
		{
			$this->context .= '.' . $layout;
		}

		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		//$access = $this->getUserStateFromRequest($this->context . '.filter.access', 'filter_access');
		//$this->setState('filter.access', $access);

		//$authorId = $app->getUserStateFromRequest($this->context . '.filter.author_id', 'filter_author_id');
		//$this->setState('filter.author_id', $authorId);

		$published = $this->getUserStateFromRequest($this->context . '.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);

		$categoryId = $this->getUserStateFromRequest($this->context . '.filter.category_id', 'filter_category_id');
		$this->setState('filter.category_id', $categoryId);

		//$level = $this->getUserStateFromRequest($this->context . '.filter.level', 'filter_level');
		//$this->setState('filter.level', $level);

		//$language = $this->getUserStateFromRequest($this->context . '.filter.language', 'filter_language', '');
		//$this->setState('filter.language', $language);

		//$tag = $this->getUserStateFromRequest($this->context . '.filter.tag', 'filter_tag', '');
		//$this->setState('filter.tag', $tag);

		// List state information.
		parent::populateState('i.id', 'desc');
	}

	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return      string  An SQL query
	 */
	protected function getListQuery()
	{
		// Initialize variables.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);
 
		// Create the base select statement.
		$query->select(
			$this->getState('list.select', 'i.id, i.catid, i.alias, i.title, i.path, i.created, i.published, i.ordering'));
        $query->from('#__lbgallery_items AS i');
        $query->order('ordering', 'desc');
 
		return $query;
	}
}