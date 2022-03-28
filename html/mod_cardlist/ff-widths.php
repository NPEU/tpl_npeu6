<?php
if (!empty($_SERVER['JTV2'])) {
    include(str_replace('.php', '.v2.php', __FILE__));
    return;
}
?><?php
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

<?php if (!empty($params->get('cards'))) :
$c = count((array) $params->get('cards'));
$ff_widths = array(
    1 => '100',
    2 => '50',
    3 => '33-333',
    4 => '25',
    5 => '20'
);

$ff_width = $ff_widths[$c];
?>
<div class="l-layout  l-row  l-gutter  l-flush-edge-gutter  mod_cardlist  modlayout_ff-widths">
    <div class="l-layout__inner">

    <?php foreach ($params->get('cards') as $card) :

    if (!empty($card->link && !empty($card->link_text))) {
        $card->body .= '<p class="c-card__cta"><a href="' . $card->link .'" class="c-cta  c-cta--has-icon">' . $card->link_text . '<svg display="none" focusable="false" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg></a></p>';
    }

    $full_link = false;

    if (!empty($card->link) && (bool) $params->get('link_full')) {
        $full_link = true;
    }

    $card->footer = trim($card->footer);
    ?>
        <div class="ff-width-100--45--<?php echo $ff_width; ?>  l-box">
            <div class="c-card  u-fill-height">
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
                <div class="c-card__main  u-fill-height--column__expand">
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
                <?php if (!empty($card->footer_image)) :
                // Check for an SVG:
                $pathinfo = pathinfo($card->footer_image);
                $footer_image_svg_file = str_replace('.' . $pathinfo['extension'], '.svg', $card->footer_image);

                if (file_exists(JPATH_BASE . '/' . $footer_image_svg_file)) {
                    $card->footer_image_svg = $footer_image_svg_file;
                }

                ?>
                <div class="c-card__footer_image">
                    <div class="l-proportional-container  l-proportional-container--4-1">
                        <div class="l-proportional-container__content">
                            <div class="u-image-cover<?php if (!empty($card->footer_logo)): ?>  u-image-cover--contain<?php endif; ?>  js-image-cover">
                                <div class="u-image-cover__inner<?php if (!empty($card->footer_logo)): ?>  u-padding--s  d-background  t-white<?php endif; ?>">
                                    <?php if (!empty($card->footer_image_svg)): ?>
                                    <img src="<?php echo $card->footer_image_svg; ?>" onerror="this.src='<?php echo $card->footer_image; ?>'; this.onerror=null;" alt="<?php echo $card->footer_image_alt; ?>" class="u-image-cover__image" width="200">
                                    <?php else: ?>
                                    <img src="<?php echo $card->footer_image; ?>?s=300" sizes="100vw" srcset="<?php echo $card->footer_image; ?>?s=1600 1600w, <?php echo $card->footer_image; ?>?s=900 900w, <?php echo $card->footer_image; ?>?s=300 300w" alt="<?php echo $card->footer_image_alt; ?>" class="u-image-cover__image" width="200">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php echo $full_link ? '</a>' : ''; ?>
            </div>
        </div>

    <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>
