<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_image
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use \Michelf\Markdown;

$hx       = $params->get('header_tag', 'h2');
$images   = $params->get('images', array());
$n_images = is_object($images) ? count(get_object_vars($images)) : 0;

if ($n_images == 0) {
    return;
}

$wrapper = 'div';


$pathinfo = pathinfo($images->images0->image);
$svg_file = str_replace('.' . $pathinfo['extension'], '.svg', $images->images0->image);

$alias = str_replace('-logo', '', $pathinfo['filename']);
#echo '<pre>'; var_dump($alias); echo '</pre>'; return;

// Get a db connection.
$db = Factory::getDbo();

// Create a new query object.
$query = $db->getQuery(true);

// Select all records from the user profile table where key begins with "custom.".
// Order it by the ordering field.
$query->select($db->qn('id'));
$query->from($db->qn('#__menu'));
$query->where($db->qn('path') . ' = '. $db->q($alias));
$query->andWhere($db->qn('published') . ' = 1');

// Reset the query using our newly populated query object.
$db->setQuery($query);

// Load the results as a list of stdClass objects (see later for more options on retrieving data).
$result = $db->loadResult();
#echo '<pre>'; var_dump($result); echo '</pre>'; return;

if (!$result) {
    $alias = false;
}

$public_root_path = realpath($_SERVER['DOCUMENT_ROOT']) . DIRECTORY_SEPARATOR;
$image_path       = urldecode($public_root_path . $images->images0->image);
if (!file_exists($image_path)) {
    $height = '';
    $width = '';
} else {
    $image_info       = getimagesize($image_path);
    $image_real_ratio = $image_info[0] / $image_info[1];

    $height = 80;
    if ($image_info[0] > $image_info[1]) {
        $width = round($height * $image_real_ratio);
    } else {
        $width = round($height / $image_real_ratio);
    }
}

#$svg_path = str_replace('.' . $pathinfo['extension'], '.svg', Uri::base() . $images->images0->image);
#echo '<pre>'; var_dump(file_exists(JPATH_BASE . '/' . $svg_file)); echo '</pre>'; return;
?>
<<?php echo $wrapper; ?> class="mod_image">

    <<?php echo $alias ? 'a href="https://www.npeu.ox.ac.uk/' . $alias . '"' : 'span'; ?> class="c-badge  c-badge--page-brand">
        <?php if (file_exists(JPATH_BASE . '/' . $svg_file)) : ?>
        <img src="<?php echo Uri::base() . $svg_file; ?>" onerror="this.src='<?php echo Uri::base() . $images->images0->image; ?>'; this.onerror=null;" alt="<?php echo $module->title; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="u-fill-width">
        <?php else : ?>
        <img src="<?php echo Uri::base() . $images->images0->image; ?>" alt="<?php echo $module->title; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="u-fill-width">
        <?php endif; ?>
    </<?php echo $alias ? 'a' : 'span'; ?>>
</<?php echo $wrapper; ?>>
