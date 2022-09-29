<?php
if (!empty($_SERVER['JTV2'])) {
    include(str_replace('.php', '.v2.php', __FILE__));
    return;
}
?><?php
// No direct access
defined('_JEXEC') or die;

$doc         = JFactory::getDocument();
$app         = JFactory::getApplication();
$active_menu = $app->getMenu()->getActive();

// Blogs show child pages whilst still being the same menu item, so a child page is still treated as
// the same page, so teh CURRENT logic doesn't work and you end up with an unexpected navbar link,
// so check for this case:
//$is_blog = ($active_menu->query['view'] == 'category' && $active_menu->query['layout'] == 'blog');

$uri   = JUri::getInstance();
$menu_route = isset($active_menu->route) ? trim($active_menu->route, '/') : '';
$uri_route  = trim($uri->getPath(), '/');
$page_is_subroute = ($menu_route == $uri_route) ? false : true;


// Include the template helper:
JLoader::register('TplNPEU6Helper', dirname(dirname(__DIR__)) . '/helper.php');

$brand = TplNPEU6Helper::get_brand();

if (!isset($is_sitemap)) {
    $is_sitemap = false;

    if (isset($active_menu->alias) && $active_menu->alias == 'sitemap2' || $active_menu->alias == 'sitemap') {
        $is_sitemap = true;
    }

}
$start_level = (int) $params->get('startLevel');
?>
<?php if(count($list) > 0): ?>
<?php
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
//$level = 1;

// First pass to remove items we want to skip.
// Needs to be done this way as otherwise there's no way (I think) to determine if an item really
// has children or not without 'lookahead' loops.
$new_list = array();
foreach ($list as $i => &$item) {
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
    $next_item = false;
    $next_level = 1;

    if (isset($new_list[$i + 1])) {
        $next_item = $new_list[$i + 1];
        $next_level = (int) $next_item->level;
    }

    $params = Joomla\Registry\Registry::getInstance('');
    $params->loadObject($item->params);

    if (isset($params->get('data')->aliasoptions)) {
        $ref_id = $params->get('data')->aliasoptions;
    } else {
        $ref_id = $item->id;
    }


    $item_class         = 'nav-bar__item  dropdown-container';
    $item_current_class = 'nav-bar__item--current';
    $item_link_class    = 'nav-bar__link';

    $tab_multiplier = 1;
    if ($level == (1 + $start_level)) {
        $tab_multiplier = 2;

        $item_class         = 'subnav__item';
        $item_current_class = 'subnav__item--current';
        $item_link_class    = 'subnav__link';
    }

    $nav_item = '';

    // Construct the class:
    $class   = $item_class;
    $current = false;
    if ($active_id == $ref_id && !$page_is_subroute) {
        $class .= '  ' . $item_current_class;
        $current = true;
    }

    if (!empty($class)) {
        $class = ' class="' . trim($class) . '"';
    }

    $nav_item .= "\n" . TplNPEU6Helper::tab($level * $tab_multiplier + 1) . '<li'.$class.'>' . "\n" . TplNPEU6Helper::tab($level * $tab_multiplier + 2);

    $item->anchor_css = $item_link_class;

    // Add spans for styling purposes:
    // Note that if more than one of the same menu is used on a page, (e.g. Navbar + Section Menu)
    // then, as Joomla caches the menu, the tags are added per-menu, (e.g. twice) so using
    // removing them to prevent this.
    $title = str_replace(array('&lt;span&gt;', '&lt;/span&gt;'), '', $item->title);
    $item->title = '<span>' . $title . '</span>';
    ob_start();
    // Render the menu item.
    switch ($item->type) {
        case 'separator':
        case 'url':
        case 'component':
            require JModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
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


/*
<div class="dropdown dropdown--only-wide js-dropdown">

<button id="clinicians-sub-menu" class="dropdown__button  t-neoclear" data-js="dropdown__button" hidden="" aria-label="Clinicians sub-menu" aria-expanded="false"><svg display="none" focusable="false" class="icon  icon--is-closed"><use xlink:href="#icon-chevron-down"></use></svg><svg display="none" focusable="false" class="icon  icon--is-open"><use xlink:href="#icon-chevron-up"></use></svg></button>

                                        <div class="dropdown__area" id="clinicians-sub-menu--target">
*/
    $nav_item .= str_replace(' >', '>', $output);

    // The next item is deeper.
    if ($next_item && $next_level > $level) {
        $nav_item .= "\n" . TplNPEU6Helper::tab($level + 2) . '<div class="dropdown  dropdown--only-wide" data-js="dropdown">';
        $nav_item .= "\n" . TplNPEU6Helper::tab($level + 3) . '<button id="' . $item->alias . '-sub-menu" class="dropdown__control  t-' . $brand->alias . '" data-js="dropdown__control" hidden="" aria-label="' . $item->title . ' sub-menu" aria-expanded="false"><svg display="none" focusable="false" class="icon  icon--is-closed"><use xlink:href="#icon-chevron-down"></use></svg><svg display="none" focusable="false" class="icon  icon--is-open"><use xlink:href="#icon-chevron-up"></use></svg></button>';
        $nav_item .= "\n" . TplNPEU6Helper::tab($level + 3) . '<div class="dropdown__area" id="' . $item->alias . '-sub-menu--target">';
        $nav_item .= "\n" . TplNPEU6Helper::tab($level + 4) . '<ul class="subnav__items  subnav__items--stacked  t-' . $brand->alias . '">';
    }
    // The next item is shallower.
    elseif ($next_item && $next_level < $level) {
        $nav_item .= "\n" . TplNPEU6Helper::tab($level + 4) . '</li>';
        $nav_item .= "\n" . TplNPEU6Helper::tab($level + 3) . '</ul>';
        $nav_item .= "\n" . TplNPEU6Helper::tab($level + 2) . '</div>';
        $nav_item .= "\n" . TplNPEU6Helper::tab($level + 1) . '</div>';
        $nav_item .= "\n" . TplNPEU6Helper::tab($level) . '</li>';
    }
    // The next item is on the same level.
    else {
        $nav_item .= "\n" . TplNPEU6Helper::tab($level * $tab_multiplier + 1) . '</li>';
    }
    $nav .= $nav_item;
}
?>
<?php if(!empty($nav)): ?>
<ul class="nav-bar__items  mod_menu">
    <?php echo $nav; ?>

<?php echo TplNPEU6Helper::tab(2); ?></ul>
<?php endif; ?>
<?php endif; ?>