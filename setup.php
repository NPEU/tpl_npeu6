<?php
/**
 * @package     Joomla.Site
 * @subpackage  tpl_npeu6
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

require_once __DIR__ . '/vendor/autoload.php';

use \Michelf\Markdown;


// Include the template helper:
JLoader::register('TplNPEU6Helper', __DIR__ . '/helper.php');

#echo '<pre>'; var_dump($_SERVER); echo '</pre>'; exit;
switch ($_SERVER['SERVER_NAME']) {
    case 'dev.npeu.ox.ac.uk' :
        $env = 'development';
        break;
    case 'test.npeu.ox.ac.uk':
        $env = 'testing';
        break;
    default:
        $env = 'production';
}
#echo '<pre>'; var_dump($env); echo '</pre>'; exit;

$app   = JFactory::getApplication();
$doc   = JFactory::getDocument();
$input = JFactory::getApplication()->input;
$db    = JFactory::getDBO();
$user  = JFactory::getUser();
$uri   = JUri::getInstance(); 

#echo '<pre>'; var_dump($app); echo '</pre>'; exit;
#echo '<pre>'; var_dump($doc); echo '</pre>'; exit;
#echo '<pre>'; var_dump($input); echo '</pre>'; exit;
#echo '<pre>'; var_dump($user); echo '</pre>'; exit;
#echo '<pre>'; var_dump($user->getAuthorisedGroups()); echo '</pre>'; exit;
#echo '<pre>'; var_dump($uri); echo '</pre>'; exit;

// If the user has the staff group id (10) in their auth groups array, they are a member of staff,
// so provide a short cut:
$user->set('is_staff', in_array(10, $user->getAuthorisedGroups()));
#echo '<pre>'; var_dump($user); echo '</pre>'; exit;

// Set variables otherwise declared in error.php:
if (!isset($is_error)) {
    $is_error = false;
}
#echo '<pre>'; var_dump($is_error); echo '</pre>'; #exit;
if (!isset($error_menu_id)) {
    $error_menu_id = false;
}
if (!isset($menu_item)) {
    $menu_item = TplNPEU6Helper::get_menu_item();
}
$menu_root = explode('/', $menu_item->route)[0];
if (!isset($menu_id)) {
    $menu_id = TplNPEU6Helper::get_menu_id();
}

#echo '<pre>'; var_dump($menu_item); echo '</pre>'; exit;
#echo '<pre>'; var_dump($menu_item->alias); echo '</pre>'; exit;
#echo '<pre>'; var_dump($menu_item->title); echo '</pre>'; exit;
#echo '<pre>'; var_dump($menu_item->params->get('hero_image')); echo '</pre>'; exit;
#echo '<pre>'; var_dump($menu_root); echo '</pre>'; exit;
#echo '<pre>'; var_dump($menu_item->access); echo '</pre>'; exit;
#echo '<pre>'; var_dump($menu_id); echo '</pre>'; exit;
#####echo '<pre>'; var_dump($user->authorise("core.edit", "com_menus.menu." . $menu_id)); echo '</pre>'; exit;

// Work out if current page is a route of a component or not;
$menu_route = trim($menu_item->route, '/');
$uri_route  = trim($uri->getPath(), '/');

#echo '<pre>'; var_dump($menu_route); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($uri_route); echo '</pre>'; exit;

$page_is_subroute = ($menu_route == $uri_route) ? false : true;


// Brand
$page_brand        = TplNPEU6Helper::get_brand();
$page_brand_folder = $page_brand->alias . '/';
#echo '<pre>'; var_dump($page_brand); echo '</pre>'; exit;

// Modules sometimes need to add scripts and styles ot the $doc but if we wait to use <jdoc> they're
// processed too late and get missed.
// Pre-rendering all modules here to avoid that. Not sure if there will be other consequences.
jimport('joomla.application.module.helper');
$modules__header_nav_bar   = trim(JHtml::_('content.prepare', '{loadposition 2-header-nav-bar,basic}'));
$modules__main_breadcumbs  = trim(JHtml::_('content.prepare', '{loadposition 3-main-breadcrumbs,basic}'));
$modules__main_upper       = trim(JHtml::_('content.prepare', '{loadposition 3-main-upper,basic}'));
$modules__sidebar_top      = trim(JHtml::_('content.prepare', '{loadposition 4-sidebar-top,sidebar}'));
$modules__sidebar_bottom   = trim(JHtml::_('content.prepare', '{loadposition 4-sidebar-bottom,sidebar}'));
$modules__main_lower       = trim(JHtml::_('content.prepare', '{loadposition 3-main-lower,basic}'));
$modules__bottom           = trim(JHtml::_('content.prepare', '{loadposition 5-bottom,block}'));
$modules__footer_top       = trim(JHtml::_('content.prepare', '{loadposition 6-footer-top,block}'));
$modules__footer_mid_left  = trim(JHtml::_('content.prepare', '{loadposition 6-footer-mid-left,block}'));
$modules__footer_mid_right = trim(JHtml::_('content.prepare', '{loadposition 6-footer-mid-right,block}'));


// Branded search pages need an extra query string parameter to limit the search to just that part
// of the site. This may not be the best place to establish this, so keep that in mind.
$page_search_area = '';
if ($page_brand->alias != 'npeu') {
    
        $query = '
            SELECT id
            FROM #__finder_taxonomy
            WHERE title = "' . $page_brand->name . '";
        ';
        $db->setQuery($query);
        $page_search_area = $db->loadResult();
}




// Level 1 menu items that are not mainmenu or are landing pages:
// (Note this isn't robust as if new non-brand menus are created or names change, this will fail)
//$page_is_landing = $menu_item->menutype != 'mainnenu' && $menu_item->menutype != 'user' && $menu_item->level == 1;
// May be better to check the brand that's applied as that's less likely to change
// (can't easily check template style unfortunately)
$page_is_landing = $menu_item->params->get('is_landing', 'auto');
if ($page_is_landing == 'auto') {
    $page_is_landing = $page_brand->alias == 'npeu' && $menu_item->level == 0; //? Needs checking
    $page_is_landing = $page_brand->alias != 'npeu' && $menu_item->level == 1;
} else {
    $page_is_landing = (bool) $page_is_landing;
}

// Override landing setting for subroutes if necessary:
if ($page_is_subroute) {
    $page_is_landing = (bool) $menu_item->params->get('subroute_is_landing', '1');
}

// Head data:
$page_head_data = $doc->getHeadData();
#echo '<pre>'; var_dump($page_head_data); echo '</pre>'; exit;

// Template
$page_template        = TplNPEU6Helper::get_template();
$page_template_params = $page_template->params->toObject();

#echo '<pre>'; var_dump($page_template); echo '</pre>'; exit;
#echo '<pre>'; var_dump($page_template_params); echo '</pre>'; exit;

// Page Heading / Title
$page_heading = isset($doc->article)
              ? $doc->article->title
              : $menu_item->title;
$page_title    = $page_heading;

// Menu Items can override the heading / title in 'Page Display' tab:
if (!empty($menu_item->params->get('page_heading', false))) {
    $page_heading = $menu_item->params->get('page_heading');
}

if (!empty($menu_item->params->get('page_title', false))) {
    $page_title = $menu_item->params->get('page_title');
}

$show_page_heading = $menu_item->params->get('show_page_heading', false);




if ($page_heading != $page_template_params->site_title) {
   $page_title .= ' | ' . $page_template_params->site_title;
}

$page_has_article              = !empty($doc->article);

// Category blogs should be assumed to use 'Read More' as-is, and treat introtext as just that, NOT
// priority content.
$page_has_priority_content = false;
$is_blog = (
    $menu_item->query['option'] == 'com_content'
 && $menu_item->query['view']   == 'category'
 && $menu_item->query['layout'] == 'blog'
);

if (!$is_blog) {
    $page_has_priority_content = !empty($doc->article->fulltext);
}

$page_has_pull_outs = false;
$page_has_sidebar_top          = 0;
$page_has_sidebar_section_menu = 0;
$page_has_sidebar_bottom       = 0;


// Handle page-specific disabling of sidebar modules:
$page_default_view = $menu_item->query['view'];
#echo '<pre>'; var_dump($page_default_view); echo '</pre>'; exit;
$page_current_view = $input->get('view');
#echo '<pre>'; var_dump($page_current_view); echo '</pre>'; exit;
$page_is_component_root = $page_default_view == $page_current_view;



// We can't FORCE show modules, because there may not be any, but we can force DON'T SHOW modules:
$page_disable_modules = $menu_item->params->get('disable_modules');
if (!(
    $page_disable_modules == 'always'
 || $page_disable_modules == 'root' && $page_is_component_root
 || $page_disable_modules == 'sub' && !$page_is_component_root
)) {
    
    $page_has_sidebar_top          = $doc->countModules('4-sidebar-top');
    $page_has_sidebar_section_menu = $doc->countModules('4-sidebar-section-menu');
    $page_has_sidebar_bottom       = $doc->countModules('4-sidebar-bottom');
}

$page_has_footer_top           = $doc->countModules('6-footer-top');
$page_has_footer_mid_left      = $doc->countModules('6-footer-mid-left');
$page_has_footer_mid_right     = $doc->countModules('6-footer-mid-right');
#echo '<pre>'; var_dump($doc->countModules('4-sidebar-bottom')); echo '</pre>'; exit;
#echo '<pre>'; var_dump($page_has_footer_mid_left); echo '</pre>'; exit;
#echo '<pre>'; var_dump($page_has_footer_mid_right); echo '</pre>'; exit;

// Sort out Badges
$page_badge = '';
if ($doc->countModules('3-main-badge') > 0) {
    $page_badge = JHtml::_('content.prepare', '{loadposition 3-main-badge,sidebar}');
    
    if (!empty($page_badge)) {
        $page_has_sidebar_top++;
    }
}


// Sort out ToC. May make this a module to make it clearer to others where this comes from:
$page_toc = '';
if ($page_has_article) {
    $page_toc = JHtml::_('content.prepare', '{loadposition 3-main-toc,sidebar}');
    
    if (!empty($page_toc)) {
        $page_has_sidebar_top++;
    }
}


$component__sidebar_top = false;
if (isset($doc->component__sidebar_top)) {
    $component__sidebar_top = $doc->component__sidebar_top;
    $page_has_sidebar_top++;
}

$component__sidebar_bottom = false;
if (isset($doc->component__sidebar_bottom)) {
    $component__sidebar_bottom = $doc->component__sidebar_bottom;
    $page_has_sidebar_bottom++;
}



#echo '<pre>'; var_dump($page_has_article); echo '</pre>'; exit;
#echo '<pre>'; var_dump($page_has_priority_content); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($page_has_sidebar_top); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($page_has_sidebar_section_menu); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($page_has_sidebar_bottom); echo '</pre>'; #exit;

$page_has_pull_outs = $page_has_priority_content || $page_has_sidebar_top || $page_has_sidebar_section_menu || $page_has_sidebar_bottom;
#echo '<pre>'; var_dump($page_has_pull_outs); echo '</pre>'; #exit;



// We can't FORCE show modules, because there may not be any, but we can force DON'T SHOW modules:
// Hmmm. We're overriding the possibility of other pull-out content, which isn't great.
// Changing this.
/*
if (
    $page_disable_modules == 'always'
 || $page_disable_modules == 'root' && $page_is_component_root
 || $page_disable_modules == 'sub' && !$page_is_component_root
) {
    $page_has_pull_outs = false;
}
*/
#echo '<pre>'; var_dump($page_has_pull_outs); echo '</pre>'; exit;

