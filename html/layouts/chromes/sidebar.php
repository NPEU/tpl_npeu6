<?php

/**
 * @package     Joomla.Site
 * @subpackage  Templates.NPEU6
 *
 * @copyright   Copyright (C) NPEU 2024.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\Utilities\ArrayHelper;

use NPEU\Template\Npeu6\Site\Helper\Npeu6Helper as TplNPEU6Helper;

$module  = $displayData['module'];
$params  = $displayData['params'];
$attribs = $displayData['attribs'];

/*
if ($module->content === null || $module->content === '') {
    return;
}

$moduleTag              = $params->get('module_tag', 'div');
$moduleAttribs          = [];
$moduleAttribs['class'] = $module->position . ' card ' . htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_QUOTES, 'UTF-8');
$headerTag              = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
$headerClass            = htmlspecialchars($params->get('header_class', ''), ENT_QUOTES, 'UTF-8');
$headerAttribs          = [];
$headerAttribs['class'] = $headerClass;

// Only output a header class if it is not card-title
if ($headerClass !== 'card-title') :
    $headerAttribs['class'] = 'card-header ' . $headerClass;
endif;

// Only add aria if the moduleTag is not a div
if ($moduleTag !== 'div') {
    if ($module->showtitle) :
        $moduleAttribs['aria-labelledby'] = 'mod-' . $module->id;
        $headerAttribs['id']              = 'mod-' . $module->id;
    else :
        $moduleAttribs['aria-label'] = $module->title;
    endif;
}

$header = '<' . $headerTag . ' ' . ArrayHelper::toString($headerAttribs) . '>' . $module->title . '</' . $headerTag . '>';
?>
<<?php echo $moduleTag; ?> <?php echo ArrayHelper::toString($moduleAttribs); ?>>
    <?php if ($module->showtitle && $headerClass !== 'card-title') : ?>
        <?php echo $header; ?>
    <?php endif; ?>
    <div class="card-body">
        <?php if ($module->showtitle && $headerClass === 'card-title') : ?>
            <?php echo $header; ?>
        <?php endif; ?>
        <?php echo $module->content; ?>
    </div>
</<?php echo $moduleTag; ?>>
*/


$app = Factory::getApplication();
$template = $app->getTemplate(true);


#echo  '<pre>'; var_dump($module); echo '</pre>';
#echo  '<pre>'; var_dump($params); echo '</pre>';
#echo  '<pre>'; var_dump($attribs); echo '</pre>';
#echo  '<pre>'; var_dump($template); echo '</pre>;

$page_brand = TplNPEU6Helper::get_brand();

$module_tag     = $params->get('module_tag') ? $params->get('module_tag') : 'div';
$module_wrapper = $params->get('wrapper') ? $params->get('wrapper') : '';
$module_wrapper_theme = $params->get('theme') ? $params->get('theme') : '';
$module_wrapper_color = $params->get('color') ? $params->get('color') : 'neutral';


$wrapper_classname = '';
$header_classname  = '';
$wrapper_class = '';
$header_class = '';
$wrapper_theme_class = '  d-background--very-light  t-neutral';

$theme_name = $module_wrapper_color == 'brand' ? $page_brand->alias : 'neutral';
$module_wrapper_theme_class = ($theme_name == 'neutral') ? '  t-neutral' : '';

// @ASSUMPTION: If there's a menu in the sidebar, it's a section menu.
if ($module->module == 'mod_menu') {
    $wrapper_classname = 'n-menu';
    $header_classname  = 'n-menu__title';
    $module_tag = 'nav';
}

if (!empty($wrapper_classname)) {
    $wrapper_class = ' class="' . $wrapper_classname . '"';
}

if (!empty($header_classname)) {
    $header_class = ' class="' . $header_classname . '"';
}


