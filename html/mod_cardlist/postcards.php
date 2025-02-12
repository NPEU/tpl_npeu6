<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_cardlist
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\String\StringHelper;

$doc = Factory::getDocument();
$hx = (int) str_replace('h', '', $params->get('header_tag'));
$hx = 'h' . $hx;

$basis     = $params->get('card_basis', '25');
$full_link = $params->get('link_full', 0);
?>

<?php if (!empty($params->get('cards'))) : ?>

<div class="p-cards-postcards  mod_cardlist  modlayout_postcards">
    <div class="l-layout  l-gutter  l-basis--<?php echo $basis; ?>  l-flush-edge-gutter  l-distribute  l-distribute--balance-top">
        <div class="l-layout__inner">
        <?php foreach ($params->get('cards') as $card) : ?>
            <div class="l-box">
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
</div>
<?php endif; ?>
