<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  tpl_npeu6
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */
 
// Include the template helper:
JLoader::register('TplNPEU6Helper', dirname(__DIR__) . '/helper.php');

function modChrome_basic($module, &$params, &$attribs) {

    if (!empty($module->content)): ?>
    <?php echo $module->content; ?>
    <?php endif;
}



function modChrome_bespoke($module, &$params, &$attribs) {

    $app = JFactory::getApplication();
    $template = $app->getTemplate(true);


    #echo  '<pre>'; var_dump($template); echo '</pre>';

    

    $brand = TplNPEU6Helper::get_brand();

    #echo  '<pre>'; var_dump($brand); echo '</pre>';

    $module_wrapper = $params->get('wrapper') ? $params->get('wrapper') : '';
    $module_wrapper_theme = $params->get('theme') ? $params->get('theme') : '';

    $wrapper_classname = '';
    $header_classname  = '';
    $wrapper_class = '';
    $header_class = '';
    $wrapper_theme_class = '';
    $hx = $params->get('header_tag', 'h2');

    $theme_name = $brand->alias;

    // Handle special case for 'WHITE' This probably needs a re-think in the next version of the template
    if ($module_wrapper_theme == 'white') {
        $theme_name = 'white';
        $module_wrapper_theme = '';
    }
    #echo '<pre>'; var_dump($module); echo '</pre>'; #exit;
    #echo '<pre>'; var_dump($module_wrapper); echo '</pre>'; #exit;
    #echo '<pre>'; var_dump($module_wrapper_theme); echo '</pre>'; #exit;
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

    $has_cta      = !empty($params->get('cta_text')) && !empty($params->get('cta_url'));
    $cta_position = $params->get('cta_position');

    if (!empty($module->content)): ?>
    <?php if ($module_wrapper == 'panel' || $module_wrapper == 'panel_longform'): ?>
    <div class="c-panel<?php echo $wrapper_theme_class; echo ($module_wrapper == 'panel_longform') ? '  u-padding--sides--l' : ''; ?>  t-<?php echo $theme_name; ?>  u-space--none">
        <<?php echo $outer_el; ?> class="<?php echo ($module_wrapper == 'panel_longform') ? 'c-longform-content  c-user-content' : 'c-panel__module'; ?>">
            <div<?php echo $wrapper_class; ?>>
    <?php endif; ?>
                <?php if ($module->showtitle && $has_cta && $cta_position == 'header'): ?>
                <header class="u-text-group  u-text-group--push-apart  u-space--below">
                    <<?php echo $hx; ?><?php echo $header_class; ?> id="<?php echo TplNPEU6Helper::html_id($module->title); ?>"><?php echo $module->title; ?></<?php echo $hx; ?>>
                    <p><a href="<?php echo $params->get('cta_url'); ?>" class="c-cta  c-cta--has-icon"><?php echo $params->get('cta_text'); ?><svg display="none" focusable="false" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg></a></p>
                </header>
                <?php elseif ($module->showtitle): ?>
                <<?php echo $hx; ?><?php echo $header_class; ?> id="<?php echo TplNPEU6Helper::html_id($module->title); ?>"><?php echo $module->title; ?></<?php echo $hx; ?>>
                <?php endif; ?>
                <?php echo $module->content; ?>
                <?php if ($has_cta && $cta_position == 'bottom'): ?>
                <p><a href="<?php echo $params->get('cta_url'); ?>" class="c-cta  c-cta--has-icon"><?php echo $params->get('cta_text'); ?><svg display="none" focusable="false" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg></a></p>
                <?php endif; ?>
    <?php if ($module_wrapper == 'panel' || $module_wrapper == 'panel_longform'): ?>
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

    $brand = TplNPEU6Helper::get_brand();

    $module_wrapper = $params->get('wrapper') ? $params->get('wrapper') : '';
    $module_wrapper_theme = $params->get('theme') ? $params->get('theme') : '';
    $module_wrapper_color = $params->get('color') ? $params->get('color') : 'neutral';

    $wrapper_classname = '';
    $header_classname  = '';
    $wrapper_class = '';
    $header_class = '';
    $wrapper_theme_class = '  c-panel--very-light';
    
    $theme_name = $module_wrapper_color == 'brand' ? $brand->alias : 'neutral';
    
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

    // If we're showing a title, we want to use an aside for the sidebar, otherwise div:
    $outer_el = 'div';
    $aria_labelledby = '';
    if ($module->showtitle) {
        //$outer_el = 'section';
        $outer_el = 'aside';
        $aria_labelledby = ' aria-labelledby="' . TplNPEU6Helper::html_id($module->title) . '"';
    }

    $has_cta            = !empty($params->get('cta_text')) && !empty($params->get('cta_url'));
    $cta_position       = $params->get('cta_position');
    $has_headline_image = !empty($params->get('headline_image'));

    if (!empty($module->content)): ?>
    <?php if ($module_wrapper == 'panel'): ?>
    <div class="c-panel<?php echo $wrapper_theme_class; ?>  t-<?php echo $theme_name; ?>  u-space--below">
        <?php if ($has_headline_image): ?>
        <div class="c-panel__banner">
            <div class="l-proportional-container  l-proportional-container--2-1  l-proportional-container--4-1--wide">
                <div class="l-proportional-container__content">
                    <div class="u-image-cover  js-image-cover">
                        <div class="u-image-cover__inner">
                            <img class="u-image-cover__image" src="<?php echo $params->get('headline_image'); ?>" alt="" width="600">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <<?php echo $outer_el; ?> class="c-panel__module"<?php echo $aria_labelledby; ?>>
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
                <header class="u-text-group  u-text-group--push-apart  u-space--below"<?php echo $aria_labelledby; ?>>
                    <h2<?php echo $header_class; ?> id="<?php echo TplNPEU6Helper::html_id($module->title); ?>"><?php echo $module->title; ?></h2>
                    <p><a href="<?php echo $params->get('cta_url'); ?>" class="c-cta  c-cta--has-icon"><?php echo $params->get('cta_text'); ?><svg display="none" focusable="false" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg></a></p>
                </header>
                <?php elseif ($module->showtitle): ?>
                <h2<?php echo $header_class; ?> id="<?php echo TplNPEU6Helper::html_id($module->title); ?>"><?php echo $module->title; ?></h2>
                <?php endif; ?>
                <?php echo $module->content; ?>
                <?php if ($has_cta && $cta_position == 'bottom'): ?>
                <p><a href="<?php echo $params->get('cta_url'); ?>" class="c-cta  c-cta--has-icon"><?php echo $params->get('cta_text'); ?><svg display="none" focusable="false" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg></a></p>
                <?php endif; ?>
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