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

// Hack for template migration. DELETE THIS WHEN MIGRATOPM COMPLETE:
$tmpl = TplNPEU6Helper::get_template();

if ($tmpl->template == 'npeu5') {
    require dirname(dirname(dirname(__DIR__))) .'/npeu5/html/mod_articles_latest/home.php';
    return;
}


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

// Note this is a bit rigid. Maybe move to separate templates or allow layout ff_widths to responsd
// to $count in some way?
?>
<?php if ($count == 1): ?>
<?php $item = $items[0]; ?>
<?php require JModuleHelper::getLayoutPath('mod_articles_latest', '_item'); ?>
<?php else:
$i = 1;

$item = array_shift($items);
$count--;
?>
<div class="l-col-to-row-wrap">
    <div class="l-col-to-row--flush-edge-gutters">
        <div class="l-col-to-row  l-col-to-row--gutter--medium">
            <div class="l-col-to-row__item  ff-width-100--55--50">
                <?php require JModuleHelper::getLayoutPath('mod_articles_latest', '_item'); ?>
            </div>

            <div class="l-col-to-row__item  ff-width-100--55--50">
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
                $wrap_class   = 'l-distribute-wrap';
                $outer_class  = 'l-distribute--flush-edge-gutters';
                $inner_class  = 'l-distribute  l-distribute--gutter--small  l-distribute--limit-30'; 
                $item_class   = 'u-padding--s';
            /*}*/
            ?>
                <div class="<?php echo $wrap_class; ?>">
                    <div class="<?php echo $outer_class; ?>">
                        <ul class="<?php echo $inner_class; ?>">
                            <?php foreach ($items as $item): ?>
                            <li class="<?php echo $item_class; ?>">
                                <?php require JModuleHelper::getLayoutPath('mod_articles_latest', '_item'); ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php endif; ?>
