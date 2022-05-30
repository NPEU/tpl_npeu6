<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.caption');


$dispatcher = JEventDispatcher::getInstance();

$this->category->text = $this->category->description;
$dispatcher->trigger('onContentPrepare', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$this->category->description = $this->category->text;

$results = $dispatcher->trigger('onContentAfterTitle', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayTitle = trim(implode("\n", $results));

$results = $dispatcher->trigger('onContentBeforeDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$beforeDisplayContent = trim(implode("\n", $results));

$results = $dispatcher->trigger('onContentAfterDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayContent = trim(implode("\n", $results));

// Remove items that aren't published:
/*

- Hmmm... this isn't necessary because the model DOES handle this - it just looks like it doesn't if
logged in a Super User (maybe others?). If that's the case then it includes unpublished items
regardless. I don't think there's a way to change this behaviour, so I'll just distinguish them
visually for now.

if (!empty($this->intro_items)) {
    foreach ($this->intro_items as $key=>$item) {
        #if ($item->state != 1 || in_array('4', $tag_ids)) {
        if (
            $item->state != 1
         || strtotime($item->publish_up) > strtotime(JFactory::getDate())
         || (
             strtotime($item->publish_down) < strtotime(JFactory::getDate())
          && $item->publish_down != JFactory::getDbo()->getNullDate()
          )
        ) {
            unset($this->intro_items[$key]);
        }
    }
}
$has_items = !empty($this->intro_items);
*/
/*
    @TODO - should really cater for LEAD items here too
    (and column I suppose though I don't currently use it).
*/
?>
<div class="c-panelx l-primary-content__space-inline--@large  com_blog">
    <?php if (!empty($this->intro_items)) : ?>
    <section class="l-layout  l-gutter  l-flush-edge-gutter  l-basis--30  l-limit--60  l-distribute  l-distribute--balance-top">
        <div class="l-layout__inner">
            <?php foreach ($this->intro_items as $key => &$item) : ?>
            <div class="l-box">
            <?php
                $this->item = &$item;
                echo $this->loadTemplate('item');
            ?>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <?php if (!empty($this->link_items)) : ?>
    <ul>
    <?php foreach ($this->link_items as &$item) : ?>
        <li<?php if ($item->state != 1): ?> style="opacity: 0.5;"<?php endif; ?>>
            <a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid, $item->language)); ?>">
                <?php echo $item->title; ?></a>
        </li>
    <?php endforeach; ?>
    </ul>
    <?php endif; ?>

    <?php if (($this->params->def('show_pagination', 1) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
    <section class="c-panel  d-background--very-light  t-neutral">
        <div class="n-pagination">
            <?php if ($this->params->def('show_pagination_results', 1)): ?>
            <?php #echo $this->pagination->getPagesCounter(); ?>
            <?php endif; ?>
            <?php echo $this->pagination->getPagesLinks(); ?>
        </div>
    </section>
    <?php endif; ?>
    
</div>