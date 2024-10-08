<?php
/**
 * @package     Joomla.Site
 * @subpackage  tpl_npeu6
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

namespace NPEU\Template\Npeu6\Site\Helper;
#echo '<pre>'; var_dump($_SERVER); echo '</pre>'; exit;
defined('_JEXEC') or die;

use Joomla\CMS\Document\Renderer\Html\MessageRenderer;
use Joomla\CMS\Factory;

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use \Mexitek\PHPColors\Color;

/**
 * Helper for tpl_npeu6
 */
class Npeu6Helper
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

    public static function resolve_image_data($datastring)
    {
        $json = json_decode($datastring, true);
        if (is_null($json)) {
            return ['imagefile' => $datastring];
        }
        return $json;
    }

    public static function resolve_image_path($path = false)
    {
        if (!empty($path)) {
            $path = preg_replace('/#joomlaImage:[^"]+/', '', $path);
            return $path;

        }
        return '';
    }


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

        $db = Factory::getDBO();

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
            $title = strip_tags(str_replace(['&gt;', '&lt;'], ['> ', '<'], $matches[1]));
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

        $db = Factory::getDBO();

        $query = $db->getQuery(true);
        $query->select('id');
        $query->from('#__brands');
        $query->where('alias = "' . $brand_alias . '"');
        $db->setQuery($query);
        $brand_id = $db->loadResult();
        return $brand_id;
    }

    /**
     * Adjusts HSL lightness
     *
     * @return object
     */
    public static function adjust_lightness($value, $adjustment)
    {
        $t = 0;
        $v = (int) $value;
        $r = 100 - $v;

        if ($adjustment > 0) {
            $t = round($v + ($r * $adjustment));
        } else {
            $t = round($v - ($v * -$adjustment));
        }

        return $t . '%';
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
            $db = Factory::getDBO();
            #echo "<pre>"; var_dump($brand_id); echo "</pre>"; #exit;
            $query = $db->getQuery(true);
            $query->select('*');
            $query->from('#__brands');
            $query->where('id = ' . $brand_id);
            $db->setQuery($query);
            #echo "<pre>"; var_dump((string) $query); echo "</pre>"; #exit;
            $brand = $db->loadObject();

            $brand->params = json_decode($brand->params);

            // Lets add some useful stuff not stored in the db:
            preg_match('/viewBox="(.+?)\s(.+?)\s(.+?)\s(.+?)"/', $brand->logo_svg, $matches);
            $brand->svg_width        = $matches[3];
            $brand->svg_height       = $matches[4];
            $brand->svg_aspect_ratio = $matches[3] / $matches[4];
            $brand->svg_width_at_height_80  = round(80 * $brand->svg_aspect_ratio);
            $brand->svg_width_at_height_100 = round(100 * $brand->svg_aspect_ratio);

            // Force a valid colour so Color doesn't quit everything.
            $colour_1 = $brand->primary_colour;
            if (empty($colour_1)) {
                $colour_1 = '#000000';
            }

            $colour_2 = $brand->secondary_colour;
            if (empty($colour_2)) {
                $colour_2 = '#000000';
            }

            // Include the colour values:

            $very_light_adjust =  0.92;
            $light_adjust      =  0.7;
            $very_light_adjust =  0.92;
            $dark_adjust       = -0.23;
            $very_dark_adjust  = -0.36;

            $primary_color = new Color($colour_1);

            $brand->primary_colour_is_light     = $primary_color->isLight();
            $brand->primary_colour_hsl          = $primary_color->getHsl();
            $brand->primary_colour_hsl['H']     = round($brand->primary_colour_hsl['H']);
            $brand->primary_colour_hsl['S']     = round($brand->primary_colour_hsl['S'] * 100) . '%';
            $brand->primary_colour_hsl['L_int'] = round($brand->primary_colour_hsl['L'] * 100);
            $brand->primary_colour_hsl['L']     = $brand->primary_colour_hsl['L_int'] . '%';

            $brand->primary_colour_l = [];
            $brand->primary_colour_l['very-light'] = self::adjust_lightness($brand->primary_colour_hsl['L_int'], $very_light_adjust);
            $brand->primary_colour_l['light']      = self::adjust_lightness($brand->primary_colour_hsl['L_int'], $light_adjust);
            $brand->primary_colour_l['dark']       = self::adjust_lightness($brand->primary_colour_hsl['L_int'], $dark_adjust);
            $brand->primary_colour_l['very-dark']  = self::adjust_lightness($brand->primary_colour_hsl['L_int'], $very_dark_adjust);

            $primary_colour_hsl_very_light = ['H' => (int) $brand->primary_colour_hsl['H'], 'S' => ((int) $brand->primary_colour_hsl['S']) / 100, 'L' => ((int) $brand->primary_colour_l['very-light']) / 100];
            $primary_colour_hsl_light      = ['H' => (int) $brand->primary_colour_hsl['H'], 'S' => ((int) $brand->primary_colour_hsl['S']) / 100, 'L' => ((int) $brand->primary_colour_l['light']) / 100];
            $primary_colour_hsl_dark       = ['H' => (int) $brand->primary_colour_hsl['H'], 'S' => ((int) $brand->primary_colour_hsl['S']) / 100, 'L' => ((int) $brand->primary_colour_l['dark']) / 100];
            $primary_colour_hsl_very_dark  = ['H' => (int) $brand->primary_colour_hsl['H'], 'S' => ((int) $brand->primary_colour_hsl['S']) / 100, 'L' => ((int) $brand->primary_colour_l['very-dark']) / 100];

            $brand->primary_colour__very_light = '#' . Color::hslToHex($primary_colour_hsl_very_light);
            $brand->primary_colour__light      = '#' . Color::hslToHex($primary_colour_hsl_light);
            $brand->primary_colour__dark       = '#' . Color::hslToHex($primary_colour_hsl_dark);
            $brand->primary_colour__very_dark  = '#' . Color::hslToHex($primary_colour_hsl_very_dark);


            $secondary_color = new Color($colour_2);

            $brand->secondary_colour_is_light     = $secondary_color->isLight();
            $brand->secondary_colour_hsl          = $secondary_color->getHsl();
            $brand->secondary_colour_hsl['H']     = round($brand->secondary_colour_hsl['H']);
            $brand->secondary_colour_hsl['S']     = round($brand->secondary_colour_hsl['S'] * 100) . '%';
            $brand->secondary_colour_hsl['L_int'] = round($brand->secondary_colour_hsl['L'] * 100);
            $brand->secondary_colour_hsl['L']     = $brand->secondary_colour_hsl['L_int'] . '%';

            $brand->secondary_colour_l = [];
            $brand->secondary_colour_l['very-light'] = self::adjust_lightness($brand->secondary_colour_hsl['L_int'], $very_light_adjust);
            $brand->secondary_colour_l['light']      = self::adjust_lightness($brand->secondary_colour_hsl['L_int'], $light_adjust);
            $brand->secondary_colour_l['dark']       = self::adjust_lightness($brand->secondary_colour_hsl['L_int'], $dark_adjust);
            $brand->secondary_colour_l['very-dark']  = self::adjust_lightness($brand->secondary_colour_hsl['L_int'], $very_dark_adjust);

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

        $db = Factory::getDBO();

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
            $menu_item = Factory::getApplication()->getMenu()->getActive();

            if (is_null($menu_item)) {

                $menu_item = Factory::getApplication()->getMenu()->getItem(120);
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
            $doc = Factory::getDocument();
            if (isset($doc->mesages_renderered) && $doc->mesages_renderered == true) {
                return '';
            }

            $messages = new MessageRenderer($doc);
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
            $app = Factory::getApplication();
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
        $patterns = [
            '#^/media/jui/js#',
            '#^/media/system/js#'
        ];

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
        $patterns = [
            '#^/media/jui/css#',
            '#^/media/system/css#'
        ];

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
     * Returns a array of info for svgs similar to getimagesize()
     *
     * @param string $img_src
     * @param string $fallback_width
     * @return string
     * @access public
     */
    public static function svg_info($img_src, $fallback_width = 180) {

        $path = JPATH_ROOT . $img_src;
        if (file_exists($path)) {
            $svg = file_get_contents($path);
            preg_match('/viewBox="([^"]+)"/', $svg, $matches);
            #echo '<pre>'; var_dump($matches); echo '</pre>';
            $viewbox = isset($matches[1]) ? $matches[1] : '';

            $values = explode(' ', $viewbox);
            $w = $values[2];
            $h = $values[3];
            $ratio = ($w < $h) ? ($w / $h) : ($h / $w);
            $fallback_height = round($fallback_width * $ratio);

            $values[2] = $fallback_width;
            $values[3] = $fallback_height;

            preg_match('/<title[^>]+>([^<]+)<\/title>/', $svg, $matches_2);
            #echo '<pre>'; var_dump($matches_2); echo '</pre>';
            $svg_title = $matches_2[1];

            $return = [
                0 => $fallback_width,
                1 => $fallback_height,
                'viewbox'    => 'viewBox="' . implode(' ', $values) . '"',
                'dimensions' => 'width="' . $fallback_width . '" height="' . $fallback_height . '"',
                'title'      => $svg_title
            ];

            return $return;
        }
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
            [
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
            ],
            ' ',
            $text
        );
        $return = str_replace('/', '_', $return);
        return str_replace("'", '', $return);
    }

    /**
     * Tweaks markdown
     *
     * @return string
     */
    public static function tweak_markdown_output($html, $options = [])
    {
        //if (!empty($options['split_to_list']) && is_string($options['split_to_list'])) {
        //    $s = $options['split_to_list'];
        //    $a = explode($s, $html);
        //    $html = '<span role="list" class="l-layout__inner">' . "\n" . '<span role="listitem" class="l-box">' . "\n" . implode("\n" . '</span> ' . "\n\n" . '<span class="l-box__separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>' . "\n\n" . '<span role="listitem" class="l-box">' . "\n", $a) . "\n" . '</span>';
        //}

        if (!empty($options['split_to_list']) && is_string($options['split_to_list'])) {

            $html = str_replace(
                '<p>',
                '<p>' . "\n" . '<span role="list" class="l-layout__inner">' . "\n" . '<span role="listitem" class="l-box">'. "\n",
                $html
            );

            $html = str_replace(
                $options['split_to_list'],
                "\n" .
                '</span> ' . "\n\n" .
                '<span class="l-box__separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>' . "\n\n" .
                '<span role="listitem" class="l-box">' . "\n",
                $html
            );

            $html = str_replace('</p>', "\n" . '</span>' . "\n" . '</span>' . "\n" . '</p>', $html);

        }

        if (!empty($options['add_link_spans'])) {
            $html = preg_replace('/(<a[^>]+>)/', '$1<span>', $html);
            $html = preg_replace('/<\/a>/', '</span></a>', $html);
        }

        if (!empty($options['p_classes'])) {
            $html = str_replace('<p>', '<p class="' . $options['p_classes'] . '">', $html);
        }

        if (!empty($options['trim_paragraph'])) {
            $html = preg_replace(['/^<p[^>]*>/', '/<\/p>$/'], '', $html);
        }
        return $html;
    }

    /**
     * Adjust article HMTL
     *
     * @return string
     */
    public static function adjust_article_html($html)
    {
        // Resolve data-true-url
        // Note what this does is get the URL of an <a> inside an element with an id matching the
        // # of a URL and replaces the orginal URL. This is to allow for the same file link /
        // document to appear in multple places on the site whilst still maintaining a "single-
        // source-of-truth" where by the acutal file is ony placed on a sngle page and other
        // instances of it exists as #links to a container id.
        // So an original page might have:
        //
        // <a id="guidance-sheet-1 href="/assets/downloads/neogastric/neoGASTRIC_Guidance_Sheet_1_Trial_one-page_summary_v10_02062023.pdf">neoGASTRIC Guidance Sheet 1 Trial one-page summary v1.0 02062023</a>
        //
        // and a secondary instance might have:
        //
        // <a data-true-url="" href="https://dev.npeu.ox.ac.uk/neogastric/health-professionals/guidance-sheets#guidance-sheet-1">Guidance Sheet 1 Trial one-page summary</a>
        //
        // Which will be resolved to:
        //
        // <a href="/assets/downloads/neogastric/neoGASTRIC_Guidance_Sheet_1_Trial_one-page_summary_v10_02062023.pdf">Guidance Sheet 1 Trial one-page summary</a>
        preg_match_all('/<a data-true-url.+?href="([^#]+)#([^"]+)">([^<]+)<\/a>/', $html, $matches, PREG_SET_ORDER);

        $config = [];
        foreach ($matches as $match) {
            $url = $match[1];

            if (!array_key_exists($url, $config)) {
                $config[$url] = [];
            }

            $config_entry = [
                'id' => $match[2],
                'text' => $match[3]
            ];

            $config[$url][] = $config_entry;
        }

        foreach ($config as $url => $config_entries) {
            if (strpos($url, 'https://') !== 0) {
                $full_url = 'https://' . $_SERVER['SERVER_NAME'] . $url;
            }

            if (empty($full_url)) {
                continue;
            }

            $contents = file_get_contents($full_url);

            if (!empty($contents)) {
                foreach ($config_entries as $config_entry) {
                    $regex = '/<a[^>]*?id="' . $config_entry['id'] . '"[^>]*?>(.*?)<\/a>/s';

                    if (preg_match($regex, $contents, $ms)) {
                        preg_match('/href="([^"]+)"/', $ms[0], $ms2);
                        $old_url = '"' . $url . '#' . $config_entry['id'] . '"';
                        $old_text = $config_entry['text'];
                        $new_url = '"' . $ms2[1] . '"';
                        $new_text = trim(strip_tags($ms[1]));

                        $html = str_replace([$old_url , $old_text], [$new_url, $new_text], $html);
                    }
                }
            }
        }

        return $html;
    }
}
