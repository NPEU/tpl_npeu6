<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) NPEU 2020.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

HTMLHelper::_('behavior.keepalive');
?>
<?php if(!$user->get('guest')): ?>
<form action="<?php echo Route::_('index.php', true, $params->get('usesecure', 0)); ?>" method="post" id="login-form" class="c-utilitext  mod_login">
    <p>
        <a href="/user-profile"><span><strong><?php echo $user->username; ?></strong></span></a>
        (
        <button name="Submit"><span><?php echo Text::_('JLOGOUT'); ?></span></button>
        <input type="hidden" name="option" value="com_users" />
        <input type="hidden" name="task" value="user.logout" />
        <input type="hidden" name="return" value="<?php echo $return; ?>" />
        <?php echo HTMLHelper::_('form.token'); ?>
        )
        <?php if($user->get('is_staff')): ?> | <a href="/administrator"><span>Admin</span></a><?php endif; ?>
    </p>
</form>

<?php endif; ?>