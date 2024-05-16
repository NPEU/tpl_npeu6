<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_cardlist
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;#

use Joomla\CMS\Factory;
use Joomla\String\StringHelper;

$doc = Factory::getDocument();
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
$full_link = $params->get('link_full', 0);
//echo '<pre>'; var_dump($params->get('cards')); echo '</pre>'; exit;
?>
<div class="l-layout  l-row  l-gutter  l-flush-edge-gutter  mod_cardlist  modlayout_ff-widths">
    <div class="l-layout__inner">

    <?php foreach ($params->get('cards') as $card) : ?>

        <div class="ff-width-100--45--<?php echo $ff_width; ?>  l-box">
            <?php
            $card_data = (array) $card;
            //echo '<pre>'; var_dump($card_data); echo '</pre>'; exit;

            $card_data['theme_classes'] = empty($card->theme_classes) ? 'd-background' : $card->theme_classes;
            $card_data['full_link']     = $full_link;
            /*
            $card_data['link']          = $card->link;
            $card_data['image']         = $headline_image['headline-image'];
            $card_data['image_alt']     = $headline_image['headline-image-alt-text'];
            $card_data['title']         = $this->item->title;
            $card_data['publish_date']  = $this->item->publish_up;
            $card_data['date_format']   = $date_format;
            $card_data['state']         = (int) $this->item->state;
            */

            $card_path = dirname(dirname(__DIR__)) . '/layouts/partial-card.php';
            //echo '<pre>'; var_dump($card_path); echo '</pre>'; exit;
            //echo '<pre>'; var_dump(file_exists($card_path)); echo '</pre>'; exit;
            include($card_path);

            ?>
        </div>

    <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>
