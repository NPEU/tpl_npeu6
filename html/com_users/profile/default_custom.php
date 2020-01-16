<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.6
 */
defined('_JEXEC') or die;

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

foreach ($fieldsets as $group => $fieldset): // Iterate through the form fieldsets
	$fields = $this->form->getFieldset($group);
	if (count($fields)): ?>
<section class="profile-set--custom  atoll  atoll--npeu  one-whole">
	<?php if (isset($fieldset->label)): // If the fieldset has a label set, display it as the legend. ?>
	<h2><?php echo JText::_($fieldset->label); ?></h2>
	<?php endif; ?>
	<dl class="gw2"><!--
        <?php foreach ($fields as $field): echo '<pre>'; var_dump($field->type); echo '</pre>'; ?>
        <?php if (!$field->hidden): ?>
		--><dt class="g2  one-quarter"><?php echo preg_replace('/<br>.*/', '', $field->title); ?></dt><!--
		--><dd class="g2  three-quarters">
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
                $data_uri = 'https://' . $_SERVER['HTTP_HOST'] . '/data/staff?id=';
                    
                foreach($field->value as $member_id) {
                    $member = json_decode(file_get_contents($data_uri . $member_id), true);
                    echo '<p><a href="/people/' . $member[0]['alias'] . '"><span>' . $member[0]['firstname'] . ' ' . $member[0]['lastname'] . '</a></p>';
                }
            } else {
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
        <?php else: ?>
            <?php echo JHtml::_('users.value', $field->value); ?>
            <?php endif; ?>
        <?php endif; ?>
		</dd><!--
		<?php endif; ?>
        <?php endforeach; ?>
	--></dl>
</section>
	<?php endif;?>
<?php endforeach;?>
