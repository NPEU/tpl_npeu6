<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_breadcrumbs
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

#echo '<pre>'; var_dump($list); echo '</pre>'; exit;
// Get rid of duplicated entries on trail including home page when using multilanguage
for ($i = 0; $i < $count; $i++) {
    if ($i === 1 && !empty($list[$i]->link) && !empty($list[$i - 1]->link) && $list[$i]->link === $list[$i - 1]->link) {
        unset($list[$i]);
        $count--;
    }
}


// I can't remember exactly why I need to do the above, but it doesn't remove duplicates for
// 'Add New' pages for Staff Area, so removing that seperately.:
if ((isset($list[2]) && isset($list[3])) && $list[2]->name == $list[3]->name) {
    $list[2]->link == '';
    unset($list[3]);
}

$show_last = $params->get('showLast', 1);

if ($count > 0) :
?>
<nav aria-label="Breadcrumbs" class="l-layout  l-row  l-row--start  l-gutter--xs  d-background--dark t-npeu  l-box--space--inline--xs  mod_breadcrumbs" data-area="breadcrumbs">
    <div class="l-layout__inner  c-utilitext">
        <p class="l-box"><?php echo Text::_('MOD_BREADCRUMBS_HERE'); ?> </p>
        <p role="list" class="l-box" itemscope="" itemtype="https://schema.org/BreadcrumbList">
            <span class="l-layout  l-row  l-row--start  l-gutter--xs  l-flush-edge-gutter">
                <span class="l-layout__inner">

                    <?php

                    // Find last and penultimate items in breadcrumbs list
                    end($list);
                    $last_item_key   = key($list);
                    prev($list);
                    $penult_item_key = key($list);


                    // Generate the trail ?>
                    <?php foreach ($list as $key => $item): ?>
                    <?php if ($key !== $last_item_key):
                    // Render all but last item - along with separator ?>
                    <span role="listitem" class="l-box" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
                        <?php if (!empty($item->link)): ?>
                        <a itemprop="item" href="<?php echo preg_replace('/\?.*/', '', Route::_($item->link)); ?>"><span itemprop="name"><?php echo $item->name; ?></span></a>
                        <?php else: ?>
                        <a class="n-breadcrumbs__link" itemprop="item"><span itemprop="name"><?php echo $item->name; ?></span></a>
                        <a itemprop="item"><span itemprop="name"><?php echo $item->name; ?></span></a>
                        <?php endif; ?>
                        <meta itemprop="position" content="<?php echo $key + 1; ?>">
                    </span>
                    <span class="l-box__separator">&nbsp;&nbsp;/&nbsp;&nbsp;</span>
                    <?php elseif ($show_last):
                    // Render last item if reqd. ?>
                    <span role="listitem" class="l-box" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
                        <a aria-current="page"><span><?php echo $item->name; ?></span></a>
                        <meta itemprop="position" content="<?php echo $key + 1; ?>">
                    </span>
                    <?php endif; ?>
                    <?php endforeach; ?>

                </span>
            </span>
        </p>

    </div>
</nav>
<?php endif; ?>