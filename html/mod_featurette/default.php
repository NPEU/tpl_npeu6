<?php
if (!empty($_SERVER['JTV2'])) {
    include(str_replace('.php', '.v2.php', __FILE__));
    return;
}
?><?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_cardlist
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;
use Joomla\String\StringHelper;

// So there's a bug in Joomla where the conten property of a module will sometimes contain the
// already-rendered module as a whole, and then 'render' will be called again, leading to a wierd
// nested/duplicated temlate thing. It doesn't look like this will be fixed, so I'm hacking around
// it by checking if it's already rendered before proceeding:
if (strpos($module->content, 'mod_featurette') !== false) {
    echo $module->content;
    return;
}


$doc = JFactory::getDocument();

$hx        = $params->get('header_tag', 'h2');
$has_image = !empty($params->get('image', false));
$img_path  = $params->get('image');
$img_src   = $params->get('image');
$svg_src   = false;

$img_info = getimagesize($img_path);

$img_ratio = $img_info[0] / $img_info[1];
$img_info['width'] = 200;

$img_info['height'] = round($img_info['width'] / $img_ratio);

// Check if there's an SVG version of this images available:
$img_path_info = pathinfo($img_path);
if ($img_path_info['extension'] != 'svg') {
    $svg_path = str_replace($img_path_info['extension'], 'svg', $img_path);

    if (file_exists($svg_path)) {
        $svg_src = $svg_path;
    }
}

$theme_class  = !empty($params->get('theme', false)) ? '  t-featurette--' . $params->get('theme') : '';
$border_class = $params->get('border', 'none') == 'none' ? '' : '  d-bands';
$shape_class  = $params->get('shape', 'square') == 'square' ? '' : '  c-featurette__image--' . $params->get('shape');
$fit_class    = $params->get('fit', 'cover') == 'cover' ? 'u-image-cover  js-image-cover' : '';

#echo '<pre>'; var_dump($module->content); echo '</pre>'; #exit;


?>
<div class="c-featurette<?php echo $has_image ? '  c-featurette--pull-image  u-space--above--none' : ''; ?><?php echo $theme_class; ?> mod_featurette">
    <div class="c-featurette__body  c-featurette__body--80">
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
        <div class="l-proportional-container  l-proportional-container--1-1">
            <div class="l-proportional-container__content">
                <div class="<?php echo $fit_class; ?>">
                    <div<?php echo empty($fit_class) ? '' : ' class="u-image-cover__inner"'; ?>>                        
                        <?php if ($svg_src) : ?>
                        <img src="<?php echo $svg_src; ?>" alt="<?php echo $params->get('alt'); ?>" class="u-image-cover__image" width="<?php echo $img_info['width']; ?>" height="<?php echo $img_info['height']; ?>" onerror="this.src='<?php echo $img_src; ?>'; this.onerror=null;">
                        <?php else: ?>
                        <img src="<?php echo $img_src; ?>" alt="<?php echo $params->get('alt'); ?>" class="u-image-cover__image" width="<?php echo $img_info['width']; ?>" height="<?php echo $img_info['height']; ?>">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
