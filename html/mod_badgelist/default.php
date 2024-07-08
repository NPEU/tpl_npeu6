<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_badgelist
 *
 * @copyright   Copyright (C) NPEU 2021.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

$doc = Factory::getDocument();

$public_root_path = realpath($_SERVER['DOCUMENT_ROOT']) . DIRECTORY_SEPARATOR;

$layout_classes = ['l-layout'];
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
    $layout_classes[] = 'l-basis--' . $params->get('list_basis');
}

$box_classes = ['l-box'];
if (!empty($params->get('badge_align'))) {
    $box_classes[] = 'l-' . $params->get('badge_align');
}

if (in_array('l-distribute--balance-bottom', $layout_classes) || in_array('l-distribute--balance-top', $layout_classes)) {
    $layout_classes[] = 'l-distribute';
} else {
    $layout_classes[] = 'l-row';
}

?>
<div class="<?php echo implode("  ", $layout_classes); ?>  mod_badgelist">
    <div class="l-layout__inner">
    <?php foreach ($badges as $badge) :

    //$badge->params->limit_height

    // If somehow the badge has been deleted we'll get a "division by zero" error when calculating
    // the ratio. This is a problem because it breaks the whole page so we need to skip these
    // badges

    $badge_image_path       = urldecode($public_root_path . $badge->logo_png_path);
    if (!file_exists($badge_image_path)) {
        continue;
    }
    $badge_image_info       = getimagesize($badge_image_path);
    $badge_image_real_ratio = $badge_image_info[0] / $badge_image_info[1];

    if (!is_numeric($badge->params->limit_height)) {
        // Could maybe switch the height depending on t-shirt size, but not sure it's worth it as
        // it would be arbitrary and not necessarily connected to the CSS.
        $badge_height = 100;
    } else {
        $badge_height = $badge->params->limit_height . '0';
    }
    if ($badge_image_info[0] > $badge_image_info[1]) {
        $badge_width  = round($badge_height * $badge_image_real_ratio);
    } else {
        $badge_width  = round($badge_height / $badge_image_real_ratio);
    }

    ?>
        <p class="<?php echo implode("  ", $box_classes); ?>">
            <a href="<?php echo $badge->params->logo_url; ?>" class="c-badge c-badge--limit-height--<?php echo $badge->params->limit_height; ?>" rel="external noopener noreferrer" target="_blank">
                <img data-ratio="<?php echo $badge_image_real_ratio; ?>" alt="Logo: <?php echo $badge->alt; ?>" width="<?php echo $badge_width; ?>" height="<?php echo $badge_height; ?>" onerror="this.src='<?php echo $badge->logo_png_path; ?>'; this.onerror=null;" src="<?php echo $badge->logo_svg_path; ?>">
            </a>
        </p>
        <?php endforeach; ?>
    </div>
</div>

