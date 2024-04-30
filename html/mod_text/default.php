<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_text
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;
?>
<?php if (!empty(trim($module->content))) : ?>
<div class="user-content  longform-content  mod_text" <?php if ($params->get('backgroundimage')) : ?> style="background-image:url(<?php echo $params->get('backgroundimage'); ?>)"<?php endif; ?> >
    <?php echo trim($module->content); ?>
</div>
<?php endif; ?>
