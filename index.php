<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  tpl_npeu6
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

require_once('_helpers.php');

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
	$menu_item = get_menu_item($app);
}




// Page Title
$page_title = !$is_error
	        ? $doc->title
            : $menu_item->title;

$page_title .= ' | NPEU';


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

include(__DIR__ . '/layouts/structure.php');