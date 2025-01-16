<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once dirname(__DIR__) . '/vendor/autoload.php';

use \Michelf\Markdown;
use NPEU\Template\Npeu6\Site\Helper\Npeu6Helper as TplNPEU6Helper;

$public_root_path = realpath($_SERVER['DOCUMENT_ROOT']) . DIRECTORY_SEPARATOR;

/*
    Expects a $card_data array with the following keys:
    theme_classes
    full_link
    link
    hx
    title
    link
    link_text
    header_extra
    header_image
    header_image_alt
    header_image_width
    header_image_ratio
    header_span_attr
    date_format
    publish_date
    state
    footer_extra
    footer_image
    footer_image_width
    footer_image_ratio
    footer_image_padded

*/

if (!isset($wrapper_classes) || !is_array($wrapper_classes)) {
    $wrapper_classes = [];
}

if (isset($card_data['state']) && $card_data['state'] != 1) {
    $wrapper_classes[] = 'c-card--unpublished';
}

if (!empty($card_data['wrapper_classes'])) {
    $wrapper_classes = array_merge($wrapper_classes, $card_data['wrapper_classes']);
}

if (empty($card_data['hx'])) {
    $card_data['hx'] = '3';
}

$image_data = false;
if (!empty($card_data['header_image'])) {
    $image_data = TplNPEU6Helper::resolve_image_data($card_data['header_image']);
}

if (!empty($image_data)) {
    $header_image_path = TplNPEU6Helper::resolve_image_path($image_data['imagefile']);
    if (empty($header_image_path)) {
        $card_data['header_image'] = false;
    } else {
        $card_data['header_image'] = $header_image_path;
        $header_image_path = urldecode($public_root_path . $header_image_path);

        if (!file_exists($header_image_path)) {
            $card_data['header_image'] = false;
        } else {
            // Get image size is a PATH not a URL so any spaces (%20) for example mess things up:
            $header_image_info       = getimagesize($header_image_path);
            #echo '<pre>'; var_dump($header_image_info); echo '</pre>'; exit;
            $header_image_real_ratio = $header_image_info[0] / $header_image_info[1];
            $card_data['header_image_real_ratio'] = $header_image_real_ratio;

            if (empty($card_data['header_image_ratio'])) {
                $card_data['header_image_ratio'] = '56-25';
            }
            if (empty($card_data['header_image_width'])) {
                $card_data['header_image_width'] = '200';
            }

            $card_data['header_image_height'] = round($card_data['header_image_width'] / $header_image_real_ratio);
            //if ($header_image_info[0] > $header_image_info[1]) {
            //    $card_data['header_image_height'] = $card_data['header_image_width'] / $header_image_real_ratio;
            //} else {
            //    $card_data['header_image_height'] = $card_data['header_image_width'] * $header_image_real_ratio;
            //}
        }
    }
}

#echo '<pre>'; var_dump($card_data); echo '</pre>'; #exit;

if (!empty($card_data['footer_image'])) {
    // Check for an SVG:
    $pathinfo = pathinfo($card_data['footer_image']);
    $footer_image_svg_file = str_replace('.' . $pathinfo['extension'], '.svg', $card_data['footer_image']);

    if (file_exists(JPATH_BASE . '/' . $footer_image_svg_file)) {
        $card_data['footer_image_svg_file'] = $footer_image_svg_file;
    }

    $footer_image_path       = $public_root_path . $card_data['footer_image'];
    $footer_image_info       = getimagesize(urldecode($footer_image_path));
    $footer_image_real_ratio = $footer_image_info[0] / $footer_image_info[1];
    $card_data['footer_image_real_ratio'] = $footer_image_real_ratio;

    if (empty($card_data['footer_image_ratio'])) {
        $card_data['footer_image_ratio'] = '30';
    }
    if (empty($card_data['image_width'])) {
        $card_data['footer_image_width'] = '200';
    }

    $card_data['footer_image_height'] = round($card_data['footer_image_width'] / $footer_image_real_ratio);
    //if ($footer_image_info[0] > $footer_image_info[1]) {
    //    $card_data['footer_image_height'] = $card_data['footer_image_width'] / $footer_image_real_ratio;
    //} else {
    //    $card_data['footer_image_height'] = $card_data['footer_image_width'] * $footer_image_real_ratio;
    //}
}

if (empty($card_data['header_span_attr'])) {
    $card_data['header_span_attr'] = '';
} else {
    $card_data['header_span_attr'] = ' ' . $card_data['header_span_attr'];
}
?>

