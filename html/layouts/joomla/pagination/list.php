<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$list = $displayData['list'];
?>
<ul class="n-pagination__list">
	<li class="n-pagination__item"><?php echo $list['start']['data']; ?></li>
	<li class="n-pagination__item"><?php echo $list['previous']['data']; ?></li>
	<?php foreach ($list['pages'] as $page) : ?>
        <?php if ($page['active']): ?>
		<?php echo '<li class="n-pagination__item">' . $page['data'] . '</li>'; ?>
        <?php else: ?>
		<?php echo '<li class="n-pagination__item  n-pagination__item--active">' . $page['data'] . '</li>'; ?>
        <?php endif; ?>
	<?php endforeach; ?>
	<li class="n-pagination__item"><?php echo $list['next']['data']; ?></li>
	<li class="n-pagination__item"><?php echo $list['end']['data']; ?></li>
</ul>
