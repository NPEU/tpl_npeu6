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

<div class="c-user-content" <?php if ($params->get('backgroundimage')) : ?> style="background-image:url(<?php echo $params->get('backgroundimage'); ?>)"<?php endif; ?> >
	<?php echo $module->content; ?>
</div>
