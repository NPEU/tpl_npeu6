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
<nav class="l-layout  l-row  l-row--push-apart  n-pagination">
    <p class="l-layout__inner">
    <?php if ($row->prev) : ?>
        <span class="l-box">
            <a href="<?php echo $row->prev; ?>" rel="next"><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-chevron-left"></use></svg><span><?php echo JText::_('PAGINATION_PREVIOUS'); ?></span></a><span class="l-box__separator">&nbsp;&nbsp;|&nbsp;</span>
        </span>
    <?php endif; ?>
    <?php if ($row->next) : ?>
        <span class="l-box  l-box--push-end">
            <a href="<?php echo $row->next; ?>" rel="prev" ><span><?php echo JText::_('PAGINATION_NEXT'); ?></span><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-chevron-right"></use></svg></a>
        </span>
    <?php endif; ?>
    </p>
</nav>

