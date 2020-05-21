<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.pagenavigation
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');

$lang = JFactory::getLanguage();

?>
<div class="n-pagination  u-max-measure">
    <ul class="n-pagination__list  n-pagination__list--push-apart">
    <?php if ($row->prev) :
        $direction = $lang->isRtl() ? 'right' : 'left'; ?>
        <li class="n-pagination__item">
            <a class="n-pagination__link" aria-label="<?php echo JText::sprintf('PAGINATION_PREVIOUS_TITLE', htmlspecialchars($rows[$location-1]->title)); ?>" href="<?php echo $row->prev; ?>" rel="prev">
                <svg display="none" focusable="false" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-left"></use></svg><?php echo '<span aria-hidden="true">' . JText::_('PAGINATION_PREVIOUS') . '</span>'; ?>
            </a>
        </li>
    <?php endif; ?>
    <?php if ($row->next) :
        $direction = $lang->isRtl() ? 'left' : 'right'; ?>
        <li class="n-pagination__item  u-space--left--auto">
            <a class="n-pagination__link" aria-label="<?php echo JText::sprintf('PAGINATION_NEXT_TITLE', htmlspecialchars($rows[$location+1]->title)); ?>" href="<?php echo $row->next; ?>" rel="next">
                <?php echo '<span aria-hidden="true">' . JText::_('PAGINATION_NEXT') . '</span>'; ?><svg display="none" focusable="false" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg>
            </a>
        </li>
    <?php endif; ?>
    </ul>
</div>

