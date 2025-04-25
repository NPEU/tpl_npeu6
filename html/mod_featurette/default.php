<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_cardlist
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\String\StringHelper;

// So there's a bug in Joomla where the conten property of a module will sometimes contain the
// already-rendered module as a whole, and then 'render' will be called again, leading to a wierd
// nested/duplicated temlate thing. It doesn't look like this will be fixed, so I'm hacking around
// it by checking if it's already rendered before proceeding:
if (strpos($module->content, 'mod_featurette') !== false) {
    echo $module->content;
    return;
}

$doc = Factory::getDocument();

$hx        = $params->get('header_tag', 'h2');
$has_image = !empty($params->get('image', false));
if ($has_image) {
    $img_src   = $params->get('image');
    $img_path  = urldecode($img_src);
    $svg_src   = false;

    if (!file_exists($img_path)) {
        $has_image = false;
    } else {
        $img_info = getimagesize($img_path);

        $img_ratio = $img_info[0] / $img_info[1];

        #$img_info['width'] = 200;
        #$img_info['height'] = round($img_info['width'] / $img_ratio);

       $img_info['height'] = 200;
        $img_info['width'] = round($img_info['height'] * $img_ratio);

        //if ($img_info[0] > $img_info[1]) {
        //    $img_info['height'] = $img_info['width'] / $img_ratio;
        //} else {
        //    $img_info['height'] = $img_info['width'] * $img_ratio;
        //}

        // Check if there's an SVG version of this images available:
        $img_path_info = pathinfo($img_path);
        if ($img_path_info['extension'] != 'svg') {
            $svg_path = str_replace($img_path_info['extension'], 'svg', $img_path);

            if (file_exists($svg_path)) {
                $svg_src = $svg_path;
            }
        }
    }
}
$theme_class  = !empty($params->get('theme', false)) ? '  d-background--' . $params->get('theme') : '';
$border_class = $params->get('border', 'none') == 'none' ? '' : '  d-border--thick';
$shape_class  = $params->get('shape', 'square') == 'square' ? '' : '  c-featurette__image--' . $params->get('shape');
$fit_class    = $params->get('fit', 'cover') == 'contain' ? '  u-image-cover--contain  js-image-cover--contain' : '';
?>
<div class="c-featurette<?php echo ($has_image && $params->get('shape', 'square') == 'round') ? '  c-featurette--pull-image' : ''; ?><?php echo $theme_class; ?>  mod_featurette">
    <div class="c-featurette__body  c-featurette__body--60">
        <?php if ($module->showtitle): ?>
        <<?php echo $hx; ?>><?php echo $module->title; ?></<?php echo $hx; ?>>
        <?php endif; ?>
        <?php echo $module->content; ?>
        <?php if (!empty($params->get('cta_text')) && !empty($params->get('cta_url'))) : ?>
        <p>
            <a href="<?php echo $params->get('cta_url'); ?>" class="c-cta  c-cta--has-icon"><?php echo $params->get('cta_text'); ?><svg display="none" focusable="false" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg></a>
        </p>
        <?php endif; ?>
    </div>
    <?php if ($has_image): ?>
    <div class="c-featurette__image<?php echo $shape_class; ?><?php echo $border_class; ?>">
        <div class="u-image-cover  u-image-cover--contain  u-image-cover--min-100  js-image-cover<?php echo $fit_class; ?>">
            <p class="u-image-cover__inner">
                <?php if ($svg_src) : ?>
                <img src="<?php echo $svg_src; ?>" alt="<?php echo $params->get('alt'); ?>" class="u-image-cover__image" width="<?php echo $img_info['width']; ?>" height="<?php echo $img_info['height']; ?>" onerror="this.src='<?php echo $img_src; ?>'; this.onerror=null;">
                <?php else: ?>
                <img src="<?php echo $img_src; ?>?s=300" sizes="100vw" srcset="<?php echo $img_src; ?>?s=1600 1600w, <?php echo $img_src; ?>?s=900 900w, <?php echo $img_src; ?>?s=300 300w" alt="<?php echo $params->get('alt'); ?>" class="u-image-cover__image" width="<?php echo $img_info['width']; ?>" height="<?php echo $img_info['height']; ?>">
                <?php endif; ?>
            </p>
        </div>
    </div>
    <?php endif; ?>
</div>
