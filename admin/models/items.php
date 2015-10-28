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
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @since   1.6
	 * @see     JController
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'i.id',
				'title', 'i.title',
				'alias', 'i.alias',
				'catid', 'i.catid', 'category_title',
				'state', 'i.state',
				'created', 'i.created',
				'ordering', 'i.ordering',
				'published', 'i.published',
				'category_id',
				'level'
			);
		}

		parent::__construct($config);
	}
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

		// Add search filter
		$search = $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		// Add published state filter
		$published = $this->getUserStateFromRequest($this->context . '.filter.published', 'filter_published', '');
		$this->setState('filter.published', $published);

		// Add category filter
		$categoryId = $this->getUserStateFromRequest($this->context . '.filter.category_id', 'filter_category_id');
		$this->setState('filter.category_id', $categoryId);

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

		// Join over the categories.
		$query->select('c.title AS category_title')
			->join('LEFT', '#__categories AS c ON c.id = i.catid');

		// Filter by published state
		$published = $this->getState('filter.published');

		if (is_numeric($published))
		{
			$query->where('i.published = ' . (int) $published);
		}
		elseif ($published === '')
		{
			$query->where('(i.published = 0 OR i.published = 1)');
		}

		// Filter by search in title.
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where('i.id = ' . (int) substr($search, 3));
			}
			else
			{
				$search = $db->quote('%' . str_replace(' ', '%', $db->escape(trim($search), true) . '%'));
				$query->where('(i.title LIKE ' . $search . ' OR i.alias LIKE ' . $search . ')');
			}
		}

		// Add the list ordering clause.
		$orderCol = $this->state->get('list.ordering', 'i.id');
		$orderDirn = $this->state->get('list.direction', 'desc');

		if ($orderCol == 'i.ordering' || $orderCol == 'category_title')
		{
			$orderCol = 'c.title ' . $orderDirn . ', i.ordering';
		}

		$query->order($db->escape($orderCol . ' ' . $orderDirn));

		return $query;

	}
}