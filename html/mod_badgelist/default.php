<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_badgelist
 *
 * @copyright   Copyright (C) NPEU 2021.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;


$doc = JFactory::getDocument();

$layout_classes = ['l-layout', 'l-row'];
if (!empty($params->get('list_layout'))) {
    $layout_classes[] = 'l-' . $params->get('list_layout');
}

if (!empty($params->get('list_gutter'))) {
    $layout_classes[] = 'l-gutter--' . $params->get('list_gutter');
}

if (!empty($params->get('flush_gutter'))) {
    $layout_classes[] = 'l-flush-edge-gutter';
}

if (!empty($params->get('list_basis'))) {
    $layout_classes[] = 'l-basis-' . $params->get('list_basis');
}

?>
<div class="<?php echo implode("  ", $layout_classes); ?>  mod_badgelist">
    <div class="l-layout__inner">
    <?php foreach ($badges as $badge) : ?>
        <p class="l-box">
            <a href="<?php echo $badge->params->logo_url; ?>" class="c-badge c-badge--limit-height--<?php echo $badge->params->limit_height; ?>" rel="external noopener noreferrer" target="_blank">
                <img alt="Logo: <?php echo $badge->alt; ?>" height="<?php echo $badge->params->limit_height; ?>0" onerror="this.src='<?php echo $badge->logo_png_path; ?>'; this.onerror=null;" src="<?php echo $badge->logo_svg_path; ?>">
            </a>
        </p>
        <?php endforeach; ?>
    </div>
</div>

