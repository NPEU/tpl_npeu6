<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;

use NPEU\Template\Npeu6\Site\Helper\Npeu6Helper as TplNPEU6Helper;

$count = $params->get('count');
$count = ($count > 1 ? $count - 1 : 1);

// Don't show a news article if that's the one that's loaded on the page:
$doc   = Factory::getDocument();
#$current_article_in_list = false;
foreach($list as $k => $item) {
    if (isset($doc->article->id) && $item->id == $doc->article->id) {
        unset($list[$k]);
        #$current_article_in_list = true;
    }
}

if (empty($list)) {
    return '';
}

// If we HAVEN'T removed an item, remove the last one so the number of items doesn't fluctuate:
#if (count($list) > 1 && !$current_article_in_list) {
if (count($list) > $count) {
    array_pop($list);
}

if (empty($list)) {
    return '';
}



$page_brand = TplNPEU6Helper::get_brand();
$theme = 't-' . $page_brand->alias;

// @TODO - maybe make this configurable somewhere, but I don't want it to be per-instance so not
// sure where to put it.
$date_format = 'd M Y';

// Note: may need to modify this list if it includes items it shouldn't:
$items = $list;


// Note this is a bit rigid. Maybe move to separate templates or allow layout ff_widths to respond
// to $count in some way?
?>
<?php if ($count == 1): ?>
<?php $wrapper_classes = ['  mod_articles_latest  d-background  d-border']; $item = $items[0]; ?>
<?php require ModuleHelper::getLayoutPath('mod_articles_latest', '_item'); ?>
<?php else:
// Have a go at providing useful classes:
$wrapper_classes = ['d-background  d-border'];
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
    //$outer_class  = 'l-distribute--flush-edge-gutters';
    $outer_class  = 'l-layout  l-distribute  l-gutter  l-basis--20';
    $inner_class  = 'l-layout__inner';
    //$inner_class  = 'l-distribute  l-distribute--gutter--medium  l-distribute--limit-20';
    $item_class   = 'l-box';
}

?>
<div class="<?php echo $wrap_class; ?>  mod_articles_latest">
    <div class="<?php echo $outer_class; ?>">
        <div class="<?php echo $inner_class; ?>">
            <?php foreach ($items as $item): ?>
            <div class="<?php echo $item_class; ?>">
                <?php require ModuleHelper::getLayoutPath('mod_articles_latest', '_item'); ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<?php /*
<div class="s-updates  c-panel  <?php echo $theme; ?>">
    <section class="c-panel__module">
        <header class="u-text-group  u-text-group--push-apart  u-space--below">
            <h2>Trial Updates</h2>
            <p><a href="<?php echo $items[0]->category_route; ?>" class="c-cta  c-cta--has-icon">See all updates<svg display="none" focusable="false" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg></a></p>
        </header>

        <div class="l-col-to-row--flush-edge-gutters">
            <div class="l-col-to-row  l-col-to-row--gutter--medium">
                <?php foreach ($items as $item): ?>
                <div class="l-col-to-row__item  ff-width-100--50--33-333">
                    <?php require ModuleHelper::getLayoutPath('mod_articles_latest', '_item'); ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </section>
</div>
*/?>