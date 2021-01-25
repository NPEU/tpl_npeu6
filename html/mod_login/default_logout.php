<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) NPEU 2020.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;


JHtml::_('behavior.keepalive');
?>
<?php if(!$user->get('guest')): ?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure', 0)); ?>" method="post" id="login-form" class="c-single-link-form">
    <a href="/user-profile"><span><strong><?php echo $user->username; ?></strong></span></a>
    (
    <button name="Submit"><span><?php echo JText::_('JLOGOUT'); ?></span></button>
    <input type="hidden" name="option" value="com_users" />
    <input type="hidden" name="task" value="user.logout" />
    <input type="hidden" name="return" value="<?php echo $return; ?>" />
    <?php echo JHtml::_('form.token'); ?>
    )
</form>
<?php if($user->get('is_staff')): ?> | <a href="/administrator"><span>Admin</span></a><?php endif; ?>
<?php endif; ?>