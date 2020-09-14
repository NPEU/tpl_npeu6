<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

JLoader::register('TplNPEU6Helper', dirname(dirname(dirname(__DIR__))) . '/helper.php');

JHtml::_('behavior.keepalive');
#JHtml::_('behavior.tooltip');
#JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
#JHtml::_('behavior.noframes');
#return;
JHTML::_('behavior.modal');
//load user_profile plugin language
$lang = JFactory::getLanguage();
$lang->load( 'plg_user_profile', JPATH_ADMINISTRATOR );


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
#echo '<pre>'; var_dump($j_config); echo '</pre>'; exit;
if ($j_config->get('editor') == 'ckeditorbasic' || $user_editor == 'ckeditorbasic') {
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

$script = array();
$script[] = "jQuery(function() {";
$script[] = "    window.setTimeout(function(){jQuery('[type=\"password\"]').val('')}, 10)";
$script[] = "});";

$str = implode("\n", $script);
$doc->addScriptDeclaration($str);
#$doc->addScript('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');

#$doc->addStyleSheet('/media/system/css/modal.css');
$doc->addStyleSheet('/media/jui/css/chosen.css');


$page_head_data = $doc->getHeadData();

$doc->include_script = true;
$doc->include_joomla_scripts = true;
#echo '<pre>'; var_dump($page_head_data); echo '</pre>'; exit;
#exit;
?>
<?php #echo TplNPEU6Helper::get_messages(); ?>
<form id="member-profile" action="<?php echo JRoute::_('index.php?option=com_users&task=profile.save&redirect=user-profile/edit'); ?>" method="post" enctype="multipart/form-data">
    <div class="u-text-align--center  c-system-message  u-space--below">
        <p><?php echo JText::_('PLG_USER_STAFFPROFILE_COMPULSORY_MESSAGE'); ?></p>
    </div>
    
    <?php  /*<p><strong>Tip:</strong> hover your mouse over each field label to show more information on how to complete that field.</p>*/ ?>
    <?php $i = 0; foreach ($this->form->getFieldsets() as $group => $fieldset):// Iterate through the form fieldsets and display each one.?>
    <?php if ($group == 'params') { continue; } ?>
    <?php $fields = $this->form->getFieldset($group); $hidden = ''; $help = ''; ?>
    <?php if (count($fields)) : ?>
    
    <fieldset id="fieldset<?php echo $i; ?>">
        <?php if (isset($fieldset->label)):// If the fieldset has a label set, display it as the legend.?>
        <legend><h2><?php echo JText::_($fieldset->label); ?></h2></legend>
        <p class="u-text-align--right  u-space--below--none">
            <button <?php /*id="profile_save"*/ ?> type="submit" class=""><span><?php echo JText::_('JSAVE'); ?></span></button>
            <span><?php echo JText::_('COM_USERS_OR'); ?>
                <a class="" href="<?php echo JRoute::_('/user-profile'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
            </span>
        </p>
        <?php endif; ?>
        <div class="l-col-to-row">
            <?php foreach ($fields as $field):// Iterate through the fields in the set and display them.?>
            <?php #echo '<pre>'; var_dump($field->type); echo '</pre>'; ?>
            <?php if ($field->type == 'EditHelp'): ?>
            <div class="u-fill-width">
                <?php $help .= $field->input . "\n"; ?>
            </div>
            <?php elseif ($field->type == 'EditMsg'): //editmsg ?>
            <div hidden aria-hidden="false">Notice</div>
            <p class="u-text-align--center  c-system-message  u-fill-width"><?php echo TplNPEU6Helper::clean_title($field->label); ?></p>
            <?php elseif ($field->hidden): // If the field is hidden, just display the input. ?>
            <?php $hidden .= $field->input . "\n"; ?>
            <?php else: ?>
            <div class="l-col-to-row__item  u-padding--right <?php echo $field->type == 'Editor' ? 'u-fill-width' : 'ff-width-100--25--25'?>">
                <?php if ($field->type == 'Gravatar' || $field->type == 'ImageEdit'): ?>
                <?php echo preg_replace('/\sfor="[^"]+"/', '', TplNPEU6Helper::clean_title($field->label)); ?>
                <?php else: ?>
                <?php echo TplNPEU6Helper::clean_title($field->label); ?>
                <?php endif; ?>
            </div>
            <div class="l-col-to-row__item  <?php echo $field->type == 'Editor' ? 'u-fill-width  u-space--below' : 'ff-width-100--25--75'?>">
                <?php if ($field->type == 'Editor' && $field->required): ?>
                <?php echo preg_replace('/<textarea/', '<textarea class="required" required aria-required="true"', $field->input); ?>
                <?php elseif ($field->type == 'ImageEdit'): ?>
                <div>
                    <?php echo $field->input; ?>
                </div>
                <?php elseif ($field->type == 'Password'): ?>
                <?php #echo add_class(str_replace('autocomplete="off"', 'autocomplete="new-password"', $field->input), 'text-input'); ?>
                <?php echo str_replace('autocomplete="off"', 'autocomplete="new-password"', $field->input); ?>
                <?php else: ?>
                <?php #echo in_array($field->type, array('Email', 'Text')) ? add_class($field->input, 'text-input') : $field->input; ?>
                <?php echo $field->input; ?>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php if (!empty($help)): ?>
        <?php echo $help; ?>
        <?php endif; ?>
        <?php if (!empty($hidden)): ?>
        <?php echo $hidden; ?>
        <?php endif; ?>

    </fieldset>
    <?php endif; ?>
    <?php $i++; endforeach; ?>
    
    <input type="hidden" name="option" value="com_users" />
    <input type="hidden" name="task" value="profile.save" />
    <input type="hidden" name="redirect" value="/user-profile-edit/" />
    <?php echo JHtml::_('form.token'); ?>
</form>
