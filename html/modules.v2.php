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



    $page_brand = TplNPEU6Helper::get_brand();

    #echo  '<pre>'; var_dump($page_brand); echo '</pre>';

    $module_wrapper = $params->get('wrapper') ? $params->get('wrapper') : '';
    $module_wrapper_theme = $params->get('theme') ? $params->get('theme') : '';

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
    <div class="c-panel<?php echo $wrapper_theme_class; ?>"  modstyle_bespoke--wrapper">
        <<?php echo $outer_el; ?> class="<?php echo ($module_wrapper == 'panel_longform') ? 'has-longform-content  user-content' : 'c-panel__module'; ?>">
            <?php /* <div<?php echo $wrapper_class; ?>> */ ?>
    <?php else: ?>
    <div class="modstyle_bespoke--wrapper">
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
                <p><a href="<?php echo $params->get('cta_url'); ?>" class="c-cta  c-cta--has-icon"><?php echo $params->get('cta_text'); ?><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-chevron-right"></use></svg></a></p>
                <?php endif; ?>
    <?php if ($module_wrapper == 'panel' || $module_wrapper == 'panel_longform'): ?>
            <?php /* </div> */ ?>
        </<?php echo $outer_el; ?>>
    <?php endif; ?>
    </div>
    
    <?php endif;
}



function modChrome_sidebar($module, &$params, &$attribs) {

    $app = JFactory::getApplication();
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
        $wrapper_theme_class = '  d-background--' . $module_wrapper_theme . '  t-neutral';
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
    $cta_position       = $params->get('cta_position');
    $has_headline_image = !empty($params->get('headline_image'));

    if (!empty($module->content)): ?>
    <?php if ($module_wrapper == 'panel'): ?>
    <<?php echo $module_tag; ?> class="c-panel  c-panel--rounded<?php echo $wrapper_theme_class; ?>  u-space--below  modstyle_sidebar  modstyle_sidebar--wrapper">
        <?php if ($has_headline_image): ?>
        <div class="c-panel__banner">
            <div class="u-image-cover  js-image-cover  u-image-cover--min-50  u-image-cover--min-25--wide">
                <div class="u-image-cover__inner">
                    <img class="u-image-cover__image" src="<?php echo $params->get('headline_image'); ?>" alt="" width="600">
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
    <?php endif;
}

function modChrome_block($module, &$params, &$attribs) {
    if (!empty($module->content)): ?>
    <div class="l-blockrow  modstyle_block">
        <?php echo $module->content; ?>
    </div>
    <?php endif;
}

function modChrome_block_fill_width($module, &$params, &$attribs) {
    if (!empty($module->content)): ?>
    <div class="l-blockrow  u-fill-width  modstyle_fill-width">
        <?php echo $module->content; ?>
    </div>
    <?php endif;
}

function modChrome_layout_box($module, &$params, &$attribs) {
    //echo 'params<pre>'; var_dump($params); echo '</pre>'; #exit;
    //echo 'attribs<pre>'; var_dump($attribs); echo '</pre>'; #exit;

    if (!empty($module->content)): ?>
    <div class="l-box  modstyle_layout-box">
        <?php echo $module->content; ?>
    </div>
    <?php endif;
}











