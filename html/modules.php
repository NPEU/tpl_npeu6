<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  tpl_npeu6
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

function modChrome_basic($module, &$params, &$attribs) {

if (!empty($module->content)): ?>
<?php echo $module->content; ?>
<?php endif;
}



function modChrome_bespoke($module, &$params, &$attribs) {

$app = JFactory::getApplication();
$template = $app->getTemplate(true);


#echo  '<pre>'; var_dump($template); echo '</pre>';

// Include the template helper:
JLoader::register('TplNPEU6Helper', dirname(dirname(__DIR__)) . '/helper.php');

$brand = TplNPEU6Helper::get_brand();

#echo  '<pre>'; var_dump($brand); echo '</pre>';

$module_wrapper = $params->get('wrapper') ? $params->get('wrapper') : '';
$module_wrapper_theme = $params->get('theme') ? $params->get('theme') : '';

$wrapper_classname = '';
$header_classname  = '';
$wrapper_class = '';
$header_class = '';
$wrapper_theme_class = '  c-panel--very-light';
#echo '<pre>'; var_dump($module); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($module_wrapper); echo '</pre>'; #exit;
if (!empty($wrapper_classname)) {
    $wrapper_class = ' class="' . $wrapper_classname . '"';
}

if (!empty($header_classname)) {
    $header_class = ' class="' . $header_classname . '"';
}


if (!empty($module_wrapper_theme)) {
    $wrapper_theme_class = '  c-panel--' . $module_wrapper_theme;
}

// If we're showing a title, we want to use section, otherwise div:
$outer_el = 'div';
if ($module->showtitle) {
    $outer_el = 'section';
}

$has_cta = !empty($params->get('cta_text')) && !empty($params->get('cta_url'));

if (!empty($module->content)): ?>
<?php if ($module_wrapper == 'panel'): ?>
<div class="c-panel<?php echo $wrapper_theme_class; ?>  t-<?php echo $brand->alias; ?>  u-space--none">
    <<?php echo $outer_el; ?> class="c-panel--module">
        <div<?php echo $wrapper_class; ?>>
<?php endif; ?>
            <?php if ($module->showtitle && $has_cta): ?>
            <header class="u-text-group  u-text-group--push-apart  u-space--below">
                <h2<?php echo $header_class; ?>><?php echo $module->title; ?></h2>
                <p><a href="<?php echo $params->get('cta_url'); ?>" class="cta  cta--has-icon"><?php echo $params->get('cta_text'); ?><svg display="none" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg></a></p>
            </header>
            <?php elseif ($module->showtitle): ?>
            <h2<?php echo $header_class; ?>><?php echo $module->title; ?></h2>
            <?php endif; ?>
            <?php echo $module->content; ?>
<?php if ($module_wrapper == 'panel'): ?>
        </div>
    </<?php echo $outer_el; ?>>
</div>
<?php endif; ?>
<?php endif;
}



function modChrome_sidebar($module, &$params, &$attribs) {

$app = JFactory::getApplication();
$template = $app->getTemplate(true);


#echo  '<pre>'; var_dump($template); echo '</pre>';

// Include the template helper:
JLoader::register('TplNPEU6Helper', dirname(dirname(__DIR__)) . '/helper.php');

$brand = TplNPEU6Helper::get_brand();

$module_wrapper = $params->get('wrapper') ? $params->get('wrapper') : '';
$module_wrapper_theme = $params->get('theme') ? $params->get('theme') : '';

$wrapper_classname = '';
$header_classname  = '';
$wrapper_class = '';
$header_class = '';
$wrapper_theme_class = '  c-panel--very-light';
// @ASSUMPTION: If there's a menu in the sidebar, it's a section menu.
if ($module->module == 'mod_menu') {
    $wrapper_classname = 'n-section-menu';
    $header_classname  = 'n-section-menu__title';
}

if (!empty($wrapper_classname)) {
    $wrapper_class = ' class="' . $wrapper_classname . '"';
}

if (!empty($header_classname)) {
    $header_class = ' class="' . $header_classname . '"';
}


if (!empty($module_wrapper_theme)) {
    $wrapper_theme_class = '  c-panel--' . $module_wrapper_theme;
}

// If we're showing a title, we want to use section, otherwise div:
$outer_el = 'div';
if ($module->showtitle) {
    $outer_el = 'section';
}

$has_cta            = !empty($params->get('cta_text')) && !empty($params->get('cta_url'));
$has_headline_image = !empty($params->get('headline_image'));

if (!empty($module->content)): ?>
<?php if ($has_headline_image): ?>
<div class="l-proportional-container  l-proportional-container--2-1  l-proportional-container--4-1--wide  u-space--above">
    <div class="l-proportional-container__content">
        <div class="u-image-cover  js-image-cover">
            <div class="u-image-cover__inner">
                <img class="u-image-cover__image" src="<?php echo $params->get('headline_image'); ?>" alt="" width="600">
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if ($module_wrapper == 'panel'): ?>
<div class="c-panel<?php echo $wrapper_theme_class; ?>  t-neutral  u-space--below<?php if (!$has_headline_image): ?>  u-space--above<?php endif; ?>">
    <<?php echo $outer_el; ?> class="c-panel--module">
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
            <?php if ($module->showtitle && $has_cta): ?>
            <header class="u-text-group  u-text-group--push-apart  u-space--below">
                <h2<?php echo $header_class; ?>><?php echo $module->title; ?></h2>
                <p><a href="<?php echo $params->get('cta_url'); ?>" class="cta  cta--has-icon"><?php echo $params->get('cta_text'); ?><svg display="none" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg></a></p>
            </header>
            <?php elseif ($module->showtitle): ?>
            <h2<?php echo $header_class; ?>><?php echo $module->title; ?></h2>
            <?php endif; ?>
            <?php echo $module->content; ?>
<?php if ($module_wrapper == 'panel'): ?>
        </div>
    </<?php echo $outer_el; ?>>
</div>
<?php endif; ?>
<?php endif;
}

function modChrome_block($module, &$params, &$attribs) {

if (!empty($module->content)): ?>
<div class="l-blockrow">
    <?php echo $module->content; ?>
</div>
<?php endif;
}
?>