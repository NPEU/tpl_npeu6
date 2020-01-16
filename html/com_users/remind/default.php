<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

//JHtml::_('behavior.keepalive');
//JHtml::_('behavior.formvalidation');

require_once realpath(dirname(__FILE__) . '/../../../') . '/helpers.php';
$session = JFactory::getSession();

$project = get_project();
$title   = $this->escape($this->params->get('page_heading'));

$heading_config = array(
	'title'   => $title,
	'project' => $project->alias,
    'project_name'  => $project->name,
    'flush_heading' => true
);
?>
<section>
    <?php if ($this->params->get('show_page_heading')) : ?>
    <?php echo heading($heading_config); ?>
    <?php endif; ?>
    <?php echo get_messages(); ?>
    <form action="<?php echo JRoute::_('index.php?option=com_users&task=remind.remind'); ?>" method="post" class="centred one-half palm-one-whole lap-three-fifths">
        <fieldset>
            <?php foreach ($this->form->getFieldsets() as $fieldset) : ?>
            <p><?php echo JText::_($fieldset->label); ?></p>
            <ol class="form-fields">
                <?php foreach ($this->form->getFieldset($fieldset->name) as $name => $field) : ?>
                <li class="inline-fields">
                    <?php
                        $label = add_classes(clean_title($field->label), 'text--right palm-text--left one-third');
                        $input = add_classes(preg_replace('#\s?size="\d+"#', '', $field->input), 'text-input two-thirds');
                    ?>
                    <?php echo $label; ?>
                    <?php echo $input; ?>
                </li>
                <?php endforeach; ?>
            </ol>
            <?php endforeach; ?>
            <button class="btn  btn--primary  push--one-third" type="submit"><?php echo JText::_('JSUBMIT'); ?></button>
            <?php echo JHtml::_('form.token'); ?>
        </fieldset>
    </form>
</section>
<?php remove_joomla_scripts(); ?>