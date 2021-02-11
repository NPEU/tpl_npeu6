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

JLoader::register('JHtmlUsers', JPATH_COMPONENT . '/helpers/html/users.php');
JHtml::register('users.spacer', array('JHtmlUsers', 'spacer'));

$fieldsets = $this->form->getFieldsets();
if (isset($fieldsets['core']))   unset($fieldsets['core']);
if (isset($fieldsets['params'])) unset($fieldsets['params']);

if (isset($fieldsets['freetext'])) {
    $freetext_title = $this->form->getField('freetext_title', 'profile')->value;
    $this->form->removeField('freetext_title', 'profile');
    #echo '<pre>'; var_dump($freetext_title); echo '</pre>';exit;
    $fieldsets['freetext']->label = $freetext_title;
}

#echo '<pre>'; var_dump($fieldsets); echo '</pre>';exit;
$staff_data_uri = 'https://' . $_SERVER['HTTP_HOST'] . '/data/staff?id=';

foreach ($fieldsets as $group => $fieldset): // Iterate through the form fieldsets
	$fields = $this->form->getFieldset($group);
	if (count($fields)): ?>

<?php if (isset($fieldset->label)): // If the fieldset has a label set, display it as the legend. ?>
<h2><?php echo JText::_($fieldset->label); ?></h2>
<?php endif; ?>
<div class="l-col-to-row--flush-edge-gutters  u-space--below">
	<dl class="l-col-to-row">
        <?php foreach ($fields as $field): ?>
        <?php #echo '<pre>'; var_dump($field); echo '</pre>'; ?>
        <?php if (!$field->hidden): ?>
		<dt class="ff-width-100--25--25 l-col-to-row__item"><?php echo preg_replace('/<br>.*/', '', $field->title); ?></dt>
		<dd class="ff-width-100--25--75 l-col-to-row__item  u-last-child--space--below--none">
		<?php if (JHtml::isRegistered('users.'.$field->id)): ?>
        <?php echo JHtml::_('users.'.$field->id, $field->value); ?>
		<?php elseif (JHtml::isRegistered('users.'.$field->fieldname)): ?>
        <?php echo JHtml::_('users.'.$field->fieldname, $field->value); ?>
		<?php elseif (JHtml::isRegistered('users.'.$field->type)): ?>
        <?php if($field->type == 'ImageEdit'): ?>
        <?php
        $src = JHtml::_('users.'.$field->type, $field->value);
        $separator = '?';
        if (strpos($src, '?') !== false) {
            $separator = '&';
        }
        echo preg_replace('/src="([^"]+)"/', 'src="$1' . $separator . time() . '"', $src); 
        ?>
        <?php else: ?>
        <?php echo JHtml::_('users.'.$field->type, $field->value); ?>
        <?php endif; ?>
        <?php else: ?>
        <?php if($field->type == 'Editor'): ?>
        <?php $val = $field->value; echo !empty($val) ? $val : JTEXT::_('COM_USERS_PROFILE_VALUE_NOT_FOUND'); ?>
        <?php elseif($field->type == 'Checkboxdefault'): ?>
        <?php echo str_replace(array('0', '1'), array('No', 'Yes'), $field->value); ?>
        <?php elseif($field->type == 'Staff'): ?>
        <?php
        if (is_array($field->value)) {
            
                
            foreach($field->value as $member_id) {
                $member = json_decode(file_get_contents($staff_data_uri . $member_id . '&basic=1'), true);
                echo '<p><a href="/people/' . $member[0]['alias'] . '"><span>' . $member[0]['firstname'] . ' ' . $member[0]['lastname'] . '</a></p>';
            }
        } else {
            if (is_numeric($field->value)) {
                $pa_data = json_decode(file_get_contents($staff_data_uri . $field->value . '&basic=1'), true);
                if (is_array($pa_data)) {#
                    echo '<p><a href="/people/' . $pa_data[0]['alias'] . '"><span>' . $pa_data[0]['firstname'] . ' ' . $pa_data[0]['lastname'] . '</a></p>';
                    continue;
                }
            }
            echo JTEXT::_('COM_USERS_PROFILE_VALUE_NOT_FOUND');
        }
        ?>
        <?php elseif($field->type == 'Projects'): ?>
        <?php
        if (is_array($field->value)) {
            
            $db    = JFactory::getDBO();
            $query = 'SELECT id, title, alias
                      FROM ' . $db->quoteName('#__categories') . '
                      WHERE extension = "com_content"
                      AND id IN(' . implode(',', $field->value) . ')
                      ORDER BY title;';
            $db->setQuery($query);
            $result = $db->loadAssocList();
            foreach ($result as $row) {
                echo '<p><a href="/' . $row['alias'] . '">' . $row['title'] .  '</a></p>';
            }
            
            /*$data_uri = 'https://' . $_SERVER['HTTP_HOST'] . '/data/staff?id=';
                
            foreach($field->value as $member_id) {
                $member = json_decode(file_get_contents($data_uri . $member_id), true);
                echo '<p><a href="/people/' . $member[0]['alias'] . '"><span>' . $member[0]['firstname'] . ' ' . $member[0]['lastname'] . '</a></p>';
            }*/
        } else {
            echo JTEXT::_('COM_USERS_PROFILE_VALUE_NOT_FOUND');
            
        }
        ?>
        <?php elseif (strpos($field->getAttribute('prefix', ''), 'http') !== false) : ?>
            <span style="padding-bottom: 1px;"><a href="<?php echo $field->getAttribute('prefix') . $field->value; ?>" target="_blank"><?php echo $field->value; ?></a></span>
        <?php else: ?>
        <?php echo JHtml::_('users.value', $field->value); ?>
        <?php endif; ?>
        <?php endif; ?>
		</dd>
		<?php endif; ?>
        <?php endforeach; ?>
	</dl>
</div>
<?php endif;?>
<?php endforeach;?>
