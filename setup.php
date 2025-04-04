<?php
/**
 * @package     Joomla.Site
 * @subpackage  tpl_npeu6
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;
use Joomla\Registry\Registry;

use NPEU\Template\Npeu6\Site\Helper\Npeu6Helper as TplNPEU6Helper;

require_once __DIR__ . '/vendor/autoload.php';

use \Michelf\Markdown;


#echo '<pre>'; var_dump('here'); echo '</pre>'; exit;
switch ($_SERVER['SERVER_NAME']) {
    case 'dev.npeu.ox.ac.uk' :
        $env = 'development';
        break;
    case 'test.npeu.ox.ac.uk':
        $env = 'testing';
        break;
    case 'sandbox.npeu.ox.ac.uk':
        $env = 'sandbox';
        break;
    case 'next.npeu.ox.ac.uk':
        $env = 'next';
        break;
    default:
        $env = 'production';
}
#echo '<pre>'; var_dump($env); echo '</pre>'; exit;

$app   = Factory::getApplication();
$doc   = Factory::getDocument();
$db    = Factory::getDBO();
$user  = Factory::getUser();
$uri   = Uri::getInstance();
$input = $app->input;
$menu  = $app->getMenu();

#echo '<pre>'; var_dump($app); echo '</pre>'; exit;
#echo '<pre>'; var_dump($doc); echo '</pre>'; exit;
#echo '<pre>'; var_dump($input); echo '</pre>'; exit;
#echo '<pre>'; var_dump($user); echo '</pre>'; exit;
#echo '<pre>'; var_dump($user->getAuthorisedGroups()); echo '</pre>'; exit;
#echo '<pre>'; var_dump($uri); echo '</pre>'; exit;
#echo '<pre>'; var_dump($uri->getPath()); echo '</pre>'; exit;
#echo '<pre>'; var_dump($menu); echo '</pre>'; exit;


// If the user has the staff group id (10) in their auth groups array, they are a member of staff,
// so provide a short cut:
$user->set('is_staff', in_array(10, $user->getAuthorisedGroups()));
#echo '<pre>'; var_dump($user); echo '</pre>'; exit;

// Set variables otherwise declared in error.php:
if (!isset($is_error)) {
    $is_error = false;
}
if (!isset($is_offline)) {
    $is_offline = false;
}
#echo '<pre>'; var_dump($is_error); echo '</pre>'; #exit;
if (!isset($error_menu_id)) {
    $error_menu_id = false;
}
if (!isset($menu_item)) {
    $menu_item = TplNPEU6Helper::get_menu_item();
    $menu_item_params = $menu_item->getParams();
}

$menu_root = explode('/', $menu_item->route)[0];
if (!isset($menu_id)) {
    $menu_id = TplNPEU6Helper::get_menu_id();
}


// Look to see if this menu item has an 'add article' form as a child, so we can display a link if so.
$has_add_form_child = false;
$add_form_child_url = '';
$menu_item_children = $menu->getItems('parent_id', $menu_item->id);
foreach ($menu_item_children as $child) {
    if ($child->link == 'index.php?option=com_content&view=form&layout=edit') {
        $has_add_form_child = true;
        $add_form_child_url = $child->route;
        break;
    }
}

$menu_root_id = $menu_item->tree[0];
$menu_root_item = $app->getMenu()->getItem($menu_root_id);

#echo '<pre>'; var_dump($add_form_child_url); echo '</pre>'; exit;

#echo '<pre>'; var_dump($menu_item); echo '</pre>'; exit;
#echo '<pre>'; var_dump($menu_item->alias); echo '</pre>'; exit;
#echo '<pre>'; var_dump($menu_item->title); echo '</pre>'; exit;
#echo '<pre>'; var_dump($$menu_item_params->get('hero_image')); echo '</pre>'; exit;
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

#echo '<pre>'; var_dump($menu_route); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($uri_route); echo '</pre>'; exit;
#echo '<pre>'; var_dump($page_is_subroute); echo '</pre>'; exit;
// Brand
$page_brand        = TplNPEU6Helper::get_brand();

$page_brand_folder = $page_brand->alias . '/';
#echo '<pre>'; var_dump($page_brand); echo '</pre>'; exit;

// Modules sometimes need to add scripts and styles to the $doc but if we wait to use <jdoc> they're
// processed too late and get missed.
// Pre-rendering all modules here to avoid that. Not sure if there will be other consequences.
// NOTE - defining module styles (chrome) here is unreliable because the module renderer overrides
// it if the module itself specifies it (which they often do)

jimport('joomla.application.module.helper');

$modules__top                  = trim(HTMLHelper::_('content.prepare', '{loadposition 1-top,basic}'));
$modules__header_nav_bar       = trim(HTMLHelper::_('content.prepare', '{loadposition 2-header-nav-bar,basic}'));
$modules__main_breadcumbs      = trim(HTMLHelper::_('content.prepare', '{loadposition 3-main-breadcrumbs,basic}'));
$modules__main_upper           = trim(HTMLHelper::_('content.prepare', '{loadposition 3-main-upper,basic}'));
$modules__sidebar_top          = trim(HTMLHelper::_('content.prepare', '{loadposition 4-sidebar-top,sidebar}'));
//$modules__sidebar_section_menu = trim(HTMLHelper::_('content.prepare', '{loadposition 4-sidebar-section-menu,sidebar}'));
$modules__sidebar_bottom       = trim(HTMLHelper::_('content.prepare', '{loadposition 4-sidebar-bottom,sidebar}'));
$modules__main_lower           = trim(HTMLHelper::_('content.prepare', '{loadposition 3-main-lower,basic}'));
$modules__bottom               = trim(HTMLHelper::_('content.prepare', '{loadposition 5-bottom,block}'));
$modules__footer_top           = trim(HTMLHelper::_('content.prepare', '{loadposition 6-footer-top,block}'));
$modules__footer_mid_left      = trim(HTMLHelper::_('content.prepare', '{loadposition 6-footer-mid-left,block}'));
$modules__footer_mid_right     = trim(HTMLHelper::_('content.prepare', '{loadposition 6-footer-mid-right,bespoke layout_box}'));
$modules__footer_mid_bottom    = trim(HTMLHelper::_('content.prepare', '{loadposition 6-footer-mid-bottom}'));
$modules__footer_bottom        = trim(HTMLHelper::_('content.prepare', '{loadposition 6-footer-bottom,block}'));


$modules__log_in_out_button    = trim(HTMLHelper::_('content.prepare', '{loadposition log-in-out-button,basic}'));

#echo '<pre>'; var_dump($modules__sidebar_bottom); echo '</pre>'; exit;
#echo '<pre>'; var_dump($modules__footer_mid_right); echo '</pre>'; exit;

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
$page_is_landing = $menu_item_params->get('is_landing', 'auto');

if ($page_is_landing == 'auto') {
    $page_is_landing = $page_brand->alias == 'npeu' && $menu_item->level == 0; //? Needs checking
    $page_is_landing = $page_brand->alias != 'npeu' && $menu_item->level == 1;
} else {
    $page_is_landing = (bool) $page_is_landing;
}

// Override landing setting for subroutes if necessary:
if ($page_is_subroute) {
    $page_is_landing = (bool) $menu_item_params->get('subroute_is_landing', '1');
}

// Override special case of page being an 'add/edit' form:
if ($has_add_form_child) {
    $page_is_landing = false;
}
#echo '<pre>'; var_dump($page_is_landing ); echo '</pre>'; exit;
// Head data:
$page_head_data = $doc->getHeadData();
#echo '<pre>'; var_dump($page_head_data); echo '</pre>'; exit;

// Template
$page_template        = TplNPEU6Helper::get_template();
#echo 'after<pre>'; var_dump($page_template); echo '</pre>';exit;

$page_template_params = $page_template->params->toObject();

#echo '<pre>'; var_dump($page_template); echo '</pre>'; exit;
#echo '<pre>'; var_dump($page_template_params); echo '</pre>'; exit;

// Page Heading / Title
$page_heading = isset($doc->article)
              ? $doc->article->title
              : $menu_item->title;
if (isset($doc->page_heading_additional)) {
    $page_heading .= $doc->page_heading_additional;
}
$page_title = $page_heading;

// Menu Items can override the heading / title in 'Page Display' tab:
if (!empty($menu_item_params->get('page_heading', false))) {
    $page_heading = $menu_item_params->get('page_heading');
}

if (!empty($menu_item_params->get('page_title', false))) {
    $page_title = $menu_item_params->get('page_title');
}

$show_page_heading = $menu_item_params->get('show_page_heading', false);


if ($page_heading != $page_template_params->site_title) {
   $page_title .= ' | ' . $page_template_params->site_title;
}

if ($page_template_params->site_title != 'NPEU') {
    $page_title .= ' | NPEU';
}

$page_has_article = !empty($doc->article);

// Category blogs should be assumed to use 'Read More' as-is, and treat introtext as just that, NOT
// priority content.
$page_has_priority_content = false;
$is_blog = (
    $menu_item->query['option'] == 'com_content'
 && $menu_item->query['view']   == 'category'
 && (isset($menu_item->query['layout']) && $menu_item->query['layout']== 'blog')
);

if (!$is_blog) {
    $page_has_priority_content = !empty($doc->article->fulltext);
}

$page_has_pull_outs = false;
$page_has_sidebar_super        = 0;
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
$page_disable_modules = $menu_item_params->get('disable_modules');
if (!(
    $page_disable_modules == 'always'
 || $page_disable_modules == 'root' && $page_is_component_root
 || $page_disable_modules == 'sub' && !$page_is_component_root
)) {

    $page_has_sidebar_top          = empty($modules__sidebar_top)          ? 0 : $doc->countModules('4-sidebar-top');
    //$page_has_sidebar_section_menu = empty($modules__sidebar_section_menu) ? 0 : $doc->countModules('4-sidebar-section-menu');
    $page_has_sidebar_bottom       = empty($modules__sidebar_bottom)       ? 0 : $doc->countModules('4-sidebar-bottom');
}

#echo '<pre>'; var_dump($page_has_sidebar_bottom); echo '</pre>'; exit;

$page_footer_top_count         = $doc->countModules('6-footer-top');
$page_has_footer_top           = empty($modules__footer_top)        ? 0 : $doc->countModules('6-footer-top');
$page_has_footer_mid_left      = empty($modules__footer_mid_left)   ? 0 : $doc->countModules('6-footer-mid-left');
$page_has_footer_mid_right     = empty($modules__footer_mid_right)  ? 0 : $doc->countModules('6-footer-mid-right');
$page_has_footer_mid_bottom    = empty($modules__footer_mid_bottom) ? 0 : $doc->countModules('6-footer-mid-bottom');
#echo '<pre>'; var_dump($doc->countModules('4-sidebar-bottom')); echo '</pre>'; exit;
#echo '<pre>'; var_dump($page_has_footer_mid_left); echo '</pre>'; exit;
#echo '<pre>'; var_dump($page_has_footer_mid_right); echo '</pre>'; exit;

// Sort out Badges
$page_badge = '';
if ($doc->countModules('3-main-badge') > 0) {
    $page_badge = HTMLHelper::_('content.prepare', '{loadposition 3-main-badge,sidebar}');

    if (!empty($page_badge)) {
        $page_has_sidebar_super++;

        if ($menu_root_item->title != $menu_item->title) {
            $page_title .= ' > ' . $menu_root_item->title;
        }

    }
}


// Sort out ToC. May make this a module to make it clearer to others where this comes from:
$page_toc = '';
if ($page_has_article) {
    $page_toc = HTMLHelper::_('content.prepare', '{loadposition 3-main-toc,sidebar}');

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
#echo '<pre>'; var_dump($component__sidebar_bottom); echo '</pre>'; exit;



#echo '<pre>'; var_dump($page_has_article); echo '</pre>'; exit;
#echo '<pre>'; var_dump($page_has_priority_content); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($page_has_sidebar_top); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($page_has_sidebar_section_menu); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($page_has_sidebar_bottom); echo '</pre>'; exit;

$page_has_pull_outs = $page_has_sidebar_super || $page_has_priority_content || $page_has_sidebar_top || $page_has_sidebar_section_menu || $page_has_sidebar_bottom;
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

#$$menu_item_params->get('hero_image');

$page_has_main_lower = $doc->countModules('3-main-lower');

// Determine if an Area Menu or Section Menu is present:
$page_has_area_menu    = false;
$page_area_menu_id     = 'menu';
$page_has_section_menu = false;
$sidebar_bottom_modules = ModuleHelper::getModules('4-sidebar-bottom');

foreach ($sidebar_bottom_modules as $module) {
    //$registry = Joomla\Registry\Registry::getInstance('mod_' . $module->id);
    $registry = new Registry('mod_' . $module->id);
    $module_params = $registry->loadString($module->params);

    if ($module_params->get('layout') == 'npeu6:Area-Menu') {
        $t1 = HTMLHelper::_('content.prepare', '{loadmoduleid ' . $module->id .'}');

        if (!empty($t1)) {
            $page_has_area_menu = true;
            $page_area_menu_id  = TplNPEU6Helper::html_id($module->title);
            continue;
        }
    }

    if ($module_params->get('layout') == 'npeu6:Section-Menu') {
        $t2 = HTMLHelper::_('content.prepare', '{loadmoduleid ' . $module->id .'}');

        if (!empty($t2)) {
            $page_has_section_menu = true;
            continue;
        }
    }
}

// Page Description
$page_description = $doc->description != ''
                  ? $doc->description
                  : $page_template_params->site_description;

if (isset($menu_item)) {
    if ($menu_description = $menu_item_params->get('menu-meta_description', false)) {
        $page_description = $menu_description ;
    }
}

// Page description is quite important, but very rarely entered for menu items or article.
// (Need culture shift / training here).
// It's especially important for news articles for social media, so attempting to auto-improve
// things here:
if ($page_description == $page_template_params->site_description) {
    // Description is still the default...

    if (isset($doc->article) && $doc->article->catid == 63) {
        // This is news article, extract the first paragraph:
        $text = $doc->article->introtext;
        $page_description = strip_tags(substr($text, strpos($text, "<p"), strpos($text, "</p>") + 4));
    }
}


// Page Keywords
$page_keywords = false;
if (isset($doc->_metaTags['standard'])) {
    $page_keywords = $doc->_metaTags['standard']['keywords'];
}


// Page SVG Icons
#$page_svg_icons   = str_replace("> ", ">\n ", $page_template_params->svg_icons);
$page_svg_icons = str_replace("> ", ">\n ", file_get_contents(__DIR__ . '/svg/icons.svg'));

// Assets:
$page_stylesheets = TplNPEU6Helper::remove_joomla_stylesheets($page_head_data['styleSheets'], $doc);
$page_style       = $page_head_data['style'];
if (!empty($page_style['text/css'])) {
    $page_style       = $page_style['text/css'];
}


$doc->joomla_scripts = [];
$page_scripts     = TplNPEU6Helper::remove_joomla_scripts($page_head_data['scripts'], $doc);

// This is problematic as it's not easy to remove Joomla/jQuery stuff so just bypass for now:
if (!empty($doc->include_script)) {
    $page_script      = !empty($page_head_data['script']) ? trim(implode("\n", $page_head_data['script']['text/javascript'])) : '';
} else {
    $page_script      = '';
}
/*
if ($page_script !== '') {

    $page_script = preg_replace('/\t/', '    ', $page_script);
    $page_script = preg_replace('/^    /m', '', $page_script);
}
*/
#echo '<pre>'; var_dump($page_stylesheets); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($page_style); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($page_scripts); echo '</pre>'; exit;
#echo '<pre>'; print_r($page_script); echo '</pre>'; exit;


