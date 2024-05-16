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
use Joomla\CMS\Uri\Uri;

?>
<p class="c-utilitext  mod_login">
    <a href="/login?return=<?php echo base64_encode(Uri::getInstance()->toString()); ?>" class="mod_login"><span>NPEU Login</span></a>
</p>
