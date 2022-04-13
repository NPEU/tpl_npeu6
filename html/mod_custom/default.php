<?php
if (!empty($_SERVER['JTV2'])) {
    include(str_replace('.php', '.v2.php', __FILE__));
    return;
}
?><?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_custom
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

// So there's a bug in Joomla where the conten property of a module will sometimes contain the
// already-rendered module as a whole, and then 'render' will be called again, leading to a wierd
// nested/duplicated temlate thing. It doesn't look like this will be fixed, so I'm hacking around
// it by checking if it's already rendered before proceeding:
if (strpos($module->content, 'mod_custom') !== false) {
    echo $module->content;
    return;
}
?>

<div class="c-user-content  mod_custom" <?php if ($params->get('backgroundimage')) : ?> style="background-image:url(<?php echo $params->get('backgroundimage'); ?>)"<?php endif; ?> >
	<?php echo $module->content; ?>
</div>