#$menu_item->params->get('hero_image');

$page_has_main_lower = $doc->countModules('3-main-lower');

// Page Description
$page_description = $doc->description != ''
                  ? $doc->description
                  : $page_template_params->site_description;

if (isset($menu_item)) {
    if ($menu_description = $menu_item->params->get('menu-meta_description', false)) {
        $page_description = $menu_description ;
    }
}


// Page Keywords
$page_keywords = false;
if (isset($doc->_metaTags['standard'])) {
    $page_keywords = $doc->_metaTags['standard']['keywords'];
}


// Page SVG Icons
$page_svg_icons   = str_replace("> ", ">\n ", $page_template_params->svg_icons);


// Assets:
$page_stylesheets = TplNPEU6Helper::remove_joomla_stylesheets($page_head_data['styleSheets'], $doc);
$page_style       = $page_head_data['style'];
$doc->joomla_scripts = array();
$page_scripts     = TplNPEU6Helper::remove_joomla_scripts($page_head_data['scripts'], $doc);
// This is problematic as it's not easy to remove Joomla/jQuery stuff so just bypass for now:
if (!empty($doc->include_script)) {
    $page_script      = !empty($page_head_data['script']) ? $page_head_data['script']['text/javascript'] : array();
} else {
    $page_script      = '';
}

