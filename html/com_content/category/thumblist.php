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

// Reorganise the data to be grouped by category:
/*$groups = [];

foreach ($this->items as $item) {
    if ($item->state != 1) {
        continue;
    }
    $cat_title = $item->category_title;
    if (!array_key_exists($cat_title, $groups)) {
        $groups[$cat_title] = [];
    }

    $groups[$cat_title][$item->title] = $item;
}
ksort($groups);*/
?>

<div class="longform-content  user-content" >
    <div class="l-flush-edge-gutter l-gutter--s l-layout" style="--listing-body-width:10em">
        <div class="l-layout__inner">

            <?php foreach ($this->items as $key => $item) : ?>
            <div class="l-box">
                <?php
                    $this->item = $item;
                    echo $this->loadTemplate('item');
                ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<?php /*
<div class="c-panelx l-primary-content__space-inline--@large  com_blog">
    <?php if (!empty($groups)) : ?>
    <?php foreach ($groups as $title => $items) : ?>
    <?php if (!empty($items)) :
        ksort($items);
    ?>
    <h2><?php echo $title; ?></h2>
    <div class="l-layout  l-gutter  l-gutter--l  l-flush-edge-gutter">
        <div class="l-layout__inner">
            <?php foreach ($items as $key => $item) : ?>
            <div class="l-box">
                <?php
                    $this->item = $item;
                    echo $this->loadTemplate('item');
                ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>


</div>

*/ ?>