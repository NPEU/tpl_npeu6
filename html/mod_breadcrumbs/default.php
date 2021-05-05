<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_breadcrumbs
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
#echo '<pre>'; var_dump($list); echo '</pre>'; exit;
// Get rid of duplicated entries on trail including home page when using multilanguage
for ($i = 0; $i < $count; $i++)
{
    if ($i === 1 && !empty($list[$i]->link) && !empty($list[$i - 1]->link) && $list[$i]->link === $list[$i - 1]->link)
    {
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
<nav aria-label="Breadcrumbs">
    <dl class="n-breadcrumbs" itemscope itemtype="https://schema.org/BreadcrumbList">
        <dt class="n-breadcrumbs__title"><?php echo JText::_('MOD_BREADCRUMBS_HERE'); ?></dt>

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
        <dd class="n-breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <?php if (!empty($item->link)): ?>
            <a class="n-breadcrumbs__link" itemprop="item" href="<?php echo preg_replace('/\?.*/', '', $item->link); ?>"><span itemprop="name"><?php echo $item->name; ?></span></a>
            <?php else: ?>
            <a class="n-breadcrumbs__link" itemprop="item"><span itemprop="name"><?php echo $item->name; ?></span></a>
            <?php endif; ?>
            <meta itemprop="position" content="<?php echo $key + 1; ?>">
        </dd>
        <?php elseif ($show_last):
        // Make a link if not the last item in the breadcrumbs
        // Render last item if reqd. ?>
        <dd class="n-breadcrumbs__item">
            <a class="n-breadcrumbs__link"><span><?php echo $item->name; ?></span></a>
        </dd>
        <?php endif; ?>
        <?php endforeach; ?>
    </dl>
</nav>
<?php endif; ?>