// Main Call to action:
$page_cta_text     = $page_template_params->cta_text;
$page_cta_url      = $page_template_params->cta_url;
$page_display_cta  = $page_cta_text && $page_cta_url;

// Header:
$header_balance = [];
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

// Search field:
$search_field_hint = !empty($page_template_params->search_hint) ? $page_template_params->search_hint : '';





// Hero image / Carousel:
$all_page_heroes         = (array) $menu_item_params->get('hero_image');
#echo '<pre>'; var_dump($all_page_heroes); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($user->authorise('core.create', 'com_media')); echo '</pre>'; exit;

// Page heroes can now be disabled individually so we need to process that:
//$page_has_hero     = !empty($page_heroes['hero_image0']->image);
//$page_has_carousel = $page_has_hero && count($page_heroes) > 1;
$page_heroes   = [];
$page_has_hero = false;
$page_has_carousel = false;

if (!empty($all_page_heroes)) {
    foreach ($all_page_heroes as $image) {
        if (empty($image->image) || (bool) $image->enabled == false) {
            continue;
        }

        // Tidy Joomla image src fragment:
        $image->image = preg_replace('/#.*$/', '', $image->image);

        // Extract meta for ease of use:
        $image_meta = [];
        $image_meta_response = json_decode(file_get_contents(
            'https://' . $_SERVER['HTTP_HOST'] . '/plugins/system/imagemeta/ajax/image-meta.php?image=' . base64_encode($image->image)
        ), true);

        #echo '<pre>'; var_dump($image_meta_response); echo '</pre>'; exit;

        if (isset($image_meta_response['success']) && isset($image_meta_response['data'])) {
            $image_meta = $image_meta_response['data'];
        }

        $image->credit = false;
        if (isset($image_meta['copyright'])) {
            $image->credit = trim(TplNPEU6Helper::tweak_markdown_output(
                Markdown::defaultTransform($image_meta['copyright']),
                ['trim_paragraph' => true, 'add_link_spans' => true]
            ));
        }

        $page_heroes[] = $image;
    }

    $page_has_hero     = (count($page_heroes) > 0);
    $page_has_carousel = (count($page_heroes) > 1);
}

