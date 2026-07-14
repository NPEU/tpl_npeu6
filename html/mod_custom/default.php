<?php
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

$module_wrapper_fill_height = (bool) ($params->get('wrapper_fill_hieght') ? $params->get('wrapper_fill_hieght') : false);
// CTU Going Global needed 100% height forced. Too many occurances of u-fill-height to check them all,
// and I'm certain I removed 100% height from the base class for good reasons, so adding a 2nd option for 100% height.
$module_wrapper_force_height = (bool) ($params->get('wrapper_force_height') ? $params->get('wrapper_force_height') : false);
?>

<div class="user-content  mod_custom<?php echo ($module_wrapper_fill_height) ? '  u-fill-height' : '';?><?php echo ($module_wrapper_force_height) ? '  u-force-height' : ''; ?>" <?php if ($params->get('backgroundimage')) : ?> style="background-image:url(<?php echo $params->get('backgroundimage'); ?>)"<?php endif; ?> >
    <?php echo $module->content; ?>
</div>

