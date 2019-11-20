<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_cardlist
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;
use Joomla\String\StringHelper;


$doc = JFactory::getDocument();
$hx = StringHelper::increment($params->get('header_tag'));
?>
<?php if ($module->showtitle): ?>
<<?php echo $params->get('header_tag'); ?>><?php echo $module->title; ?></<?php echo $params->get('header_tag'); ?>>
<?php endif; ?>

<?php if (!empty($params->get('cards'))) : ?>

<div class="l-distribute-wrap">
<div class="l-distribute--flush-edge-gutters">
<ul class="l-distribute  l-distribute--gutter--medium  l-distribute--limit-20">
                        

<?php foreach ($params->get('cards') as $card) :

if (!empty($card->link && !empty($card->link_text))) {
    $card->body .= '<p class="c-card__cta"><a href="' . $card->link .'" class="cta  cta--has-icon">' . $card->link_text . '<svg display="none" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg></a></p>';
}

$full_link = false;

if (!empty($card->link) && (bool) $params->get('link_full')) {
    $full_link = true;
}
?>
    <li class="">
        <div class="c-card-wrap">
            <div class="c-card">
                <?php echo $full_link ? '<a href="' . $card->link .'" class="c-card__full-link  u-fill-height--column">' : ''; ?>
                <?php if (!empty($card->header_image)) : ?>


                <div class="c-card__image">
                    <div class="l-proportional-container  l-proportional-container--3-1">
                        <div class="l-proportional-container__content">
                            <div class="u-image-cover  js-image-cover">
                                <div class="u-image-cover__inner">
                                    <img src="<?php echo $card->header_image; ?>?s=300" sizes="100vw" srcset="<?php echo $card->header_image; ?>?s=1600 1600w, <?php echo $card->header_image; ?>?s=900 900w, <?php echo $card->header_image; ?>?s=300 300w" alt="<?php echo $card->header_image_alt; ?>" class="u-image-cover__image" width="200">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="c-card__main">
                    <<?php echo $hx; ?> class="c-card__title"><?php echo $card->title; ?></<?php echo $hx; ?>>
                    <?php if (!empty($card->body)) : ?>
                    <div class="c-card__body">
                        <?php echo $card->body; ?>

                    </div>
                    <?php endif; ?>
                    <?php if (!empty($card->footer)) : ?>
                    <div class="c-card__footer">
                        <?php echo $card->footer; ?>
                        <?php /* Not sure how to handle this, as this markup would be a pain in the editor, but is what's needed for proper footer layout
                        <p class="c-card__info  u-text-group  u-text-group--wide-space">
                            <span class="u-text-group"><span>Published on: </span><span>18 June 2018 10:11</span></span>
                            <span class="u-text-group"><span>Published in: </span><span>Quite a long category name category name to test wrapping</span></span>
                        </p>
                        */ ?>
                    </div>
                    <?php endif; ?>

                </div>
                <?php if (!empty($card->footer_image)) : ?>
                <div class="c-card__footer_image">
                    <div class="l-proportional-container  l-proportional-container--5-1">
                        <div class="l-proportional-container__content">
                            <div class="u-image-cover  js-image-cover">
                                <div class="u-image-cover__inner">
                                    <img src="<?php echo $card->footer_image; ?>?s=300" sizes="100vw" srcset="<?php echo $card->footer_image; ?>?s=1600 1600w, <?php echo $card->footer_image; ?>?s=900 900w, <?php echo $card->footer_image; ?>?s=300 300w" alt="<?php echo $card->footer_image_alt; ?>" class="u-image-cover__image" width="200">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php echo $full_link ? '</a>' : ''; ?>
            </div>
        </div>
    </li>
    
<?php endforeach; ?>
</ul>
</div>
</div>
<?php endif; ?>
