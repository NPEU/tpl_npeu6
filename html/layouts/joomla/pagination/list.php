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
<nav aria-label="Pagination" class="l-layout  l-row  l-row--center  n-pagination">
    <p class="l-layout__inner">
        <span class="l-box  n-pagination__start-links">
            <span class="l-layout  l-row  l-row--center">
                <span class="l-layout__inner">
                    <span class="l-box">
                        <?php echo $list['start']['data']; ?><span class="l-box__separator">&nbsp;&nbsp;|&nbsp;</span>
                    </span>
                    <span class="l-box">
                        <?php echo $list['previous']['data']; ?><span class="l-box__separator">&nbsp;&nbsp;|&nbsp;</span>
                    </span>
                </span>
            </span>
        </span>

        <span role="list" class="l-box  n-pagination__page-links">
            <span class="l-layout  l-row  l-row--center">
                <span class="l-layout__inner">
                    <?php foreach ($list['pages'] as $page) : ?>
                    <span role="listitem" class="l-box">
                        <?php echo $page['data'] ; ?><span class="l-box__separator">&nbsp;&nbsp;|&nbsp;</span>
                    </span>
                    <?php endforeach; ?>
                </span>
            </span>
        </span>

        <span class="l-box  n-pagination__end-links">
            <span class="l-layout  l-row  l-row--center">
                <span class="l-layout__inner">
                    <span class="l-box">
                        <?php echo $list['next']['data']; ?><span class="l-box__separator">&nbsp;&nbsp;|&nbsp;</span>
                    </span>
                    <span class="l-box">
                        <?php echo $list['end']['data']; ?>
                    </span>
                </span>
            </span>
        </span>
    </p>
</nav>
