<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
defined('_JEXEC') or die;

JLoader::register('TplNPEU6Helper', dirname(dirname(__DIR__)) . '/helper.php');
$page_brand = TplNPEU6Helper::get_brand();
$theme = 't-' . $page_brand->alias;

// @TODO - maybe make this configurable somewhere, but I don't want it to be per-instance so not
// sure where to put it.
$date_format = 'd M Y';

// Note: may need to modify this list if it includes items it shouldn't:
$items = $list;
$count = $params->get('count');

if ($count >= 2 && $count < 5) {
    $wrap_class  = '';
    //$outer_class = 'l-col-to-row--flush-edge-gutters';
    $outer_class = 'l-layout  l-gutter  l-flush-edge-gutter';
    $inner_class = 'l-layout__inner';
    //$inner_class = 'l-col-to-row  l-col-to-row--gutter';
    $portion ='50';
    if ($count == 3) {
        $portion = '33-333';
    }
    if ($count == 4) {
        $portion = '25';
    }
    $item_class  = 'l-col-to-row__item  ff-width-100--50--' . $portion;
} else {
    $wrap_class   = '';
    $outer_class  = 'l-layout  l-gutter  l-flush-edge-gutter  l-basis--25  l-distribute  l-distribute--balance-top';
    $inner_class  = 'l-layout__inner'; 
    $item_class   = '';
}


?>
<div class="<?php echo $wrap_class; ?>  mod_articles_category">
    <div class="<?php echo $outer_class; ?>">
        <ul class="<?php echo $inner_class; ?>">
            <?php foreach ($items as $item): ?>
            <li class="l-box  <?php echo $item_class; ?>">
                <?php
                $fields = FieldsHelper::getFields('com_content.article', $item, true);

                $card_data = array();
                $card_data['wrapper_classes']  = array($moduleclass_sfx);              
                $card_data['link']             = $item->link;
                $card_data['header_image']     = !empty($item->skip_image) ? false : $fields[0]->rawvalue;
                $card_data['header_image_alt'] = $fields[1]->rawvalue;
                $card_data['title']            = $item->title;


                include(dirname(dirname(__DIR__)) . '/layouts/partial-card.php');

                ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
