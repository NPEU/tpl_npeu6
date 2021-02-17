<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

//load user_profile plugin language
$lang = JFactory::getLanguage();
$lang->load( 'plg_user_profile', JPATH_ADMINISTRATOR );

$doc = JFactory::getDocument();

JLoader::register('TplNPEU6Helper', dirname(dirname(dirname(__DIR__))) . '/helper.php');

// For now, jQuery is required by CKEditor Footnotes, WYM, and ...
#$jquery = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname(dirname(dirname(__DIR__)))) . '/js/jquery-3.5.1.min.js';
#$doc->addScript($jquery);



JHtml::_('behavior.keepalive');

#JHtml::_('behavior.tooltip');
#JHtml::_('behavior.formvalidation');
####JHtml::_('formbehavior.chosen', 'select');
#JHtml::_('behavior.noframes');
#return;
JHTML::_('behavior.modal');

JHtml::_('jquery.ui', array('core', 'sortable'));
JHtml::_('script', 'system/subform-repeatable.js', array('version' => 'auto', 'relative' => true));

/*
$doc = JFactory::getDocument();
#echo '<pre>'; var_dump(get_class_methods($doc)); echo '</pre>';

$doc->addScript('/media/system/js/mootools-core.js');
$doc->addScript('/media/system/js/core.js');
$doc->addScript('/media/system/js/mootools-more.js');
$doc->addScript('/media/system/js/modal.js');

$doc->addStyleSheet('/media/system/css/modal.css');*/







$style = array();
$style[] = '#sbox-overlay[aria-hidden="false"] {';
$style[] = '    background-color: #000000;';
$style[] = '    height: 3337px;';
$style[] = '    left: 0;';
$style[] = '    position: absolute;';
$style[] = '    top: -20px;';
$style[] = '    width: 100%;';
$style[] = '}';
$style[] = '#sbox-window[aria-hidden="false"] {';
$style[] = '    left: 50% !important;';
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
    $script[] = "   jQuery('.profile_save').click(function(e){";
    $script[] = "       jeditors['jform_profile_biography'].update();";
    $script[] = "       jeditors['jform_profile_custom_content'].update();";
    $script[] = "       jeditors['jform_profile_publications_manual'].update();";
    $script[] = "   });";
    $script[] = "});";
    
    $str = implode("\n", $script);
    $doc->addScriptDeclaration($str);
}

#$script = array();
#$script[] = "jQuery(function() {";
#$script[] = "    window.setTimeout(function(){jQuery('[type=\"password\"]').val('')}, 10)";
#$script[] = "});";
#
#$str = implode("\n", $script);
#$doc->addScriptDeclaration($str);



$doc->addStyleSheet('/media/system/css/modal.css');
###$doc->addStyleSheet('/media/jui/css/chosen.css');


$page_head_data = $doc->getHeadData();

$doc->include_script = true;
$doc->include_joomla_scripts = true;
#echo '<pre>'; var_dump($page_head_data); echo '</pre>'; exit;
#exit;
include(dirname(dirname(dirname(__DIR__))) . '/layouts/partial-slimselect.php');

