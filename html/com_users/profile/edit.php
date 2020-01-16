<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.6
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
#JHtml::_('behavior.tooltip');
#JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.noframes');
JHTML::_('behavior.modal');
//load user_profile plugin language
$lang = JFactory::getLanguage();
$lang->load( 'plg_user_profile', JPATH_ADMINISTRATOR );

require_once 'templates/npeu5/helpers.php';
#require_once JPATH_THEMES . '/npeu5/helpers.php';

$project = get_project();
$title   = $this->escape($this->params->get('page_heading'));

$heading_config = array(
	'title'   => $title,
	'project' => $project->alias,
    'project_name'  => $project->name,
    'flush_heading' => true
);



/*
$doc = JFactory::getDocument();
#echo '<pre>'; var_dump(get_class_methods($doc)); echo '</pre>';

$doc->addScript('/media/system/js/mootools-core.js');
$doc->addScript('/media/system/js/core.js');
$doc->addScript('/media/system/js/mootools-more.js');
$doc->addScript('/media/system/js/modal.js');

$doc->addStyleSheet('/media/system/css/modal.css');*/

$doc = JFactory::getDocument();
$style = array();
$style[] = '#sbox-overlay[aria-hidden="false"] {';
$style[] = '	background-color: #000000;';
$style[] = '    height: 3337px;';
$style[] = '    left: 0;';
$style[] = '    position: absolute;';
$style[] = '    top: -20px;';
$style[] = '    width: 100%;';
$style[] = '}';
$style[] = '#sbox-window[aria-hidden="false"] {';
$style[] = '	left: 50% !important;';
$style[] = '    margin-left: -350px;';
$style[] = '    position: fixed;';
$style[] = '    top: 50px !important;';
$style[] = '    padding: 0 !important;';
$style[] = '}';

$str = implode("\n", $style);

$doc->addStyleDeclaration($str);


$user        = JFactory::getUser();
#echo '<pre>'; var_dump($user); echo '</pre>';
$user_editor = $user->getParam('editor', false);
$j_config    = JFactory::getConfig();
if (!($j_config->get('editor') == 'ckeditorbasic' || $user_editor == 'ckeditorbasic')) {
    $script = array();

    $script[] = 'console.log(\'Joomla.editors.instances\', Joomla.editors.instances);';
    $script[] = 'var jeditors = Joomla.editors.instances;';

    $script[] = "jQuery(function() {";
    $script[] = "	jQuery('.profile_save').click(function(e){";
    $script[] = "	    jeditors['jform_profile_biography'].update();";
    $script[] = "	    jeditors['jform_profile_custom_content'].update();";
    $script[] = "	    jeditors['jform_profile_publications_manual'].update();";
    $script[] = "	});";
    $script[] = "});";
    
    $str = implode("\n", $script);
    $doc->addScriptDeclaration($str);
}
/*
$script = array();
$script[] = "jQuery(function() {";
$script[] = "    setTimeout(function(){";
$script[] = "       jQuery('[aria-required=true]').each(function(){jQuery(this).prop('required', true);})";
$script[] = "    }, 50);";
$script[] = "    jQuery('[required]').keyup(function(event) {";
$script[] = "        // Remove error classes when user starts typing:";
$script[] = "        jQuery(this).parent().removeClass('alert--error').prev().removeClass('alert--error');";
$script[] = "    });";
$script[] = "    jQuery('[required]').bind('invalid', function(event) {";
$script[] = "        console.log(jQuery(this));";
$script[] = "        var $this = jQuery(this)";
$script[] = "        setTimeout(function() { $this.parent().addClass('alert--error').prev().addClass('alert--error'); }, 50);";
//$script[] = "        //console.log('test', event);";
////$script[] = "        var n = jQuery(event.target).parents('fieldset').prevAll().length + 1";
//$script[] = "        var n = jQuery(event.target).parents('fieldset').prevAll().length";
//$script[] = "        console.log(n)";
//$script[] = "        var tab = jQuery(event.target).parents('form').find('.tabs li:nth-child(' + (n+1) + ') a')";
//$script[] = "        console.log(tab)";
//$script[] = "        //tab.tab('show')";
//$script[] = "        //tab.click()";
$script[] = "        ";
$script[] = "        ";
$script[] = "        ";

$script[] = "    });";
$script[] = "});";

$str = implode("\n", $script);
$doc->addScriptDeclaration($str);
*/

$script = array();
$script[] = "jQuery(function() {";
$script[] = "    window.setTimeout(function(){jQuery('[type=\"password\"]').val('')}, 10)";
$script[] = "});";

$str = implode("\n", $script);
$doc->addScriptDeclaration($str);

