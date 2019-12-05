<?php
// No direct access
defined('_JEXEC') or die;

$doc         = JFactory::getDocument();
$app         = JFactory::getApplication();
$active_menu = $app->getMenu()->getActive();

// Include the template helper:
JLoader::register('TplNPEU6Helper', dirname(dirname(__DIR__)) . '/helper.php');

$brand = TplNPEU6Helper::get_brand();

if (!isset($is_sitemap)) {
    $is_sitemap = false;
    
    if ($active_menu->alias == 'sitemap2' || $active_menu->alias == 'sitemap') {
        $is_sitemap = true;
    }
    
}

if(count($list) > 0) :

// Find the access id for 'Hidden' menu items:
$db = JFactory::getDBO();

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
$menu_item = TplNPEU6Helper::get_menu_item();
$menu_level = (int) $menu_item->level;
#echo '<pre>'; var_dump($menu_level); echo '</pre>';

$new_list = array();
foreach ($list as $i => &$item) 
{
    $skip_item  = false;
    
    $item_level = (int) $item->level;
    
    if ($menu_level == 2 && $item->level <= $menu_level) {
        $skip_item = true;
    }
    if ($menu_level == 3 && $item->level < $menu_level) {
        $skip_item = true;
    }
    
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
    
    $item_class         = 'n-section-menu__item';
    $item_current_class = 'n-section-menu__item--active';
    $item_link_class    = 'n-section-menu__link';

    $nav_item = '';

    // Construct the class:
    $class   = $item_class;
    $current = false;
    if ($item->id == $active_id) {
        $class .= '  ' . $item_current_class;
        $current = true;
    }

    if (!empty($class)) {
        $class = ' class="' . trim($class) . '"';
    }

    $nav_item .= str_repeat("\t", $level) . '<li'.$class.'>';
    
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
            require JModuleHelper::getLayoutPath('mod_menu', 'default_'.$item->type);
            break;
        default:
            require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
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
<ul class="n-section-menu__list  u-fill-width">
    <?php echo $nav; ?>
</ul>
<?php endif; ?>
<?php endif; ?>