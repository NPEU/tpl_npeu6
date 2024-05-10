<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

$app = Factory::getApplication();

$this->category->text = $this->category->description;
$app->triggerEvent('onContentPrepare', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$this->category->description = $this->category->text;

$results = $app->triggerEvent('onContentAfterTitle', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$afterDisplayTitle = trim(implode("\n", $results));

$results = $app->triggerEvent('onContentBeforeDisplay', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$beforeDisplayContent = trim(implode("\n", $results));

$results = $app->triggerEvent('onContentAfterDisplay', [$this->category->extension . '.categories', &$this->category, &$this->params, 0]);
$afterDisplayContent = trim(implode("\n", $results));

// Reorganise the data to be grouped by category:
$groups = [];

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
ksort($groups);
?>

<div class="c-panelx l-primary-content__space-inline--@large  com_blog">
    <?php if (!empty($groups)) : ?>
    <?php foreach ($groups as $title => $items) : ?>
    <?php if (!empty($items)) :
        ksort($items);
    ?>
    <h2><?php echo $title; ?></h2>
    <div class="l-layout  l-gutter  l-flush-edge-gutter">
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