#echo '<pre>'; var_dump($page_heroes); echo '</pre>'; exit;

#page_hero         = ($page_has_hero && !$page_has_carousel) ? $page_heroes['hero_image0'] : false;
#$page_carousel     = ($page_has_hero && $page_has_carousel)  ? $page_heroes : false;

#echo '<pre>'; var_dump($page_heroes); echo '</pre>'; exit;

// Headline image:
$show_headline_image = $menu_item_params->get('show_headline_image', 1);

// Meta (?):
$page_unit        = $page_template_params->unit;
#echo '<pre>'; var_dump($page_unit); echo '</pre>'; exit;

// Footer:
// Convert HTML entities, replace year placeholder with year, transform markdown.
// Remove enclosing p tag.
// Page footer links need to have their link text wrapped in spans, as per the Utilitext pattern.
$page_footer_text = TplNPEU6Helper::tweak_markdown_output(
    Markdown::defaultTransform(str_replace('{{ YEAR }}', date('Y'), htmlentities($page_template_params->footer_text))),
    [
        'add_link_spans' => true,
        'split_to_list'  => ' | ',
        'p_classes'      => 'c-utilitext   l-layout  l-row  l-row--center  l-gutter--xs  no-print'
    ]
);

// Article Brand (only for NPEU News category items)
$page_article_brand = false;
if ($page_has_article) {
    if ($brand_alias = $doc->article->params->get('brand', false)) {
        if ($brand_alias != 1) {
            $brand_id = substr($brand_alias, strrpos($brand_alias, '-') + 1);
            $page_article_brand = TplNPEU6Helper::get_brand($brand_id);
        }
    }

}
#echo '$page_has_hero<pre>'; var_dump($page_has_hero); echo '</pre>'; #exit;
#echo '$page_has_article<pre>'; var_dump($page_has_article); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($is_blog); echo '</pre>'; exit;
#echo '<pre>'; var_dump($doc->article->headline_image); echo '</pre>'; exit;

