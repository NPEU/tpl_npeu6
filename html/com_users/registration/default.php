<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');

require_once 'templates/npeu5/helpers.php';

$heading_config = array(
	'title'   => $this->params->get('page_heading'),
	'project' => 'npeu',
    'project_name'  => 'NPEU',
    'flush_heading' => true
);

?>
<div class="registration<?php echo $this->pageclass_sfx?>">
    <?php if ($this->params->get('show_page_heading')) : ?>
    <?php echo heading($heading_config); ?>
    <?php endif; ?>


	<form id="member-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
<?php foreach ($this->form->getFieldsets() as $fieldset): // Iterate through the form fieldsets and display each one.?>
	<?php $fields = $this->form->getFieldset($fieldset->name);?>
	<?php if (count($fields)):?>
		<fieldset>
            <?php if (isset($fieldset->label)): // If the fieldset has a label set, display it as the legend. ?>
			<legend><?php echo JText::_($fieldset->label);?></legend>
            <?php endif;?>
            <dl class="gw2"><!--
            <?php foreach ($fields as $field) : // Iterate through the fields in the set and display them. ?>
			<?php if ($field->hidden): // If the field is hidden, just display the input. ?>
                <?php echo '-->' . $field->input . '<!--'; ?>
			<?php else:?>
                --><dt class="g2 one-quarter underline">
					<?php echo clean_title($field->label); ?>
				</dt><!--
				--><dd class="g2  three-quarters">
                    <?php echo in_array($field->type, array('Email', 'Text', 'Password')) ? add_class($field->input, 'text-input') : $field->input; ?>
				</dd><!--
			<?php endif;?>
            <?php endforeach;?>
            --></dl>
		</fieldset>
	<?php endif;?>
<?php endforeach;?>
		<p class="push--one-quarter">
			<button type="submit" class="btn btn--primary validate"><?php echo JText::_('JREGISTER');?></button>
            <?php echo JText::_('COM_USERS_OR'); ?>
			<a class="btn" href="<?php echo JRoute::_('');?>" title="<?php echo JText::_('JCANCEL');?>"><?php echo JText::_('JCANCEL');?></a>
			<input type="hidden" name="option" value="com_users" />
			<input type="hidden" name="task" value="registration.register" />
			<?php echo JHtml::_('form.token');?>
		</p>
	</form>
</div>