if (!empty($module_wrapper_theme)) {
    $wrapper_theme_class = '  d-background--' . $module_wrapper_theme . $module_wrapper_theme_class;
    //$wrapper_theme_class = '  d-background--' . $module_wrapper_theme;
}

// If we're showing a title, we want to use an aside for the sidebar, otherwise div:
$outer_el = 'div';
$aria_labelledby = '';
if ($module->showtitle) {
    //$outer_el = 'section';
    //$outer_el = 'aside'; //!!! Changing this die to a11y landmark nesting issue - needs investigation.
    $outer_el = 'div';
    $aria_labelledby = ' aria-labelledby="' . TplNPEU6Helper::html_id($module->title) . '"';
}

$has_cta            = !empty($params->get('cta_text')) && !empty($params->get('cta_url'));
$has_content        = !empty(trim($module->content));
$cta_position       = $params->get('cta_position');
$has_headline_image = !empty($params->get('headline_image'));

if (!(!$has_cta && !$has_content)):
?>
<?php if ($module_wrapper == 'panel'): ?>
<<?php echo $module_tag; ?> class="c-panel  c-panel--rounded<?php echo $wrapper_theme_class; ?>  u-space--below  modstyle_sidebar  modstyle_sidebar--wrapper">
    <?php if ($has_headline_image): ?>
    <div class="c-panel__banner">
        <div class="u-image-cover  js-image-cover  u-image-cover--min-50  u-image-cover--min-25--wide">
            <div class="u-image-cover__inner">
                <img class="u-image-cover__image" src="<?php echo $params->get('headline_image'); ?>" alt=""width="200" data-fs-block="fill-width">
            </div>
        </div>
    </div>
    <?php endif; ?>
    <<?php echo $outer_el; ?> class="c-panel__module  modstyle_sidebar  modstyle_sidebar--outer<?php if ($module_wrapper != 'panel'): ?>  modstyle_sidebar--no-wrapper<?php endif; ?>"<?php echo $aria_labelledby; ?>>
        <div<?php echo $wrapper_class; ?>>
<?php endif; ?>
            <?php /*if ($has_headline_image): ?>
            <div class="l-proportional-container  l-proportional-container--2-1  u-space--below">
                <div class="l-proportional-container__content">
                    <div class="u-image-cover  js-image-cover">
                        <div class="u-image-cover__inner">
                            <img class="u-image-cover__image" src="<?php echo $params->get('headline_image'); ?>" alt="" width="600">
                        </div>
                    </div>
                </div>
            </div>
            <?php endif;*/ ?>
            <?php if ($module->showtitle && $has_cta && $cta_position == 'header'): ?>
            <header class="c-panel__header"<?php echo $aria_labelledby; ?>>
                <div>
                    <h2<?php echo $header_class; ?> id="<?php echo TplNPEU6Helper::html_id($module->title); ?>"><?php echo $module->title; ?></h2>
                    <p><a href="<?php echo $params->get('cta_url'); ?>" class="c-cta"><?php echo $params->get('cta_text'); ?><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-chevron-right"></use></svg></a></p>
                </div>
            </header>
            <?php elseif ($module->showtitle): ?>
            <header class="c-panel__header"<?php echo $aria_labelledby; ?>>
                <h2<?php echo $header_class; ?> id="<?php echo TplNPEU6Helper::html_id($module->title); ?>"><?php echo $module->title; ?></h2>
            </header>
            <?php endif; ?>
            <?php echo $module->content; ?>
            <?php if ($has_cta && $cta_position == 'bottom'): ?>
            <p><a href="<?php echo $params->get('cta_url'); ?>" class="c-cta  c-cta--has-icon"><?php echo $params->get('cta_text'); ?><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-chevron-right"></use></svg></a></p>
            <?php endif; ?>
<?php if ($module_wrapper == 'panel'): ?>
        </div>
    </<?php echo $outer_el; ?>>
</<?php echo $module_tag; ?>>
<?php endif; ?>
<?php endif; ?>