<?php
/**
 * @package     Joomla.Site
 * @subpackage  tpl_npeu6
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

require_once __DIR__ . '/vendor/autoload.php';

use \Mexitek\PHPColors\Color;

/**
 * Helper for tpl_npeu6
 */
class TplNPEU6Helper
{


    /**
	 * Global brand object
	 *
	 * @var    Brand
	 */
	public static $brand = null;

    /**
	 * Global menu_item object
	 *
	 * @var    Menu Item
	 */
	public static $menu_item = null;

    /**
	 * Global menu_id object
	 *
	 * @var    Menu Item
	 */
	public static $menu_id = null;

    /**
	 * Global template object
	 *
	 * @var    Template
	 */
	public static $template = null;

    /**
     * Checks if a category is empty or not.
     *
     * @return object
     */
    public static function check_category_empty($cat_id = false)
    {
        if (!$cat_id) {
            return;
        }

        $db = JFactory::getDBO();

        $query = $db->getQuery(true);
        $query->select('COUNT(*) as total_item');
        $query->from('#__content');
        $query->where('catid = ' . $cat_id);
        $db->setQuery($query);
        $result = (int) $db->loadResult();

		return (bool) $result;
    }


    /**
     * Cleans a title attribute to prevent HTML errors.
     *
     * @return object
     */
    public static function clean_title($element) {
        //return $element;
        $return = $element;
        preg_match('#\s*title="(.*?)"#', $element, $matches);
        if (empty($matches[0])) {
            // No title attribute present.
            return $return;
        } else {
            $title = strip_tags(str_replace(array('&gt;', '&lt;'), array('> ', '<'), $matches[1]));
            return str_replace($matches[1], $title, $return);
        }
    }

    /**
     * Gets the current menu item's brand.
     *
     * @return object
     */
    public static function get_brand_id_from_alias($brand_alias = false)
    {
        if (!is_string($brand_alias)) {
            return false;
        }

        $db = JFactory::getDBO();

        $query = $db->getQuery(true);
        $query->select('id');
        $query->from('#__brands');
        $query->where('alias = "' . $brand_alias . '"');
        $db->setQuery($query);
        $brand_id = $db->loadResult();
        return $brand_id;
    }

    /**
     * Gets a brand - defaults to getting current menu item brand.
     *
     * @return object
     */
    public static function get_brand($brand_id = false)
    {
        $get_page_brand = !$brand_id;

        // If we haven't got a brand id supplied, we're looking for the page brand.
        // If we have that, return it.
        if ($get_page_brand && self::$brand) {
            return self::$brand;
        }

        // So we haven't returned a page brand yet, are we looking for that?
        // If so get the brand id.
        if ($get_page_brand) {
            //$menu_item = self::get_menu_item();
            //$top_item_id = $menu_item->tree[0];

            $template = self::get_template();
            $brand_id = $template->params->get('brand_id', false);

            // We haven't got a page brand, so quit.
            if (!$brand_id) {
                return false;
            }
        }

        // We have a valid brand id now, so let's get the brand data:
        if ($brand_id) {
            $db = JFactory::getDBO();

            $query = $db->getQuery(true);
            $query->select('*');
            $query->from('#__brands');
            $query->where('id = ' . $brand_id);
            $db->setQuery($query);
            $brand = $db->loadObject();

            $brand->params = json_decode($brand->params);

            // Lets add some useful stuff not stored in the db:
            preg_match('/viewBox="(.+?)\s(.+?)\s(.+?)\s(.+?)"/', $brand->logo_svg, $matches);
            $brand->svg_width        = $matches[3];
            $brand->svg_height       = $matches[4];
            $brand->svg_aspect_ratio = $matches[3] / $matches[4];
            $brand->svg_width_at_height_80  = round(80 * $brand->svg_aspect_ratio);
            $brand->svg_width_at_height_100 = round(100 * $brand->svg_aspect_ratio);


            // Include the colour values:
            $primary_color = new Color($brand->primary_colour);

            $brand->primary_colour_is_light = $primary_color->isLight();
            $brand->primary_colour_hsl      = $primary_color->getHsl();
            $brand->primary_colour_hsl['H'] = round($brand->primary_colour_hsl['H']);
            $brand->primary_colour_hsl['S'] = round($brand->primary_colour_hsl['S'] * 100) . '%';
            $brand->primary_colour_hsl['L'] = round($brand->primary_colour_hsl['L'] * 100) . '%';

            $secondary_color = new Color($brand->secondary_colour);

            $brand->secondary_colour_is_light = $secondary_color->isLight();
            $brand->secondary_colour_hsl      = $secondary_color->getHsl();
            $brand->secondary_colour_hsl['H'] = round($brand->secondary_colour_hsl['H']);
            $brand->secondary_colour_hsl['S'] = round($brand->secondary_colour_hsl['S'] * 100) . '%';
            $brand->secondary_colour_hsl['L'] = round($brand->secondary_colour_hsl['L'] * 100) . '%';

            if ($get_page_brand) {
                self::$brand = $brand;
            }

            return $brand;
        }

		return false;
    }

