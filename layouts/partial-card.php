<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
/* <pre><?php var_dump($card_data); ?></pre> */
/*
    Expects a $card_data array with the following keys:
    theme
    full_link
    link
    image
    image_alt
    image_width
    title
    date_format
    publish_date
    state

*/


$wrapper_classes = array();
if ($card_data['state'] != 1) {
    $wrapper_classes[] = 'c-card--unpublished';
}

if (!empty($card_data['wrapper_classes'])) {
    $wrapper_classes = array_merge($wrapper_classes, $card_data['wrapper_classes']);
}
?>
<div<?php if (!empty($wrapper_classes)): ?> class="<?php echo implode('  ', $wrapper_classes); ?>"<?php endif; ?>>
    <article class="c-card  <?php echo $card_data['theme']; ?>">
        <?php if (!empty($card_data['full_link'])) : ?><a href="<?php echo $card_data['link']; ?>" class="c-card__full-link  <?php echo $card_data['theme']; ?>  u-fill-height--column"><?php endif; ?>
            <?php if (!empty($card_data['image'])) : ?>
            <div class="c-card__image">
                <div class="l-proportional-container  l-proportional-container--2-1">
                    <div class="l-proportional-container__content">
                        <div class="u-image-cover  js-image-cover">
                            <div class="u-image-cover__inner">
                                <?php /*<img src="/<?php echo $card_data['image'] . (empty($card_data['image_width']) ? '' : '?s=' . $card_data['image_width']); ?>" alt="<?php echo $card_data['image_alt']; ?>" class="u-image-cover__image" width="150">*/ ?>
                                <img src="/<?php echo $card_data['image']; ?>?s=900" alt="<?php echo $card_data['image_alt']; ?>" class="u-image-cover__image" sizes="(min-width: 960px) 430px, 90vw" srcset="<?php echo $card_data['image']; ?>?s=460 460w, <?php echo $card_data['image']; ?>?s=900 900w" width="150">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="c-card__main">
                <h2 class="c-card__title">
                <?php /*if (empty($card_data['full_link'])) : ?><a href="<?php echo $card_data['link']; ?>"><?php endif;*/?>
                <?php echo $card_data['title']; ?>
                <?php /*if (empty($card_data['full_link'])) : ?></a><?php endif;*/ ?>
                </h2>
                <?php if (!empty($card_data['body'])) : ?>
                <div class="c-card__body">
                    <?php echo $card_data['body']; ?>
                    <?php if (empty($card_data['full_link'])) : ?>
                    <p class="u-text-align--right">
                        <a href="<?php echo $card_data['link']; ?>" class="c-cta  c-cta--has-icon">Read more<span hidden aria-hidden="false"> about <?php echo $card_data['title']; ?></span><svg display="none" focusable="false" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg></a>
                    </p>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <?php if (!empty($card_data['date_format']) && !empty($card_data['publish_date'])) : ?>
                <div class="c-card__footer">
                    <p>
                        <?php echo date($card_data['date_format'], strtotime($card_data['publish_date'])); ?>
                    </p>
                </div>
                <!--<div class="c-card__footer  u-text-align--right">
                    <a href="#" class="c-cta  c-cta--has-icon">Read<svg display="none" focusable="false" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg></a>
                </div>-->
                <?php endif; ?>
            </div>
        <?php if (!empty($card_data['full_link'])) : ?></a><?php endif; ?>
    </article>
</div>