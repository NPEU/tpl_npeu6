<?php
/**
 * @package     Joomla.Site
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
    public static function get_brand()
    {
        if (!self::$brand) {
            //$menu_item = self::get_menu_item();
            //$top_item_id = $menu_item->tree[0];

            $template = self::get_template();
            $brand_id = $template->params->get('brand_id', false);

            if (!$brand_id) {
                return false;
            }

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
            self::$menu_item = JFactory::getApplication()->getMenu()->getActive();
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
        $return = strtolower(trim(preg_replace('/\s+/', '-', self::strip_punctuation($text))));
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
        #echo '<pre>'; var_dump($filename); echo '</pre>'; #exit;
        if (strpos($filename, '/templates/npeu6/') !== 0) {
            return $filename;
        }
        
        $stamp = filemtime($root_path . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $filename));
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

        return $html;
    }
}
