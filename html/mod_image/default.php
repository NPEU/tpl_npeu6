<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_image
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

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
    $container_classes .= ' u-image-cover  u-image-cover--min-30  js-image-cover';
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
?>
<?php if($n_images > 1) : ?>
<!-- @TOTO -->
<?php else: /* @TODO - need to think about credit lines. */?>
<<?php echo $wrapper; echo $container_classes; ?>>
    <?php if (isset($images->images0->url)): ?><a href="<?php echo $images->images0->url; ?>"<?php if (strpos($images->images0->url, $_SERVER['SERVER_NAME']) === false): ?> rel="external noopener noreferrer"<?php endif?><?php else: ?><div<?php endif; echo $inner_classes; ?>>    
        <img<?php echo $image_classes; ?> src="<?php echo JURI::base() . $images->images0->image; ?>" width="600" alt="<?php echo $images->images0->alt; ?>">
    <?php if (isset($images->images0->url)): ?></a><?php else: ?></div><?php endif; ?>
    <?php if ($has_details): ?>
    <figcaption class="c-longform-content  c-user-content  c-panel  c-panel--very-dark" style="
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