?>
<?php #echo TplNPEU6Helper::get_messages(); ?>
<form id="member-profile" action="<?php echo JRoute::_('index.php?option=com_users&task=profile.save&redirect=user-profile/edit'); ?>" method="post" enctype="multipart/form-data">
    <div class="u-text-align--center  c-system-message  u-space--below">
        <p><?php echo JText::_('PLG_USER_STAFFPROFILE_COMPULSORY_MESSAGE'); ?></p>
    </div>
    
    <?php  /*<p><strong>Tip:</strong> hover your mouse over each field label to show more information on how to complete that field.</p>*/ ?>
    <?php $i = 0; foreach ($this->form->getFieldsets() as $group => $fieldset):// Iterate through the form fieldsets and display each one.?>
    <?php #echo '<pre>'; var_dump($fieldset); echo '</pre>'; ?>
    <?php if ($group == 'params') { continue; } ?>
    <?php $fields = $this->form->getFieldset($group); $hidden = ''; $help = ''; ?>
    <?php if (count($fields)) : ?>
    
    <?php if ($fieldset->name == 'whatson-prefs') : $keys = array_keys($fields); ?>
    <?php #echo '<pre>'; var_dump($fields); echo '</pre>'; ?>
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
            <div class="l-col-to-row__item  ff-width-100--30--20">
                <div class="u-padding--xs">
                    <?php echo $fields[$keys[0]]->label; ?><br>
                    <?php echo $fields[$keys[0]]->input . "\n"; ?>
                </div>
            </div>
            <div class="l-col-to-row__item  ff-width-100--30--20">
                <div class="u-padding--xs">
                    <?php echo $fields[$keys[1]]->label; ?><br>
                    <?php echo $fields[$keys[1]]->input . "\n"; ?>
                </div>
            </div>
            <div class="l-col-to-row__item  ff-width-100--30--20">
                <div class="u-padding--xs">
                    <?php echo $fields[$keys[2]]->label; ?><br>
                    <?php echo $fields[$keys[2]]->input . "\n"; ?>
                </div>
            </div>
            <div class="l-col-to-row__item  ff-width-100--30--20">
                <div class="u-padding--xs">
                    <?php echo $fields[$keys[3]]->label; ?><br>
                    <?php echo $fields[$keys[3]]->input . "\n"; ?>
                </div>
            </div>
            <div class="l-col-to-row__item  ff-width-100--30--20">
                <div class="u-padding--xs">
                    <?php echo $fields[$keys[4]]->label; ?><br>
                    <?php echo $fields[$keys[4]]->input . "\n"; ?>
                </div>
            </div>
        </div>
        <details class="sh-naked-details">
            <summary><?php echo JText::_('PLG_USER_STAFFPROFILE_WHATSON_FIELD_WEEK2_LABEL'); ?></summary>
            <p><?php echo JText::_('PLG_USER_STAFFPROFILE_WHATSON_FIELD_WEEK2_DESC'); ?></p>
            <div class="l-col-to-row">
                <div class="l-col-to-row__item  ff-width-100--30--20">
                    <div class="u-padding--xs">
                        <?php echo $fields[$keys[5]]->label; ?><br>
                        <?php echo $fields[$keys[5]]->input . "\n"; ?>
                    </div>
                </div>
                <div class="l-col-to-row__item  ff-width-100--30--20">
                    <div class="u-padding--xs">
                        <?php echo $fields[$keys[6]]->label; ?><br>
                        <?php echo $fields[$keys[6]]->input . "\n"; ?>
                    </div>
                </div>
                <div class="l-col-to-row__item  ff-width-100--30--20">
                    <div class="u-padding--xs">
                        <?php echo $fields[$keys[7]]->label; ?><br>
                        <?php echo $fields[$keys[7]]->input . "\n"; ?>
                    </div>
                </div>
                <div class="l-col-to-row__item  ff-width-100--30--20">
                    <div class="u-padding--xs">
                        <?php echo $fields[$keys[8]]->label; ?><br>
                        <?php echo $fields[$keys[8]]->input . "\n"; ?>
                    </div>
                </div>
                <div class="l-col-to-row__item  ff-width-100--30--20">
                    <div class="u-padding--xs">
                        <?php echo $fields[$keys[9]]->label; ?><br>
                        <?php echo $fields[$keys[9]]->input . "\n"; ?>
                    </div>
                </div>
            </div>
        </details>
    </fieldset>
    <?php else : ?>
    
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
            <?php $prefix = $field->getAttribute('prefix', false); ?>
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
                <?php if ($prefix): ?><span class="c-composite"><span><?php echo $prefix; ?></span><?php endif; ?>
                <?php echo $field->input; ?>
                <?php if ($prefix): ?></span><?php endif; ?>
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
    <?php endif; ?>
    <?php $i++; endforeach; ?>
    
    <input type="hidden" name="option" value="com_users" />
    <input type="hidden" name="task" value="profile.save" />
    <input type="hidden" name="redirect" value="/user-profile-edit/" />
    <?php echo JHtml::_('form.token'); ?>
</form>
