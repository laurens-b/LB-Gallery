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
 
// Require helper file
JLoader::register('LBGalleryHelper', JPATH_COMPONENT . '/helpers/lbgallery.php');
 
// Get an instance of the controller
$controller = JControllerLegacy::getInstance('LBGallery');
 
// Perform the Request task
$controller->execute(JFactory::getApplication()->input->get('task'));
 
// Redirect if set by the controller
$controller->redirect();