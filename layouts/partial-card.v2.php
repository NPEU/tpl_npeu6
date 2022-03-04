<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
JLoader::register('TplNPEU6Helper', dirname(__DIR__) . '/helper.php');
$public_root_path = realpath($_SERVER['DOCUMENT_ROOT']) . DIRECTORY_SEPARATOR;

/* <pre><?php var_dump($card_data); ?></pre> */
/*
    Expects a $card_data array with the following keys:
    theme_classes
    --full_link--
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

if (!empty($card_data['state']) && $card_data['state'] != 1) {
    $wrapper_classes[] = 'c-card--unpublished';
}

if (!empty($card_data['wrapper_classes'])) {
    $wrapper_classes = array_merge($wrapper_classes, $card_data['wrapper_classes']);
}

if (empty($card_data['hx'])) {
    $card_data['hx'] = '3';
}




if (!empty($card_data['header_image'])) {
    $header_image_path  = $public_root_path . $card_data['header_image'];
    $header_image_info  = getimagesize($header_image_path);
    $header_image_ratio = $header_image_info[0] / $header_image_info[1];
    
    if (empty($card_data['header_image_ratio'])) {
        $card_data['header_image_ratio'] = '56-25';
    }
    if (empty($card_data['header_image_width'])) {
        $card_data['header_image_width'] = '200';
    }
    $card_data['header_image_height'] = $card_data['header_image_width'] * $header_image_ratio;
}

if (!empty($card_data['footer_image'])) {
    $footer_image_path = $public_root_path . $card_data['footer_image'];
    $footer_image_info = getimagesize($footer_image_path);
    $footer_ratio      = $footer_image_info[0] / $footer_image_info[1];
    
    if (empty($card_data['footer_image_ratio'])) {
        $card_data['footer_image_ratio'] = '30';
    }
    if (empty($card_data['image_width'])) {
        $card_data['footer_image_width'] = '200';
    }
    $card_data['footer_image_height'] = $card_data['footer_image_width'] * $footer_ratio;
}
?>

<article class="c-card  js-c-card<?php if (!empty($card_data['theme_classes'])) : ?>  <?php echo $card_data['theme_classes']; ?><?php endif; ?><?php if (!empty($wrapper_classes)) : ?><?php echo implode('  ', array_unique($wrapper_classes)); ?><?php endif; ?>">
    <div data-fs-block="border">
        <header class="c-card__header">
            <h<?php echo $card_data['hx']; ?> class="c-card__title">
                <a href="<?php echo $card_data['link']; ?>"<?php if (!empty($card_data['link_text'])) : ?> aria-describedby="desc-<?php echo TplNPEU6Helper::html_id($card_data['title']); ?>"<?php endif; ?>>
                    <span><?php echo $card_data['title']; ?></span>
                </a>
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
        <?php if (!empty($card_data['body'])) : ?>
        <div class="c-card__body">
            <?php echo $card_data['body']; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($card_data['footer_extra']) || !empty($card_data['link_text'])) : ?>
        <div class="c-card__footer">
            <?php if (!empty($card_data['link_text'])) : ?>
            <div class="layout  l-row  l-row--end">
                <p class="l-layout__inner">
                    <b><a href="<?php echo $card_data['link']; ?>" class="c-cta" id="desc-<?php echo TplNPEU6Helper::html_id($card_data['title']); ?>" tabindex="-1" aria-hidden="true"><?php echo $card_data['link_text']; ?><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-chevron-right"></use></a></b>
                </p>
            </div>
            <?php endif; ?>
            <?php if (!empty($card_data['footer_extra'])) : ?>
            <footer>
               <?php echo $card_data['footer_extra']; ?>
            </footer>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php if (!empty($card_data['footer_image'])) : ?>
        <div class="c-card__footer-image<?php if (!empty($card_data['footer_image_padded'])) : ?>  c-card__footer-image--padded<?php endif; ?>">
            <div class="u-image-cover  js-image-cover  u-image-cover--min-<?php echo $card_data['footer_image_ratio']; ?>">
                <div class="u-image-cover__inner">
                    <img src="<?php echo $card_data['footer_image']; ?>?s=900" sizes="100vw" srcset="<?php echo $card_data['footer_image']; ?>?s=1600 1600w, <?php echo $card_data['footer_image']; ?>?s=900 900w, <?php echo $card_data['footer_image']; ?>?s=300 300w" alt="" class="u-image-cover__image" width="<?php echo $card_data['footer_image_width']; ?>" height="<?php echo $card_data['footer_image_height']; ?>">
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>
</article>
