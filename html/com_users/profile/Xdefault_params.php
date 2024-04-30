<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       1.6
 */
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
/*
JLoader::register('HTMLHelperUsers', JPATH_COMPONENT . '/helpers/html/users.php');
HTMLHelper::register('users.spacer', ['HTMLHelperUsers', 'spacer']);
HTMLHelper::register('users.helpsite', ['HTMLHelperUsers', 'helpsite']);
HTMLHelper::register('users.templatestyle', ['HTMLHelperUsers', 'templatestyle']);
HTMLHelper::register('users.admin_language', ['HTMLHelperUsers', 'admin_language']);
HTMLHelper::register('users.language', ['HTMLHelperUsers', 'language']);
HTMLHelper::register('users.editor', ['HTMLHelperUsers', 'editor']);
*/
?>
<p>HERE</p>
<?php $fields = $this->form->getFieldset('params'); ?>
<?php if (count($fields)): ?>
<section class="profile-set  g  atoll  one-whole">
    <h2><?php echo Text::_('COM_USERS_SETTINGS_FIELDSET_LABEL'); ?></h2>
    <dl class="gw2">
    <?php foreach ($fields as $field):
        if (!$field->hidden) :?>
        <dt class="g2 one-quarter"><?php echo $field->title; ?></dt>
        <dd class="g2 three-quarters">
            <?php if (HTMLHelper::isRegistered('users.'.$field->id)):?>
                <?php echo HTMLHelper::_('users.'.$field->id, $field->value);?>
            <?php elseif (HTMLHelper::isRegistered('users.'.$field->fieldname)):?>
                <?php echo HTMLHelper::_('users.'.$field->fieldname, $field->value);?>
            <?php elseif (HTMLHelper::isRegistered('users.'.$field->type)):?>
                <?php echo HTMLHelper::_('users.'.$field->type, $field->value);?>
            <?php else:?>
                <?php echo HTMLHelper::_('users.value', $field->value);?>
            <?php endif;?>
        </dd>
        <?php endif;?>
    <?php endforeach;?>
    </dl>
</section>
<?php endif;?>