// J4 - headline image storage seems to have changed so try to sort that out:
if (!empty($doc->article->headline_image['headline-image'])) {
    $data = TplNPEU6Helper::resolve_image_data($doc->article->headline_image['headline-image']);
    $doc->article->headline_image['headline-image'] = TplNPEU6Helper::resolve_image_path($data['imagefile']);
}
#echo 'H<pre>'; var_dump($doc->article->headline_image); echo '</pre>'; exit;

// Put Twitter and Page badge in sidebar:
//if (($is_blog && $page_is_subroute) && ($page_article_brand || !empty($doc->article->twitter_url))) {
if (($is_blog && $page_is_subroute) && $page_article_brand) {
    $page_has_pull_outs = true;
    $page_has_sidebar_bottom;
}

// If the page is blog item, then the headline image should be the hero image:
/*
if ($is_blog && $page_is_subroute) {
    if (!empty($doc->article->headline_image['headline-image']) && $show_headline_image == 1) {
            $img = $doc->article->headline_image;
            $page_has_hero = true;
            $page_hero = new stdClass();

            $page_hero->enabled       = 1;
            $page_hero->image         = $img['headline-image'];
            $page_hero->alt           = $img['headline-image-alt-text'];
            $page_hero->heading       = false;
            $page_hero->text          = false;
            $page_hero->text_position = false;
            $page_hero->cta_link      = false;
            $page_hero->cta_text      = false;
            $page_hero->credit        = $img['headline-image-credit-line'];

            $page_heroes = ['hero_image0' => $page_hero];
    }
}
*/

// Social Media:

// Twitter:
$twitter = [];

$twitter['site']        = '@NPEU_Oxford';
$twitter['card']        = 'summary';
$twitter['description'] = $page_description;
$twitter['title']       = $page_title;
if (!empty($doc->article->headline_image['headline-image']) && $show_headline_image == 1) {

    $twitter['image'] = 'https://www.npeu.ox.ac.uk/' . $doc->article->headline_image['headline-image'];
    $twitter['card']  = 'summary_large_image';
}
/*<?php if (!empty($doc->article->headline_image['headline-image']) && $show_headline_image == 1) : ?>*/


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

// Override vars in case of site offline:
if ($is_offline) {
    $page_title      = $offline_page_title;
    $inner_structure = 'structure--basic';
    $page_content    = $offline_output;
}


include(__DIR__ . '/layouts/structure.php');
