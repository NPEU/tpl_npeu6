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




// Page Heading / Title
$page_heading = !$is_error
              ? $doc->title
              : $menu_item->title;

$page_title   = $page_heading . ' | NPEU';


// Page Description
$page_description = $doc->description;

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



// Nested Layouts:
$inner_structure = 'structure--basic';
$page_layout     = 'page--basic';


// Project
$page_project    = TplNPEU6Helper::get_project();


// Template
$page_template   = TplNPEU6Helper::get_template();


// Page Content:
// $page_content = '<p>Replace this.</p>';
// Using <jdoc:include type="component" format="raw" />

require_once(__DIR__ . '/layouts/structure.php');