function modChrome_magic($module, &$params, &$attribs) {

    $app = JFactory::getApplication();
    $template = $app->getTemplate(true);


    #echo  '<pre>'; var_dump($template); echo '</pre>';



    $page_brand = TplNPEU6Helper::get_brand();

    #echo  '<pre>'; var_dump($page_brand); echo '</pre>';

    $module_wrapper               = $params->get('wrapper', '');
    $module_wrapper_theme         = $params->get('theme', '');
    $module_wrapper_color         = $params->get('color', 'neutral');
    $module_wrapper_bottom_border = $params->get('bottom_border', '');

    $module_wrapper_width         = $params->get('width', '');
    $module_wrapper_align         = $params->get('align', '');

    $wrapper_classname = '';
    $header_classname  = $params->get('header_class', '');
    //$inner_wrapper_class = '';
    $header_classes = ['modstyle_magic--heading'];
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
    /*if (!empty($wrapper_classname)) {
        $inner_wrapper_class = ' class="' . $wrapper_classname . '"';
    }*/

    if (!empty($header_classname)) {
        $header_classes[] = $header_classname;
    }
    $header_class = ' class="' . implode('  ', $header_classes) . '"';

    /*if (!empty($module_wrapper_theme)) {
        $wrapper_theme_class = '  c-panel--' . $module_wrapper_theme;
    }*/

    // If we're showing a title, we want to use section, otherwise div:
    $outer_el = 'div';
    if ($module->showtitle) {
        $outer_el = 'section';
    }

    $has_cta      = !empty($params->get('cta_text')) && !empty($params->get('cta_url'));
    $cta_position = $params->get('cta_position');






    $outer_wrapper_classes = ['modstyle_magic--wrapper  t-' . $page_brand->alias . '  l-box'];


    if (!empty($module_wrapper_bottom_border)) {
       // $wrapper_classes[] = 'ff-width--' . $module_wrapper_width;
        $outer_wrapper_classes[] = 'd-bands--bottom';
    }

    if (!empty($module_wrapper_width)) {
        // $wrapper_classes[] = 'ff-width--' . $module_wrapper_width;
        if ($module_wrapper_width == '100') {
            $outer_wrapper_classes[] = 'l-box--expand';
        } else {
            // Note that the breakpoint should ideall be an option.
            $outer_wrapper_classes[] = 'ff-width-100--40--' . $module_wrapper_width;
        }
    }

    $wrapper_classes = ['t-' . $theme_name];

    //
    /* This is meant to control SElF within multi-module in same position scenarios, but not sure
       if the CSS is in place in the NEW template yet.

    if (!empty($module_wrapper_align)) {
        $wrapper_classes[] = 'l-' . $module_wrapper_align;
    }

    */

    if ($module_wrapper == 'panel' || $module_wrapper == 'panel_longform') {
        $wrapper_classes[] = 'c-panel';
        if (!empty($module_wrapper_theme)) {
            $wrapper_classes[] = 'c-panel--' .  $module_wrapper_theme;
        }
    }

    /*if ($module_wrapper == 'panel_longform') {
        $wrapper_classes[] = 'u-padding--sides--l';
    }*/




    if (!empty($module->content)): ?>

    <div class="u-fill-heightX  <?php echo implode('  ', $outer_wrapper_classes); ?>">
        <div class="u-fill-heightX  <?php echo implode('  ', $wrapper_classes); ?>">
            <<?php echo $outer_el; ?> class="u-fill-height  <?php echo ($module_wrapper == 'panel_longform') ? 'longform-content  user-content' : 'c-panel__module'; ?>">


                <?php if ($module->showtitle && $has_cta && $cta_position == 'header'): ?>
                <header class="u-text-group  u-text-group--push-apart  u-space--below  modstyle_magic--header">
                    <<?php echo $hx; ?><?php echo $header_class; ?> id="<?php echo TplNPEU6Helper::html_id($module->title); ?>"><?php echo $module->title; ?></<?php echo $hx; ?>>
                    <p><a href="<?php echo $params->get('cta_url'); ?>" class="c-cta  c-cta--has-icon"><?php echo $params->get('cta_text'); ?><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-chevron-right"></use></svg></a></p>
                </header>
                <?php elseif ($module->showtitle): ?>
                <header class="u-text-group  u-text-group--push-apart  u-space--below  modstyle_magic--header">
                    <<?php echo $hx; ?><?php echo $header_class ?> id="<?php echo TplNPEU6Helper::html_id($module->title); ?>"><?php echo $module->title; ?></<?php echo $hx; ?>>
                </header>
                <?php endif; ?>
                <?php echo $module->content; ?>
                <?php if ($has_cta && $cta_position == 'bottom'): ?>
                <p class="u-space--above"><a href="<?php echo $params->get('cta_url'); ?>" class="c-cta  c-cta--has-icon"><?php echo $params->get('cta_text'); ?><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-chevron-right"></use></svg></a></p>
                <?php endif; ?>

            </<?php echo $outer_el; ?>>
        </div>
    </div>
    <?php endif;
}


?>