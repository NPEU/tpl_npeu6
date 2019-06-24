<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_breadcrumbs
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<nav aria-label="breadcrumbs" class="u-padding--sides  u-padding--top  d-background  t-white">
    <dl class="n-breadcrumbs" itemscope itemtype="https://schema.org/BreadcrumbList">
        <dt class="n-breadcrumbs__title"><?php echo JText::_('MOD_BREADCRUMBS_HERE'); ?></dt>
        
        <?php
		// Get rid of duplicated entries on trail including home page when using multilanguage
		for ($i = 0; $i < $count; $i++)
		{
			if ($i === 1 && !empty($list[$i]->link) && !empty($list[$i - 1]->link) && $list[$i]->link === $list[$i - 1]->link)
			{
				unset($list[$i]);
			}
		}

		// Find last and penultimate items in breadcrumbs list
		end($list);
		$last_item_key   = key($list);
		prev($list);
		$penult_item_key = key($list);

		// Make a link if not the last item in the breadcrumbs
		$show_last = $params->get('showLast', 1);

		// Generate the trail ?>
		<?php foreach ($list as $key => $item): ?>
		<?php if ($key !== $last_item_key):
		// Render all but last item - along with separator ?>
        <dd class="n-breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <?php if (!empty($item->link)): ?>
            <a class="n-breadcrumbs__link" itemprop="item" href="<?php echo $item->link; ?>"><span itemprop="name"><?php echo $item->name; ?></span></a>
            <?php else: ?>
            <a class="n-breadcrumbs__link" itemprop="name"><span><?php echo $item->name; ?></span></a>
            <?php endif; ?>
            <meta itemprop="position" content="<?php echo $key + 1; ?>">
        </dd>
        <?php elseif ($show_last):
        // Render last item if reqd. ?>
        <dd class="n-breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a class="n-breadcrumbs__link" itemprop="name"><span><?php echo $item->name; ?></span></a>
            <meta itemprop="position" content="<?php echo $key + 1; ?>">
        </dd>
        <?php endif; ?>
		<?php endforeach; ?>
    </dl>
</nav>

