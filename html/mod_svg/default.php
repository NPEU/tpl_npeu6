<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_svg
 *
 * @copyright   Copyright (C) NPEU 2020.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

$doc = Factory::getDocument();

?>

<?php if ($module->showtitle): ?>
<<?php echo $params->get('header_tag'); ?>><?php echo $module->title; ?></<?php echo $params->get('header_tag'); ?>>
<?php endif; ?>
<figure class="<?php if ($border) : ?>d-border  t-neutral  <?php endif; ?>mod_svg">
    <?php echo $module->content; ?>
</figure>