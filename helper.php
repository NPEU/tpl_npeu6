<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  tpl_npeu6
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;



/**
 * Helper for tpl_npeu6
 */
class TplNPEU6Helper
{
        
    /**
	 * Global menu_item object
	 *
	 * @var    Menu Item
	 */
	public static $menu_item = null;
    
    /**
	 * Global project object
	 *
	 * @var    Project
	 */
	public static $project = null;
    
    /**
	 * Global template object
	 *
	 * @var    Template
	 */
	public static $template = null;
    
    /**
     * Gets the current menu item.
     *
     * @return object
     */
    public static function get_menu_item()
    {
        if (!self::$menu_item) {
            self::$menu_item = JFactory::getApplication()->getMenu()->getActive();
        }

		return self::$menu_item;
    }
    
    /**
     * Gets the current menu item's project.
     *
     * @return object
     */
    public static function get_project()
    {
        if (!self::$project) {
            $menu_item = self::get_menu_item();
            $top_item_id = $menu_item->tree[0];
            
            $db = JFactory::getDBO();
            
            $query = $db->getQuery(true);
            $query->select('*');
            $query->from('#__brandprojects');
            $query->where('landing_menu_item_id = ' . $top_item_id);
            $db->setQuery($query);
            self::$project = $db->loadObject();
        }

		return self::$project;
    }

    /**
     * Gets the current template.
     *
     * @return object
     */
    public static function get_template()
    {
        if (!self::$template) {
            $app = JFactory::getApplication();
            $template = $app->getTemplate(true);
            
            echo '<pre>'; var_dump($template); echo '</pre>'; exit;
            self::$template = $template;
        }

		return self::$template;
    }
}