<article class="c-card<?php if (!empty($card_data['full_link']) && !empty($card_data['link'])) : ?>  js-c-card<?php endif; ?><?php if (!empty($card_data['theme_classes'])) : ?>  <?php echo $card_data['theme_classes']; ?><?php endif; ?><?php if (!empty($wrapper_classes)) : ?><?php echo '  ' . implode('  ', array_unique($wrapper_classes)); ?><?php endif; ?>">
    <div data-fs-block="border  rounded  inverted">
        <header class="c-card__header">
            <h<?php echo $card_data['hx']; ?> class="c-card__title">
                <?php if (!empty($card_data['link'])) : ?><a href="<?php echo $card_data['link']; ?>"<?php if (!empty($card_data['link_text'])) : ?> aria-describedby="desc-<?php echo TplNPEU6Helper::html_id($card_data['title']); ?>"<?php endif; ?>><?php endif; ?>
                    <span<?php echo $card_data['header_span_attr']; ?>><?php echo Markdown::defaultTransform($card_data['title']); ?></span>
                <?php if (!empty($card_data['link'])) : ?></a><?php endif; ?>
            </h<?php echo $card_data['hx']; ?>>
            <?php if (!empty($card_data['header_image'])) : ?>
            <div class="c-card__image  l-box">
                <div class="u-image-cover  js-image-cover  u-image-cover--min-<?php echo $card_data['header_image_ratio']; ?>">
                    <div class="u-image-cover__inner">
                        <img src="/<?php echo $card_data['header_image']; ?>?s=900" alt="<?php echo $card_data['header_image_alt']; ?>" class="u-image-cover__image" sizes="100vw" srcset="<?php echo $card_data['header_image']; ?>?s=1600 1600w, <?php echo $card_data['header_image']; ?>?s=900 900w, <?php echo $card_data['header_image']; ?>?s=300 300w" width="<?php echo $card_data['header_image_width']; ?>" height="<?php echo $card_data['header_image_height']; ?>">
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if (!empty($card_data['header_extra'])) : ?>
            <div class="c-card__header-extra">
                <?php echo $card_data['header_extra']; ?>
            </div>
            <?php endif; ?>
        </header>
        <?php if (!empty($card_data['body']) && !empty(trim($card_data['body']))) : ?>
        <div class="c-card__body  user-content">
            <?php echo trim($card_data['body']); ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($card_data['footer_extra']) || (!empty($card_data['link_text']) && !empty($card_data['link']))) : ?>

        <footer class="c-card__footer">
            <div class="l-layout  l-row  l-row--push-apart  l-gutter--s  l-flush-edge-gutter">
                <div class="l-layout__inner">
                    <?php if (!empty($card_data['footer_extra'])) : ?>
                    <p class="l-box  l-box--center  user-content">
                        <?php echo $card_data['footer_extra']; ?>
                    </p>
                    <?php endif; ?>
                    <?php if (!empty($card_data['link_text']) && !empty($card_data['link'])) : ?>
                    <p class="l-box  l-box--center">
                        <b><a href="<?php echo $card_data['link']; ?>" class="c-cta" id="desc-<?php echo TplNPEU6Helper::html_id($card_data['title']); ?>" tabindex="-1" aria-hidden="true"><?php echo $card_data['link_text']; ?><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-chevron-right"></use></svg></a></b>
                    </p>
                     <?php endif; ?>
                </div>
            </div>
        </footer>
        <?php endif; ?>

        <?php if (!empty($card_data['footer_image'])) : ?>
        <div class="c-card__footer-image<?php if (!empty($card_data['footer_image_padded'])) : ?>  c-card__footer-image--padded<?php endif; ?>">
            <div class="u-image-cover<?php if (!empty($card_data['footer_logo'])): ?>  u-image-cover--contain<?php endif; ?>  js-image-cover  u-image-cover--min-<?php echo $card_data['footer_image_ratio']; ?>">
                <div class="u-image-cover__inner<?php if (!empty($card_data['footer_logo'])): ?>  l-box--space--edge--s<?php endif; ?>">
                    <?php if (!empty($card_data['footer_image_svg_file'])): ?>
                    <img src="<?php echo $card_data['footer_image_svg_file']; ?>" onerror="this.src='<?php $card_data['footer_image']; ?>'; this.onerror=null;" alt="" class="u-image-cover__image" width="<?php echo $card_data['footer_image_width']; ?>" height="<?php echo $card_data['footer_image_height']; ?>">
                    <?php else: ?>
                    <img src="<?php echo $card_data['footer_image']; ?>?s=900" sizes="100vw" srcset="<?php echo $card_data['footer_image']; ?>?s=1600 1600w, <?php echo $card_data['footer_image']; ?>?s=1200 900w, <?php echo $card_data['footer_image']; ?>?s=450 300w" alt="" class="u-image-cover__image" width="<?php echo $card_data['footer_image_width']; ?>" height="<?php echo $card_data['footer_image_height']; ?>">
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>
</article>
