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
	 * Global brand object
	 *
	 * @var    Brand
	 */
	public static $brand = null;

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
     * Gets the current menu item's brand.
     *
     * @return object
     */
    public static function get_brand()
    {
        if (!self::$brand) {
            //$menu_item = self::get_menu_item();
            //$top_item_id = $menu_item->tree[0];
            
            $template = self::get_template();
            $brand_id = $template->params->get('brand_id');

            $db = JFactory::getDBO();

            $query = $db->getQuery(true);
            $query->select('*');
            $query->from('#__brands');
            $query->where('id = ' . $brand_id);
            $db->setQuery($query);
            self::$brand = $db->loadObject();
        }

		return self::$brand;
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

            self::$template = $template;
        }

		return self::$template;
    }
}
