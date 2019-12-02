<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_cardlist
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;
use Joomla\String\StringHelper;


$doc = JFactory::getDocument();

$hx        = $params->get('header_tag', 'h2');
$has_image = !empty($params->get('image', false));

$theme_class  = !empty($params->get('theme', false)) ? '  t-featurette--' . $params->get('theme') : '';
$border_class = $params->get('border', 'none') == 'none' ? '' : '  d-bands';
$shape_class  = $params->get('shape', 'square') == 'square' ? '' : '  c-featurette__image--' . $params->get('shape');
$fit_class    = $params->get('fit', 'cover') == 'cover' ? 'u-image-cover  js-image-cover' : '';
?>
<div class="c-featurette-wrap">
    <div class="c-featurette<?php echo $has_image ? '  c-featurette--pull-image  u-space--above--none' : ''; ?><?php echo $theme_class; ?>">
        <div class="c-featurette__body  c-featurette__body--80">
            <?php if ($module->showtitle): ?>
            <<?php echo $hx; ?>><?php echo $module->title; ?></<?php echo $hx; ?>>
            <?php endif; ?>
            <?php echo $module->content; ?>
            <?php if (!empty($params->get('cta_text')) && !empty($params->get('cta_url'))) : ?>
            <p class="u-space--none">
                <a href="<?php echo $params->get('cta_url'); ?>" class="cta  cta--has-icon"><?php echo $params->get('cta_text'); ?><svg display="none" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg></a>
            </p>
            <?php endif; ?>
        </div>
        <?php if ($has_image): ?>
        <div class="c-featurette__image<?php echo $shape_class; ?><?php echo $border_class; ?>">
            <div class="l-proportional-container  l-proportional-container--1-1">
                <div class="l-proportional-container__content">
                    <div class="<?php echo $fit_class; ?>">
                        <div<?php echo empty($fit_class) ? '' : ' class="u-image-cover__inner"'; ?>>
                            <img src="<?php echo $params->get('image'); ?>" alt="<?php echo $params->get('alt'); ?>" class="u-image-cover__image" width="200">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>