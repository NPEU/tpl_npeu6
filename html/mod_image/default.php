<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_image
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Uri\Uri;

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use \Michelf\Markdown;

$hx       = $params->get('header_tag', 'h2');
$images   = $params->get('images', array());
$n_images = is_object($images) ? count(get_object_vars($images)) : 0;
$cover    = $params->get('cover', 1);

if ($n_images == 0) {
    return;
}

$wrapper = 'div';
$has_details = false;
if (!empty($images->images0->caption) || !empty($images->images0->credit)) {
    $has_details = true;
    $wrapper = 'figure';
}

$container_classes = 'mod_image';
$inner_classes = 'u-image-natural';
$image_classes = 'u-image-natural__image';

if ($cover == 1) {
    $container_classes .= ' u-image-cover  u-image-cover--min-50  js-image-cover';
    $inner_classes = 'u-image-cover__inner';
    $image_classes = 'u-image-cover__image';
}

if (!empty($container_classes)) {
    $container_classes = ' class="' . $container_classes . '"';
}

if (!empty($inner_classes)) {
    $inner_classes = ' class="' . $inner_classes . '"';
}

if (!empty($image_classes)) {
    $image_classes = ' class="' . $image_classes . '"';
}


/*
Module styles should handle the titles, or they can end up appearing twice.
<?php if ($module->showtitle): ?>
<<?php echo $hx; ?>><?php echo $module->title; ?></<?php echo $hx; ?>>
<?php endif; ?>
*/

// Image size:
// Construct the protocol (http|https):
$s                 = empty($_SERVER['SERVER_PORT']) ? '' : (($_SERVER['SERVER_PORT'] == '443') ? 's' : '');
$protocol          = preg_replace('#/.*#',  $s, strtolower($_SERVER['SERVER_PROTOCOL']));

// Construct the domain url:
$domain            = $protocol.'://'.$_SERVER['SERVER_NAME'];

// Construct the public root path: (note: this is the SERVER path, not a URL)
$public_root_path  = realpath($_SERVER['DOCUMENT_ROOT']) . DIRECTORY_SEPARATOR;

$image_path = $public_root_path . $images->images0->image;

$image_info = getimagesize($image_path);
$ratio = $image_info[0] / $image_info[1];

$fallback_width  = 600;
$fallback_height = round($fallback_width / $ratio, 2);

$image_url = false;
$image_url_external = false;
if (isset($images->images0->url)) {
    $image_url = $images->images0->url;
    if (substr($image_url, 0, 1) != '/' && strpos($image_url, $_SERVER['SERVER_NAME']) === false) {
        $image_url_external = true;
    }
}

?>
<?php if($n_images > 1) : ?>
<!-- @TOTO -->
<?php else: /* @TODO - need to think about credit lines. */?>
<<?php echo $wrapper; echo $container_classes; ?>>
    <?php if ($image_url): ?><a href="<?php echo $images->images0->url; ?>"<?php if ($image_url_external): ?> rel="external noopener noreferrer"<?php endif?><?php else: ?><div<?php endif; echo $inner_classes; ?>>
        <img<?php echo $image_classes; ?> src="<?php echo Uri::base() . $images->images0->image; ?>" width="<?php echo $fallback_width; ?>" height="<?php echo $fallback_height; ?>" alt="<?php echo $images->images0->alt; ?>">
    <?php if ($image_url): ?></a><?php else: ?></div><?php endif; ?>
    <?php if ($has_details): ?>
    <figcaption class="c-longform-content  c-user-content  c-panel  c-panel--very-dark  mod_image__details" style="
        position: absolute;
        top: 0;
        background: rgba(0,0,0,0.5);
        padding: 0.5em;
    ">
        <details style="
            padding: 0;
            margin: 0;
            border: 0;
        ">
            <summary style="
                padding: 0;
                margin: 0;
                border: 0;
            ">Info</summary>
            <?php if (!empty($images->images0->caption)) : ?>
            <?php echo Markdown::defaultTransform($images->images0->caption); ?>
            <?php endif; ?>
            <?php if (!empty($images->images0->credit)) : ?>
            <?php echo Markdown::defaultTransform($images->images0->credit); ?>
            <?php endif; ?>
        </details>
    </figcaption>
    <?php endif; ?>
</<?php echo $wrapper; ?>>
<?php endif; ?>
