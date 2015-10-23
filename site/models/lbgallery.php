<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_lbgallery
 *
 * @copyright   Copyright (C) 2015 Laurens Bakker. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
class LBGalleryModelLBGallery extends JModelItem
{
	protected $album;
 
	public function getAlbum()
	{
		if (!isset($this->album))
		{
			$jinput = JFactory::getApplication()->input;
			$id     = $jinput->get('albumid', 1, 'INT');
 
			$this->album = $id;
		}
		return $this->album;
	}
}