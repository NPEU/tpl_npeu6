<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  tpl_npeu6
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */
ini_set('display_errors', 'On');


defined('_JEXEC') or die;

require_once __DIR__ . '/vendor/autoload.php';

use \Michelf\Markdown;


// Include the template helper:
JLoader::register('TplNPEU6Helper', __DIR__ . '/helper.php');


$app   = JFactory::getApplication();
$doc   = JFactory::getDocument();
$input = JFactory::getApplication()->input;
$db    = JFactory::getDBO();
$user  = JFactory::getUser();

#echo '<pre>'; var_dump($app); echo '</pre>'; exit;
#echo '<pre>'; var_dump($doc); echo '</pre>'; exit;
#echo '<pre>'; var_dump($input); echo '</pre>'; exit;
echo '<pre>'; var_dump($user); echo '</pre>'; exit;


// Set variables otherwise declared in error.php:
if (!isset($is_error)) {
    $is_error = false;
}
if (!isset($error_menu_id)) {
    $error_menu_id = false;
}
if (!isset($menu_item)) {
    $menu_item = TplNPEU6Helper::get_menu_item();
}
$menu_root = explode('/', $menu_item->route)[0];
echo '<pre>'; var_dump($menu_item); echo '</pre>'; exit;
#echo '<pre>'; var_dump($menu_item->params->get('hero_image')); echo '</pre>'; exit;
#echo '<pre>'; var_dump($menu_root); echo '</pre>'; exit;
#echo '<pre>'; var_dump($menu_item->access); echo '</pre>'; exit;

// Brand
$page_brand      = TplNPEU6Helper::get_brand();
#echo '<pre>'; var_dump($page_brand); echo '</pre>'; exit;


// Modules sometimes need to add scripts and styles ot the $doc but if we wait to use <jdoc> they're
// processed too late and get missed.
// Pre-rendering all modules here to avoid that. Not sure if there will be other consequences.
jimport('joomla.application.module.helper');
$modules__header_nav_bar  = JHtml::_('content.prepare', '{loadposition 2-header-nav-bar,basic}');
$modules__main_breadcumbs = JHtml::_('content.prepare', '{loadposition 3-main-breadcrumbs,basic}');
$modules__main_upper      = JHtml::_('content.prepare', '{loadposition 3-main-upper,basic}');
$modules__sidebar_top     = JHtml::_('content.prepare', '{loadposition 4-sidebar-top,sidebar}');
$modules__sidebar_bottom  = JHtml::_('content.prepare', '{loadposition 4-sidebar-bottom,sidebar}');
$modules__main_lower      = JHtml::_('content.prepare', '{loadposition 3-main-lower,basic}');
$modules__bottom          = JHtml::_('content.prepare', '{loadposition 5-bottom,block}');
$modules__footer_top      = JHtml::_('content.prepare', '{loadposition 6-footer-top,block}');


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
        $page_search_area = '&t[]=' . $db->loadResult();
}




// Level 1 menu items that are not mainmenu or are landing pages:
// (Note this isn't robust as if new non-brand menus are created or names change, this will fail)
//$page_is_landing = $menu_item->menutype != 'mainnenu' && $menu_item->menutype != 'user' && $menu_item->level == 1;
// May be better to check the brand that's applied as that's less likely to change
// (can't easily check template style unfortunately)
$page_is_landing = $page_brand->alias == 'npeu' && $menu_item->level == 0; //? Needs checking
$page_is_landing = $page_brand->alias != 'npeu' && $menu_item->level == 1;

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
              
#echo '<pre>'; var_dump($page_heading); echo '</pre>'; exit;
$page_title   = $page_heading;

if ($page_heading != $page_template_params->site_title) {
   $page_title .= ' | ' . $page_template_params->site_title;
}

$page_has_article              = !empty($doc->article);
$page_has_priority_content     = !empty($doc->article->fulltext);
$page_has_sidebar_top          = $doc->countModules('4-sidebar-top');
$page_has_sidebar_section_menu = $doc->countModules('4-sidebar-section-menu');
$page_has_sidebar_bottom       = $doc->countModules('4-sidebar-bottom');