#exit;
/*
<style>
#sbox-overlay[aria-hidden="false"] {
	background-color: #000000;
    height: 3337px;
    left: 0;
    position: absolute;
    top: -20px;
    width: 100%;
}

#sbox-window[aria-hidden="false"] {
	left: 50% !important;
    margin-left: -350px;
    position: fixed;
    top: 50px !important;
}
</style>
*/
?>
<?php echo get_messages(); ?>
<div class="profile-edit<?php echo $this->pageclass_sfx?>">
    <?php if ($this->params->get('show_page_heading')) : ?>
    <?php echo heading($heading_config); ?>
    <?php endif; ?>

    <form id="member-profile" action="<?php echo JRoute::_('index.php?option=com_users&task=profile.save&redirect=user-profile/edit'); ?>" method="post" class="main-form  form-validate  Xtabs-form" enctype="multipart/form-data">
        <div class="text--center  alert">
            <p><?php echo JText::_('PLG_USER_STAFFPROFILE_COMPULSORY_MESSAGE'); ?></p>
        </div>
        
        <div class="Xtab-content" id="user_profile">
        <?php  /*<p><strong>Tip:</strong> hover your mouse over each field label to show more information on how to complete that field.</p>*/ ?>
        <?php $i = 0; foreach ($this->form->getFieldsets() as $group => $fieldset):// Iterate through the form fieldsets and display each one.?>
            <?php if ($group == 'params') { continue; } ?>
            <?php $fields = $this->form->getFieldset($group); $hidden = ''; $help = ''; ?>
            <?php if (count($fields)): ?>
            
            <fieldset class="Xtab-pane<?php echo $i == 0 ? '  in  active' : ''; ?>" id="fieldset<?php echo $i; ?>">
                <?php if (isset($fieldset->label)):// If the fieldset has a label set, display it as the legend.?>
                <legend class="Xtab-heading"><h2><?php echo JText::_($fieldset->label); ?></h2></legend>
                <p class="inline-form-controls">
                    <button <?php /*id="profile_save"*/ ?> type="submit" class="validate  btn  profile_save"><span><?php echo JText::_('JSAVE'); ?></span></button>
                    <span><?php echo JText::_('COM_USERS_OR'); ?>
                        <a class="" href="<?php echo JRoute::_('/user-profile'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
                    </span>
                </p>
                <?php endif; ?>
                <dl class="gw2"><!--
                <?php foreach ($fields as $field):// Iterate through the fields in the set and display them.?>
                <?php echo '<pre>'; var_dump($field->type); echo '</pre>'; ?>
                <?php if ($field->type == 'EditHelp'): ?>
                    <?php $help .= $field->input . "\n"; ?>
                <?php elseif ($field->type == 'EditMsg'): //editmsg ?>
                    --><dt class="visuallyhidden">Notice</dt><!--
                    --><dd class="text--center  alert"><?php echo clean_title($field->label); ?></dd><!--
                <?php elseif ($field->hidden): // If the field is hidden, just display the input. ?>
                    <?php $hidden .= $field->input . "\n"; ?>
                <?php else: ?>
                    --><dt class="g2 <?php echo $field->type == 'Editor' ? 'one-whole' : 'one-quarter'?>">
                        <?php if ($field->type == 'Gravatar' || $field->type == 'ImageEdit'): ?>
                        <?php echo preg_replace('/\sfor="[^"]+"/', '', clean_title($field->label)); ?>
                        <?php else: ?>
                        <?php echo clean_title($field->label); ?>
                        <?php endif; ?>
                    </dt><!--
                    --><dd class="g2  <?php echo $field->type == 'Editor' ? 'one-whole' : 'three-quarters'?>">
                        <?php if ($field->type == 'Editor' && $field->required): ?>
                        <?php echo preg_replace('/<textarea/', '<textarea class="required" required aria-required="true"', $field->input); ?>
                        <?php elseif ($field->type == 'Password'): ?>
                        <?php echo add_class(str_replace('autocomplete="off"', 'autocomplete="new-password"', $field->input), 'text-input'); ?>
                        <?php else: ?>
                        <?php echo in_array($field->type, array('Email', 'Text')) ? add_class($field->input, 'text-input') : $field->input; ?>
                        <?php endif; ?>
                    
                    
                    
                    
                    </dd><!--
                <?php endif; ?>
                <?php endforeach; ?>
                --></dl>
                <?php if (!empty($help)): ?>
                <?php echo $help; ?>
                <?php endif; ?>
                <?php if (!empty($hidden)): ?>
                <?php echo $hidden; ?>
                <?php endif; ?>

            </fieldset>
            <?php endif; ?>
        <?php $i++; endforeach; ?>
        </div>
        <?php /*<p class="text--center">
            <button id="profile_save" type="submit" class="validate  btn btn--primary"><span><?php echo JText::_('JSAVE'); ?></span></button>
            <?php echo JText::_('COM_USERS_OR'); ?>
            <a class="" href="<?php echo JRoute::_(''); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
        </p>*/ ?>
        <input type="hidden" name="option" value="com_users" />
        <input type="hidden" name="task" value="profile.save" />
        <input type="hidden" name="redirect" value="/user-profile-edit/" />
        <?php echo JHtml::_('form.token'); ?>
    </form>
</div>
