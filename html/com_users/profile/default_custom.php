<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

use NPEU\Template\Npeu6\Site\Helper\Npeu6Helper as TplNPEU6Helper;

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
<h2><?php echo Text::_($fieldset->label); ?></h2>
<?php endif; ?>
<div class="l-layout  l-row  l-gutter  l-flush-edge-gutter  u-space--below ">
    <dl class="l-layout__inner  user-profile">
        <?php foreach ($fields as $field): ?>

        <?php
        if ($field->fieldname == 'room') {
            $room = $field->value;
            $room_url = strtolower(str_replace('/', '-', $room));
        }
        ?>

        <?php #echo '<pre>'; var_dump($field); echo '</pre>'; ?>
        <?php if (!$field->hidden): ?>
        <dt class="ff-width-100--25--25  l-box"><?php echo preg_replace('/<br>.*/', '', $field->title); ?></dt>
        <dd class="ff-width-100--25--75  l-box  u-last-child--space--below--none">
        <?php if (HTMLHelper::isRegistered('users.'.$field->id)): ?>
        <?php echo HTMLHelper::_('users.'.$field->id, $field->value); ?>
        <?php elseif (HTMLHelper::isRegistered('users.'.$field->fieldname)): ?>
        <?php echo HTMLHelper::_('users.'.$field->fieldname, $field->value); ?>
        <?php elseif (HTMLHelper::isRegistered('users.'.$field->type)): ?>
        <?php if($field->type == 'ImageEdit'): ?>
        <?php
        $src = HTMLHelper::_('users.'.$field->type, $field->value);
        $separator = '?';
        if (strpos($src, '?') !== false) {
            $separator = '&';
        }
        echo preg_replace('/src="([^"]+)"/', 'src="$1' . $separator . time() . '"', $src);
        ?>
        <?php else: ?>
        <?php echo HTMLHelper::_('users.'.$field->type, $field->value); ?>
        <?php endif; ?>
        <?php else: ?>
        <?php if ($field->type == 'Editor'): ?>
        <?php echo (strlen($field->value) == 0 ? Text::_('COM_USERS_PROFILE_VALUE_NOT_FOUND') : $field->value); ?>
        <?php elseif ($field->type == 'Checkboxdefault'): ?>
        <?php echo str_replace(['0', '1'], ['No', 'Yes'], $field->value); ?>
        <?php elseif ($field->type == 'Staff'): ?>
        <?php
        if (is_array($field->value)) {


            foreach($field->value as $member_id) {
                $member = json_decode(file_get_contents($staff_data_uri . $member_id . '&basic=1'), true);
                echo '<div><a href="/people/' . $member[0]['alias'] . '"><span>' . $member[0]['firstname'] . ' ' . $member[0]['lastname'] . '</a></div>';
            }
        } else {
            if (is_numeric($field->value)) {
                $pa_data = json_decode(file_get_contents($staff_data_uri . $field->value . '&basic=1'), true);
                if (is_array($pa_data)) {#
                    echo '<div><a href="/people/' . $pa_data[0]['alias'] . '"><span>' . $pa_data[0]['firstname'] . ' ' . $pa_data[0]['lastname'] . '</a></div>';
                    continue;
                }
            }
            echo Text::_('COM_USERS_PROFILE_VALUE_NOT_FOUND');
        }
        ?>
        <?php elseif($field->type == 'Projects'): ?>
        <?php
        if (is_array($field->value)) {

            $db    = Factory::getDBO();
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
            echo Text::_('COM_USERS_PROFILE_VALUE_NOT_FOUND');

        }
        ?>
        <?php elseif (strpos($field->getAttribute('prefix', ''), 'http') !== false) : ?>
            <span style="padding-bottom: 1px;"><a href="<?php echo $field->getAttribute('prefix') . $field->value; ?>" target="_blank"><?php echo $field->value; ?></a></span>
        <?php else: ?>
        <?php echo HTMLHelper::_('users.value', $field->value); ?>
        <?php endif; ?>
        <?php endif; ?>
        </dd>
        <?php endif; ?>
        <?php endforeach; ?>
    </dl>
</div>
<?php endif;?>
<?php endforeach;?>
<?php if (!empty($room)) : ?>
<h2>Individual Printable Resources</h2>
<div>
    <?php if (!empty($room)) : ?>
    <p>
        <a href="/printables/office-cards?room=<?php echo $room_url; ?>" target="_blank">Your Office Card (<?php echo $room; ?>)</a>
    </p>
    <?php endif; ?>
</div>
<?php endif; ?>