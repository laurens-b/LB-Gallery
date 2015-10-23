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

?>
<form action="<?php echo JRoute::_('index.php?option=com_lbgallery&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm">
    <?php echo JLayoutHelper::render('joomla.edit.title_alias', $this); ?>
    <div class="form-horizontal">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_LBGALLERY_ITEM_DETAILS'); ?></legend>
            <div class="row-fluid">
				<div class="span9">
					<fieldset class="adminform">
						<?php echo $this->form->renderField('path'); ?>
						<?php echo JLayoutHelper::render('joomla.edit.publishingdata', $this); ?>
					</fieldset>
				</div>
				<div class="span3">
					<?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
				</div>
        	</div>
        </fieldset>
    </div>
    <input type="hidden" name="task" value="item.edit" />
    <?php echo JHtml::_('form.token'); ?>
</form>