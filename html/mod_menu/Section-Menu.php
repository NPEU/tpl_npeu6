<?php
// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Uri\Uri;

use NPEU\Template\Npeu6\Site\Helper\Npeu6Helper as TplNPEU6Helper;

/*
    Vars defined in \modules\mod_menu\mod_menu.php:

    $list
    $base
    $active
    $default
    $active_id
    $default_id
    $path
    $showAll
    $class_sfx

*/

#$doc    = Factory::getDocument();
#$app    = Factory::getApplication();

$current_url_path = str_replace(Uri::root(), '', Uri::current());

$brand = TplNPEU6Helper::get_brand();

if (!isset($is_sitemap)) {
    $is_sitemap = false;

    if ($active->alias == 'sitemap2' || $active->alias == 'sitemap') {
        $is_sitemap = true;
    }

}

if(count($list) > 0) :

// Find the access id for 'Hidden' menu items:
$db = Factory::getDBO();

$query = $db->getQuery(true);
$query->select('id')->from('#__viewlevels');
$query->where('title = ' . $db->quote('Hidden from menus'));
$db->setQuery($query);
$hidden_from_menus = $db->loadResult();

$query = $db->getQuery(true);
$query->select('id')->from('#__viewlevels');
$query->where('title = ' . $db->quote('Hidden from menus and sitemap'));
$db->setQuery($query);
$hidden_from_menus_and_sitemap = $db->loadResult();

$nav = '';
//$level = 3;

// First pass to remove items we want to skip.
// Needs to be done this way as otherwise there's no way (I think) to determine if an item really
// has children or not without 'lookahead' loops.
// For the Section Menu, we only want to show items on the current level, but the module doesn't
// allow for this option, so sort that out here too.
$menu_item  = TplNPEU6Helper::get_menu_item();
#echo '<pre>'; var_dump($list); echo '</pre>';

$siblings = array();
$children = array();
foreach ($list as $i => &$item)
{
    $item_level = (int) $item->level;

    // If CURRENT menu id is the same as THIS ITEMs parent, THIS ITEM is a child of CURRENT ...
    if ($menu_item->id == $item->parent_id) {
        $children[] =& $item;
    } elseif ($menu_item->parent_id == $item->parent_id) {
        // ... but if BOTH have the same parent, THIS ITEM is a sibling of CURRENT
        $siblings[] =& $item;
    } else {
        continue;
    }

}

$use_list = $children;
if (empty($use_list)) {
    $use_list = $siblings;
}

$new_list = array();
foreach ($use_list as $i => &$item)
{
    $skip_item  = false;

    // Don't show hidden menu items:
    if ($is_sitemap && $item->access == $hidden_from_menus_and_sitemap) {
        $skip_item = true;
    }
    if (!$is_sitemap && ($item->access == $hidden_from_menus_and_sitemap || $item->access == $hidden_from_menus)) {
        $skip_item = true;
    }

    if (!$skip_item) {
       $new_list[] =& $item;
    }
}

// We're now using a new list. NOTE deeper/shallower no longer always accurate - DO NOT USE

foreach ($new_list as $i => &$item) {
    $level = (int) $item->level;

    $item_class         = '';
    $item_current_class = 'd-background--light  t-neutral';
    $item_link_class    = '';
    $item_attribs = '';

    $nav_item = '';

    // Construct the class:
    $class   = $item_class;
    $current = false;

    if ($item->id == $active_id) {
        // If the id's match, we're in the current menu item, so that needs to be reflected on the
        // menu...
        $class .= '  ' . $item_current_class;
        // However, we may be in a subroot, so only declare $current if that's not the case, or the
        // menu's URL will not be correct:
        if ($active->route == $current_url_path) {
            $current = true;
            $item_attribs = ' aria-current="page"';
        }
    }

    if (!empty($class)) {
        $class = ' class="' . trim($class) . '"';
    }

    $nav_item .= str_repeat("\t", $level) . '<li' . $class . $item_attribs . '>';

    $item->anchor_css = $item_link_class;

    // Add spans for styling purposes:
    // Note that if more than one of the same menu is used on a page, (e.g. Navbar + Section Menu)
    // then, as Joomla caches the menu, the tags are added per-menu, (e.g. twice) so using
    // removing them to prevent this.
    $title = str_replace(array('&lt;span&gt;', '&lt;/span&gt;'), '', $item->title);
    $item->title = '<span>' . $title  . '</span>';
    ob_start();
    // Render the menu item.
    switch ($item->type) {
        case 'separator':
        case 'url':
        case 'component':
            require ModuleHelper::getLayoutPath('mod_menu', 'default_'.$item->type);
            break;
        default:
            require ModuleHelper::getLayoutPath('mod_menu', 'default_url');
            break;
    }
    $output = ob_get_contents();
    ob_end_clean();

    // Reset title to prevent spans appearing on <title> tag:
    $item->title = str_replace(array('&lt;span&gt;', '&lt;/span&gt;'), '', $title);

    if ($current) {
        $output = preg_replace('#href="[^"]+"#', 'href="#main"', $output);
    }

    $nav_item .= str_replace(' >', '>', $output);

    $nav_item .= "\n" . str_repeat("\t", $level) . '</li>';
    $nav .= $nav_item;
}
?>
<?php if(!empty($nav)): ?>
<ul class="n-menu__links  mod_menu">
    <?php echo $nav; ?>
</ul>
<?php endif; ?>
<?php endif; ?>