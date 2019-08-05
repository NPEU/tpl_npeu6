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
?>
<div class="c-card-wrap">
    <article class="c-card  <?php echo $card_data['theme']; ?>">
        <a href="<?php echo $card_data['link']; ?>" class="c-card__full-link  <?php echo $card_data['theme']; ?>  u-fill-height--column">
            <?php if (!empty($card_data['image'])) : ?>
            <div class="c-card__image">
                <div class="l-proportional-container  l-proportional-container--2-1">
                    <div class="l-proportional-container__content">
                        <div class="u-image-cover  js-image-cover">
                            <div class="u-image-cover__inner">
                                <img src="/<?php echo $card_data['image']; ?>" alt="<?php echo $card_data['image_alt']; ?>" class="u-image-cover__image" width="150">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="c-card__main">
                <h2 class="c-card__title"><?php echo $card_data['title']; ?></h2>
                <div class="c-card__footer">
                    <p>
                        <?php echo date($card_data['date_format'], strtotime($card_data['publish_date'])); ?>
                    </p> 
                </div>
                <!--<div class="c-card__footer  u-text-align--right">
                    <a href="#" class="cta  cta--has-icon">Read<svg display="none" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg></a>
                </div>-->
            </div>
        </a>
    </article>
</div>