    /**
     * Gets the current menu id since only the type (name) is available in menu_item.
     *
     * @return object
     */
    public static function get_menu_id()
    {
        if (self::$menu_id) {
            return self::$menu_id;
        }

        if (!self::$menu_item) {
            self::get_menu_item();
        }

        $db = JFactory::getDBO();

        $query = $db->getQuery(true);
        $query->select('id');
        $query->from('#__menu_types');
        $query->where('menutype = ' . $db->quote(self::$menu_item->menutype));
        $db->setQuery($query);

        self::$menu_id = $db->loadResult();

		return self::$menu_id;
    }

    /**
     * Gets the current menu item.
     *
     * @return object
     */
    public static function get_menu_item()
    {
        if (!self::$menu_item) {
            $menu_item = JFactory::getApplication()->getMenu()->getActive();

            if (is_null($menu_item)) {

                $menu_item = JFactory::getApplication()->getMenu()->getItem(120);
            }
            self::$menu_item = $menu_item;
        }
		return self::$menu_item;
    }

    /**
     * Gets messages queued for the current page view.
     *
     * @return object
     */
    public static function get_messages()
    {
        	$doc = JFactory::getDocument();
            if (isset($doc->mesages_renderered) && $doc->mesages_renderered == true) {
                return '';
            }

            $messages = new JDocumentRendererMessage($doc);
            $doc->mesages_renderered = true;
            return $messages->render(NULL);
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

    /**
     * Remove unwanted scripts added by Joomla.
     *
     * @return object
     */
    public static function remove_joomla_scripts($scripts, &$doc)
    {
        $patterns = array(
            '#^/media/jui/js#',
            '#^/media/system/js#'
        );

        foreach ($scripts as $script => $data) {
            foreach ($patterns as $pattern) {
                if (preg_match($pattern, $script)) {
                    $doc->joomla_scripts[$script] = $data;
                    unset($scripts[$script]);
                }
            }
        }
		return $scripts;
    }

    /**
     * Remove unwanted stylesheets added by Joomla.
     *
     * @return object
     */
    public static function remove_joomla_stylesheets($stylesheets, &$doc)
    {
        $patterns = array(
            '#^/media/jui/css#',
            '#^/media/system/css#'
        );

        foreach ($stylesheets as $stylesheet => $data) {
            foreach ($patterns as $pattern) {
                if (preg_match($pattern, $stylesheet)) {
                    $doc->joomla_stylesheets[$stylesheet] = $data;
                    unset($stylesheets[$stylesheet]);
                }
            }
        }
		return $stylesheets;
    }

    /**
     * Returns a tab string for indenting
     *
     * @param string $text
     * @return string
     * @access public
     */
    public static function tab($level)
    {
        if (!is_int($level)) {
            trigger_error('Function \'tab\' expects argument 1 to be an integer', E_USER_ERROR);
            return false;
        }
        $level = $level + 5;
        return str_repeat(" ", ($level) * 4);
    }

    /**
     * Creates an HTML-friendly string for use in id's
     *
     * @param string $text
     * @return string
     * @access public
     */
    public static function html_id($text)
    {
        if (!is_string($text)) {
            trigger_error('Function \'html_id\' expects argument 1 to be an string', E_USER_ERROR);
            return false;
        }
        $return = strtolower(trim(trim(preg_replace('/\s+/', '-', self::strip_punctuation($text))), '-'));
        return $return;
    }

    /**
     * Adds a timestamp to a filename
     *
     * @param string $filename Expects root-relative URL
     * @param string $root_path
     * @return string
     * @access public
     */
    public static function stamp_filename($filename, $root_path = false)
    {
        if (!$root_path) {
            $root_path = $_SERVER['DOCUMENT_ROOT'];
        }

        // Don't stamp filenames of 3rd Party or System files:
        if (strpos($filename, '/templates/npeu6/') !== 0) {
            return $filename;
        }

        $filepath = $root_path . DIRECTORY_SEPARATOR . trim(str_replace('/', DIRECTORY_SEPARATOR, $filename), DIRECTORY_SEPARATOR);
        $stamp = filemtime($filepath);
        $return = preg_replace('/(.*?)((\.min)?\..+?)$/', '$1.' . $stamp . '$2', $filename);
        return $return;
    }

    /**
     * Gets the current template.
     *
     * @return object
     */
    public static function strip_punctuation($text)
    {
        if (!is_string($text)) {
            trigger_error('Function \'strip_punctuation\' expects argument 1 to be an string', E_USER_ERROR);
            return false;
        }
        $text = html_entity_decode($text, ENT_QUOTES);

        $urlbrackets = '\[\]\(\)';
        $urlspacebefore = ':;\'_\*%@&?!' . $urlbrackets;
        $urlspaceafter = '\.,:;\'\-_\*@&\/\\\\\?!#' . $urlbrackets;
        $urlall = '\.,:;\'\-_\*%@&\/\\\\\?!#' . $urlbrackets;

        $specialquotes = '\'"\*<>';

        $fullstop = '\x{002E}\x{FE52}\x{FF0E}';
        $comma = '\x{002C}\x{FE50}\x{FF0C}';
        $arabsep = '\x{066B}\x{066C}';
        $numseparators = $fullstop . $comma . $arabsep;

        $numbersign = '\x{0023}\x{FE5F}\x{FF03}';
        $percent = '\x{066A}\x{0025}\x{066A}\x{FE6A}\x{FF05}\x{2030}\x{2031}';
        $prime = '\x{2032}\x{2033}\x{2034}\x{2057}';
        $nummodifiers = $numbersign . $percent . $prime;
        $return = preg_replace(
        array(
            // Remove separator, control, formatting, surrogate,
            // open/close quotes.
            '/[\p{Z}\p{Cc}\p{Cf}\p{Cs}\p{Pi}\p{Pf}]/u',
            // Remove other punctuation except special cases
            '/\p{Po}(?<![' . $specialquotes .
            $numseparators . $urlall . $nummodifiers . '])/u',
            // Remove non-URL open/close brackets, except URL brackets.
            '/[\p{Ps}\p{Pe}](?<![' . $urlbrackets . '])/u',
            // Remove special quotes, dashes, connectors, number
            // separators, and URL characters followed by a space
            '/[' . $specialquotes . $numseparators . $urlspaceafter .
            '\p{Pd}\p{Pc}]+((?= )|$)/u',
            // Remove special quotes, connectors, and URL characters
            // preceded by a space
            '/((?<= )|^)[' . $specialquotes . $urlspacebefore . '\p{Pc}]+/u',
            // Remove dashes preceded by a space, but not followed by a number
            '/((?<= )|^)\p{Pd}+(?![\p{N}\p{Sc}])/u',
            // Remove consecutive spaces
            '/ +/',
            ), ' ', $text);
        $return = str_replace('/', '_', $return);
        return str_replace("'", '', $return);
    }

    /**
     * Tweaks markdown
     *
     * @return string
     */
    public static function tweak_markdown_output($html, $options = array())
    {
        if (!empty($options['trim_paragraph'])) {
            $html = preg_replace(array('/^<p>/', '/<\/p>$/'), '', $html);
        }

        if (!empty($options['add_link_spans'])) {
            $html = preg_replace('/(<a[^>]+>)/', '$1<span>', $html);
            $html = preg_replace('/<\/a>/', '</span></a>', $html);
        }

        if (!empty($options['split_to_list']) && is_string($options['split_to_list'])) {
            $s = $options['split_to_list'];
            $a = explode($s, $html);
            $html = '<span role="listitem" class="l-box">' . implode('</span> <span class="l-box__separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span> <span role="listitem" class="l-box">', $a) . '</span>';
        }

        return $html;
    }
}
