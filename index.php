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


// Include the brochure functions only once
JLoader::register('TplNPEU6Helper', __DIR__ . '/helper.php');


$app    = JFactory::getApplication();
$doc    = JFactory::getDocument();

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


// Head data:
$page_head_data = $doc->getHeadData();

// Brand
#$page_brand      = TplNPEU6Helper::get_brand();


// Template
$page_template        = TplNPEU6Helper::get_template();
$page_template_params = $page_template->params;

#echo '<pre>'; var_dump($page_template); echo '</pre>'; exit;
#echo '<pre>'; var_dump($page_template_params); echo '</pre>'; exit;


// Page Heading / Title
$page_heading = !$is_error
              ? $doc->title
              : $menu_item->title;

$page_title   = $page_heading . ' | ' . $page_template_params->get('site_title');


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
$page_svg_icons = str_replace("> ", ">\n ", $page_template_params->get('svg_icons'));



$page_stylesheets = $page_head_data['styleSheets'];
$page_style       = $page_head_data['style'];
$page_scripts     = $page_head_data['scripts'];
$page_script      = !empty($page_head_data['script']) ? $page_head_data['script']['text/javascript'] : array();

#echo '<pre>'; var_dump($page_stylesheets); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($page_styles); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($page_scripts); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($page_script); echo '</pre>'; exit;

// Nested Layouts:
$inner_structure = $page_template_params->get('layout_name');
$page_layout     = 'page--basic';







// Page Content:
// $page_content = '<p>Replace this.</p>';
// Using <jdoc:include type="component" format="raw" />

include(__DIR__ . '/layouts/structure.php');