#echo '<pre>'; var_dump($page_stylesheets); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($page_styles); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($page_scripts); echo '</pre>'; exit;
#echo '<pre>'; var_dump($page_script); echo '</pre>'; exit;


// Main Call to action:
$page_cta_text     = $page_template_params->cta_text;
$page_cta_url      = $page_template_params->cta_url;
$page_display_cta  = $page_cta_text && $page_cta_url;

// Header:
$header_balance = array();
$header_balance[] = '50';
$header_balance[] = '50';
if (!empty($page_template_params->header_balance)) {
    switch ($page_template_params->header_balance) {
        case '100' :
            $header_balance[0] = '100';
            $header_balance[1] = '100';
            break;
        case '33--66' :
            $header_balance[0] = '33-333';
            $header_balance[1] = '66-666';
            break;
        case '66--33' :
            $header_balance[0] = '66-666';
            $header_balance[1] = '33-333';
            break;    
    }
}

// Navbar:
$page_has_navbar   = $page_template_params->show_navbar && $doc->countModules('2-header-nav-bar') > 0;


// Hero image / Carousel:
$page_hero         = (array) $menu_item->params->get('hero_image');
#echo '<pre>'; var_dump($page_hero); echo '</pre>'; exit;

$page_has_hero     = !empty($page_hero['hero_image0']->image);
$page_has_carousel = $page_has_hero && count($page_hero) > 1;

