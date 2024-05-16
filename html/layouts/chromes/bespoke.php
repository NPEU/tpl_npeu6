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


#echo  '<pre>'; var_dump($template); echo '</pre>';



$page_brand = TplNPEU6Helper::get_brand();

#echo  '<pre>'; var_dump($page_brand); echo '</pre>';

$module_wrapper = $params->get('wrapper') ? $params->get('wrapper') : '';
$module_wrapper_theme = $params->get('theme') ? $params->get('theme') : '';
$module_wrapper_fill_height = $params->get('wrapper_fill_hieght') ? $params->get('wrapper_fill_hieght') : '';

//$wrapper_classname = '';
$header_classname  = $params->get('header_class', '');
//$wrapper_class = '';
$header_classes = ['modstyle_bespoke--heading'];
$header_class = '';
$wrapper_theme_class = '';
$hx = $params->get('header_tag', 'h2');

$theme_name = $page_brand->alias;

// Handle special case for 'WHITE' This probably needs a re-think in the next version of the template
if ($module_wrapper_theme == 'white') {
    $theme_name = 'white';
    $module_wrapper_theme = '';
}
#echo '<pre>'; var_dump($module); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($module_wrapper); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($module_wrapper_theme); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($module->title); echo '</pre>'; #exit;
//if (!empty($wrapper_classname)) {
//    $wrapper_class = ' class="' . $wrapper_classname . '"';
//}

if (!empty($header_classname)) {
    $header_classes[] = $header_classname;
}
$header_class = ' class="' . implode('  ', $header_classes) . '"';

if (!empty($module_wrapper_theme)) {
    $wrapper_theme_class = '  d-background--' . $module_wrapper_theme;
}

// If we're showing a title, we want to use section, otherwise div:
$outer_el = 'div';
if ($module->showtitle) {
    $outer_el = 'section';
}

$has_cta      = !empty($params->get('cta_text')) && !empty($params->get('cta_url'));
$cta_position = $params->get('cta_position');

if (!empty($module->content)): ?>
<?php if ($module_wrapper == 'panel' || $module_wrapper == 'panel_longform'): ?>
<div class="c-panel<?php echo $wrapper_theme_class; echo ($module_wrapper == 'panel_longform') ? '  u-padding--sides--l' : ''; ?>  t-<?php echo $theme_name; ?><?php echo (!empty($module_wrapper_fill_height) ? '  u-fill-height': '');?>  modstyle_bespoke--wrapper">
    <<?php echo $outer_el; ?> class="<?php echo ($module_wrapper == 'panel_longform') ? 'has-longform-content  user-content' : 'c-panel__module'; ?>">
        <?php /* <div<?php echo $wrapper_class; ?>> */ ?>
<?php else: ?>
<div class="c-panel__module  modstyle_bespoke--wrapper  u-fill-height">
<?php endif; ?>
            <?php if ($module->showtitle && $has_cta && $cta_position == 'header'): ?>
            <header class="c-panel__header  modstyle_bespoke--header<?php if ($module_wrapper == 'panel_longform') : ?>  longform-content__companion<?php endif; ?>">
                <div>
                    <<?php echo $hx; ?><?php echo $header_class; ?> id="<?php echo TplNPEU6Helper::html_id($module->title); ?>"><?php echo $module->title; ?></<?php echo $hx; ?>>
                    <p><a href="<?php echo $params->get('cta_url'); ?>" class="c-cta"><?php echo $params->get('cta_text'); ?><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em"><use xlink:href="#icon-chevron-right"></use></svg></a></p>
                </div>
            </header>
            <?php elseif ($module->showtitle): ?>
            <header class="c-panel__header<?php if ($module_wrapper == 'panel_longform') : ?>  longform-content__companion<?php endif; ?>">
                <<?php echo $hx; ?><?php echo $header_class ?> id="<?php echo TplNPEU6Helper::html_id($module->title); ?>"><?php echo $module->title; ?></<?php echo $hx; ?>>
            </header>
            <?php endif; ?>
            <?php echo $module->content; ?>
            <?php if ($has_cta && $cta_position == 'bottom'): ?>
            <p<?php if ($module_wrapper == 'panel_longform') : ?> class="longform-content__companion"<?php endif; ?>><a href="<?php echo $params->get('cta_url'); ?>" class="c-cta  c-cta--has-icon"><?php echo $params->get('cta_text'); ?><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-chevron-right"></use></svg></a></p>
            <?php endif; ?>
<?php if ($module_wrapper == 'panel' || $module_wrapper == 'panel_longform'): ?>
        <?php /* </div> */ ?>
    </<?php echo $outer_el; ?>>
<?php endif; ?>
</div>

<?php endif; ?>