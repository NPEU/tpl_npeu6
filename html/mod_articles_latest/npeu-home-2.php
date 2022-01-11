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

$theme = '';
if ($page_brand) {
    $theme = 't-' . $page_brand->alias;
}

// @TODO - maybe make this configurable somewhere, but I don't want it to be per-instance so not
// sure where to put it.
$date_format = 'd M Y';

// Note: may need to modify this list if it includes items it shouldn't:
$items = $list;
$count = $params->get('count');

// Note this is a bit rigid. Maybe move to separate templates or allow layout ff_widths to respond
// to $count in some way?
?>
<?php if ($count == 1): ?>
<?php $item = $items[0]; ?>
<?php require JModuleHelper::getLayoutPath('mod_articles_latest', '_item'); ?>
<?php else:
$i = 1;
$j = 0;
$item = array_shift($items);
$count--;
?>
<div class="l-layout  l-row  l-gutter  l-flush-edge-gutter  mod_articles_latest">
    <div class="l-layout__inner">
        <div class="l-box  ff-width-100--55--50">
            <?php require JModuleHelper::getLayoutPath('mod_articles_latest', '_item'); ?>
        </div>

        <div class="l-box  ff-width-100--55--50">
        <?php
        // Have a go at providing useful classes:
        $i = 0;
       /* if ($count >= 2 && $count < 5) {
            $wrap_class  = '';
            $outer_class = 'l-col-to-row--flush-edge-gutters';
            $inner_class = 'l-col-to-row  l-col-to-row--gutter--medium';
            $portion ='50';
            if ($count == 3) {
                $portion = '33-333';
            }
            if ($count == 4) {
                $portion = '25';
            }
            $item_class  = 'l-col-to-row__item  ff-width-100--45--' . $portion;
        } else {*/
            ///$outer_class  = 'l-distribute--flush-edge-gutters  u-fill-height';
            $outer_class  = 'l-layout  l-distribute  l-distribute--balance-top  l-gutter  l-basis--25  l-flush-edge-gutter  u-fill-height';
            $inner_class  = 'l-layout__inner'; 
            ///$inner_class  = 'l-distribute  l-distribute--balance-top  l-distribute--gutter--m  l-distribute--basis-25'; 
        /*}*/
        ?>
            <div class="<?php echo $outer_class; ?>">
                <div class="<?php echo $inner_class; ?>">
                    <?php foreach ($items as $item): $j++; 
                    
                    // Ditch hero images after first 2:
                    if ($j > 2) {
                        $item->skip_image = true;
                    }
                    
                    ?>
                    <div class="l-box">
                        <?php require JModuleHelper::getLayoutPath('mod_articles_latest', '_item'); ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>
</div>
<?php endif; ?>