// Extract meta for ease of use:
if ($page_has_hero) {
    foreach ($page_hero as $key => $image) {
        $image_meta = array();
        $image_meta_response = json_decode(file_get_contents(
            'https://' . $_SERVER['HTTP_HOST'] . '/plugins/system/imagemeta/ajax/image-meta.php?image=' . base64_encode($image->image)
        ), true);

        if (isset($image_meta_response['success']) && isset($image_meta_response['data'])) {
            $image_meta = $image_meta_response['data'];
        }

        if (isset($image_meta['copyright'])) {
            $image->credit = trim(TplNPEU6Helper::tweak_markdown_output(
                Markdown::defaultTransform($image_meta['copyright']),
                array('trim_paragraph' => true, 'add_link_spans' => true)
            ));
        }
    }
}
#echo '<pre>'; var_dump($page_hero); echo '</pre>'; exit;

$page_hero         = ($page_has_hero && !$page_has_carousel) ? $page_hero['hero_image0'] : false;
$page_carousel     = ($page_has_hero && $page_has_carousel)  ? $page_hero : false;


// Headline image:
$show_headline_image = $menu_item->params->get('show_headline_image', 1);

// Meta (?):
$page_unit        = $page_template_params->unit;
#echo '<pre>'; var_dump($page_unit); echo '</pre>'; exit;

// Footer:
// Convert HTML entities, replace year placeholder with year, transform markdown.
// Remove enclosing p tag.
// Page footer links need to have their link text wrapped in spans, as per the Utilitest pattern.
$page_footer_text = TplNPEU6Helper::tweak_markdown_output(
    Markdown::defaultTransform(str_replace('{{ YEAR }}', date('Y'), htmlentities($page_template_params->footer_text))),
    array('trim_paragraph' => true, 'add_link_spans' => true)
);



// Nested Layouts:
$inner_structure = $page_template_params->layout_name;
// Leaving this out for now:
#$page_layout     = 'page--basic';



// Override vars in case of errors:
if ($is_error) {
    $page_title      = 'Error ' . $error_code;
    $inner_structure = 'structure--basic';
    $page_content    = $error_output;  
}

include(__DIR__ . '/layouts/structure.php');
