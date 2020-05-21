<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
/* <pre><?php var_dump($item); ?></pre> */
$fields = FieldsHelper::getFields('com_content.article', $item, true);

$i = isset($i) ? $i : 0;

$card_data = array();

$card_data['theme']        = $theme;
$card_data['full_link']    = $i == 1 ? false : true;
$card_data['link']         = $item->link;
$card_data['image']        = !empty($item->skip_image) ? false : $fields[0]->rawvalue;
$card_data['image_alt']    = $fields[1]->rawvalue;
$card_data['title']        = $item->title;
$card_data['body']         = $i == 1 ? $item->introtext : '';
$card_data['publish_date'] = $item->publish_up;
$card_data['date_format']  = $date_format;

include(dirname(dirname(__DIR__)) . '/layouts/partial-card.php');
/*
?>
<div class="c-card-wrap">
    <article class="c-card  <?php echo $theme; ?>">
        <a href="<?php echo $item->link; ?>" class="c-card__full-link  <?php echo $theme; ?>  u-fill-height--column">
            <?php if (!empty($fields[0]->rawvalue)) : ?>
            <div class="c-card__image">
                <div class="l-proportional-container  l-proportional-container--2-1">
                    <div class="l-proportional-container__content">
                        <div class="u-image-cover  js-image-cover">
                            <div class="u-image-cover__inner">
                                <img src="/<?php echo $fields[0]->rawvalue; ?>" alt="<?php echo $fields[1]->rawvalue; ?>" class="u-image-cover__image" width="150">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="c-card__main">
                <h2 class="c-card__title"><?php echo $item->title; ?></h2>
                <div class="c-card__footer">
                    <p>
                        <?php echo date($date_format, strtotime($item->publish_up)); ?>
                    </p> 
                </div>
                <!--<div class="c-card__footer  u-text-align--right">
                    <a href="#" class="c-cta  c-cta--has-icon">Read<svg display="none" focusable="false" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg></a>
                </div>-->
            </div>
        </a>
    </article>
</div>
*/
?>