// Sort out ToC. May make this a module to make it clearer to others where this comes from:
$page_toc = '';
if ($page_has_article) {
    $min_h2_count = 3;
    
    // ToC requires id's on headers, so add them if not already present.
    // Note this is a back-up, ideally the editor will create them so they're saved into the article.
    #$h2s = preg_match_all('#<h2[^>]*(id="([^"]+)")?[^>]*>#', $doc->article->text, $matches, PREG_SET_ORDER);
    preg_match_all('#<h2[^>]*>([^<]+)</h2>#', $doc->article->text, $matches, PREG_SET_ORDER);
    
    if (count($matches) >= $min_h2_count) {
        
        $page_toc .= '<div class="c-panel  c-panel--very-light  t-neutral  u-space--above  u-space--above">' . "\n";
        $page_toc .= '<nav class="c-panel--module" aria-label="table of contents">' . "\n";
        $page_toc .= '<div class="n-section-menu">' . "\n";
        $page_toc .= '<h2>On this page</h2>' . "\n";
        $page_toc .= '<ul class="n-section-menu__list">' . "\n";
        
        foreach ($matches as $match) {
            preg_match('#id="[^"]+"#', $match[0], $id_match);
            #echo '<pre>'; var_dump($id_match); echo '</pre>'; #exit;
            if(!isset($id_match[0])) {
                $h2_id = TplNPEU6Helper::htmlID($match[1]);
                $new_h2 = str_replace('<h2', '<h2 id="' . $h2_id . '"', $match[0]);
                
                $doc->article->text      = str_replace($match[0], $new_h2, $doc->article->text);
                $doc->article->fulltext  = str_replace($match[0], $new_h2, $doc->article->fulltext);
                $doc->article->introtext = str_replace($match[0], $new_h2, $doc->article->introtext);
            } else {
                $h2_id = $id_match[0];
            }
            $page_toc .= '<li class="n-section-menu__item"><a href="#' . $h2_id . '" class="n-section-menu__link">' . $match[1] . '</a></li>' . "\n";
        }
        $page_toc .= '</ul>' . "\n";
        $page_toc .= '</div>' . "\n";
        $page_toc .= '</nav>' . "\n";
        $page_toc .= '</div>' . "\n";
        
        $page_has_sidebar_bottom++;
    }
}


#echo '<pre>'; var_dump($page_has_article); echo '</pre>'; exit;
#echo '<pre>'; var_dump($page_has_priority_content); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($page_has_sidebar_top); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($page_has_sidebar_section_menu); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($page_has_sidebar_bottom); echo '</pre>'; #exit;

$page_has_pull_outs = $page_has_priority_content || $page_has_sidebar_top || $page_has_sidebar_section_menu || $page_has_sidebar_bottom;
#echo '<pre>'; var_dump($page_has_pull_outs); echo '</pre>'; #exit;

// Handle page-specific disabling of sidebar modules:
$page_default_view = $menu_item->query['view'];
#echo '<pre>'; var_dump($page_default_view); echo '</pre>'; exit;
$page_current_view = $input->get('view');
#echo '<pre>'; var_dump($page_current_view); echo '</pre>'; exit;
$page_is_component_root = $page_default_view == $page_current_view;

$page_disable_modules = $menu_item->params->get('disable_modules');

// We can't FORCE show modules, because there may not be any, but we can force DON'T SHOW modules:
if (
    $page_disable_modules == 'always'
 || $page_disable_modules == 'root' && $page_is_component_root
 || $page_disable_modules == 'sub' && !$page_is_component_root
) {
    $page_has_pull_outs = false;
}

#echo '<pre>'; var_dump($page_has_pull_outs); echo '</pre>'; exit;

$menu_item->params->get('hero_image');

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
$page_stylesheets = $page_head_data['styleSheets'];
$page_style       = $page_head_data['style'];
$page_scripts     = $page_head_data['scripts'];
$page_script      = !empty($page_head_data['script']) ? $page_head_data['script']['text/javascript'] : array();

#echo '<pre>'; var_dump($page_stylesheets); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($page_styles); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($page_scripts); echo '</pre>'; exit;
#echo '<pre>'; var_dump($page_script); echo '</pre>'; exit;


// Main Call to action:
$page_cta_text     = $page_template_params->cta_text;
$page_cta_url      = $page_template_params->cta_url;
$page_display_cta  = $page_cta_text && $page_cta_url;


// Navbar:
$page_has_navbar   = $page_template_params->show_navbar && $doc->countModules('2-header-nav-bar') > 0;


// Hero image / Carousel:
$page_hero         = (array) $menu_item->params->get('hero_image');
#echo '<pre>'; var_dump($page_hero); echo '</pre>'; exit;

$page_has_hero     = !empty($page_hero['hero_image0']->image);
$page_has_carousel = $page_has_hero && count($page_hero) > 1;

$page_hero         = ($page_has_hero && !$page_has_carousel) ? $page_hero['hero_image0'] : false;
$page_carousel     = ($page_has_hero && $page_has_carousel)  ? $page_hero : false;



// Meta (?):
$page_unit        = $page_template_params->unit;


// Footer:
// In order: convert HTML entities, replace year placeholder with year, transform markdown, then remove enclosing p tag.
$page_footer_text = preg_replace(array('/^<p>/', '/<\/p>$/'), '', Markdown::defaultTransform(str_replace('{{ YEAR }}', date('Y'), htmlentities($page_template_params->footer_text))));

// Nested Layouts:
$inner_structure = $page_template_params->layout_name;
// Leaving this out for now:
#$page_layout     = 'page--basic';



// Page Content:
// $page_content = '<p>Replace this.</p>';
// Using <jdoc:include type="component" format="raw" />

include(__DIR__ . '/layouts/structure.php');