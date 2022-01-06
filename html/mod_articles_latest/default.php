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

// Note this is a bit rigid. Maybe move to separate templates or allow layout ff_widths to respond
// to $count in some way?
?>
<?php if ($count == 1): ?>
<?php $item = $items[0]; ?>
<?php require JModuleHelper::getLayoutPath('mod_articles_latest', '_item'); ?>
<?php else: 
// Have a go at providing useful classes:

if ($count >= 2 && $count < 5) {
    $wrap_class  = 'mod_articles_latest';
    $outer_class = 'l-layout  l-row  l-gutter  l-flush-edge-gutter';
    $inner_class = 'l-layout__inner';
    $portion ='50';
    if ($count == 3) {
        $portion = '33-333';
    }
    if ($count == 4) {
        $portion = '25';
    }
    $item_class  = 'l-box  ff-width-100--50--' . $portion;
} else {
    $wrap_class   = 'u-space--below  mod_articles_latest';
    $outer_class  = 'l-distribute--flush-edge-gutters';
    $inner_class  = 'l-distribute  l-distribute--gutter--medium  l-distribute--limit-20'; 
    $item_class   = 'l-box';
}

?>
<div class="<?php echo $wrap_class; ?>  mod_articles_latest">
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
<?php endif; ?>

<?php /*
<div class="s-updates  c-panel  c-panel--dark  <?php echo $theme; ?>">
    <section class="c-panel__module">
        <header class="u-text-group  u-text-group--push-apart  u-space--below">
            <h2>Trial Updates</h2>
            <p><a href="<?php echo $items[0]->category_route; ?>" class="c-cta  c-cta--has-icon">See all updates<svg display="none" focusable="false" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg></a></p>
        </header>
        
        <div class="l-col-to-row--flush-edge-gutters">
            <div class="l-col-to-row  l-col-to-row--gutter--medium">
                <?php foreach ($items as $item): ?>
                <div class="l-col-to-row__item  ff-width-100--50--33-333">
                    <?php require JModuleHelper::getLayoutPath('mod_articles_latest', '_item'); ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </section>
</div>
*/?>