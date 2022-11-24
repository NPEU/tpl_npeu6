<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) NPEU 2020.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

JLoader::register('UsersHelperRoute', JPATH_SITE . '/components/com_users/helpers/route.php');

JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.tooltip');

?>
<p class="c-utilitext  mod_login">
    <a href="/login?return=<?php echo base64_encode(JUri::getInstance()->toString()); ?>" class="mod_login"><span>NPEU Login</span></a>
</p>
