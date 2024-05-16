<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_publications
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

$template_path = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname(dirname(dirname(__DIR__))));

$doc = Factory::getDocument();
$doc->addScript($template_path . '/js/filter.min.js');

$jinput = Factory::getApplication()->input;

unset($this->all['*']);

ob_start(); ?>
<div class="c-panel  c-panel--white  c-panel--framed">
    <div class="c-panel__module">

        <form class="c-tool-form  c-panel  d-border" id="pubsForm" name="pubsForm" method="get" action="/research/publications">
            <div>
                <label class="" for="filter_keywords" id="filter_keywords-lbl">Search publications:</label>
                <span class="c-composite">
                    <input type="text" value="<?php echo htmlentities($jinput->getString('keywords', '')); ?>" id="filter_keywords" name="keywords">
                    <button type="submit">Search</button>
                    <a class="c-cta" href="/research/publications">Clear</a>
                </span>
            </div>
        </form>

    </div>
</div>
<?php
$doc->component__sidebar_top = ob_get_contents();
ob_end_clean(); ?>

<?php if(empty($this->all)): ?>
<p>There are no publications to display.</p>
<?php else: ?>
<?php if ($this->is_filtered): ?>
<p>Found <strong><?php echo $this->publications_total; ?></strong> publications matching <em><?php echo htmlentities($jinput->getString('keywords', '')); ?></em></p>
<?php endif; ?>

<?php
$fieldsets      = $this->form->getFieldsets();
$fieldset_info  = $fieldsets['filter'];
$fieldset_class = isset($fieldset_info->class)
                ? ' class="' . $fieldset_info->class . '"'
                : '';
$describedby_id = $this->form->getFieldAttribute('keywords', 'name', '', 'filter') . '_info';
/*?>

<div>
    <?php $i = 0; foreach($this->all as $year => $data): ?>
    <?php if(!empty($data['publications'])): ?>
    <h2 id="year_<?php echo $year; ?>"><?php echo $year; ?></h2>
    <ul>
        <?php foreach($data['publications'] as $publication): ?>
        <li class="u-space--below--s">
            <?php if(!$this->is_filtered): ?>
            <span><?php echo $this->escape($publication['full_entry']); ?></span>
            <?php else: ?>
            <?php echo preg_replace('/(' . preg_quote(JRequest::getString('keywords')) . ')/i', '<mark><b>$1</b></mark>', $publication['full_entry']); ?>
            <?php endif; ?>
            <?php if (!empty($publication['url'])) : ?>
            <br><a href="<?php echo $publication['url']; ?>">Link to the publication or abstract</a>
            <?php endif; ?>
            <br>[<?php echo $publication['type']; ?>]
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <?php $i++; ?>
    <?php endforeach; ?>
</div>
<?php endif;*/ ?>

<div filterable_group filterable_mark_results filterable_replace="#pubsForm">
    <script type="text/template" filterable_form_template>
        <form class="c-form  c-form--tool-form">
            <label for="filter_title">Filter publications by title:</label>
            <span class="c-composite">
                 <input id="filter_title" filterable_input> <button filterable_submit>Filter</button>
            </span>
            <input type="reset" value="Clear" filterable_reset>
            <fieldset class="c-form--tool-form__fieldset">
                <div>
                    <span class="c-form__group">
                        <label for="include_1">Include Journal Articles:</label> <input type="checkbox" name="include_1" id="include_1" checked filterable_exclude_container="[data-pub-type]" filterable_exclude_match="^(Journal Article)$"><br>
                    </span>
                    <span class="c-form__group">
                        <label for="include_2">Include Reports / Other:</label> <input type="checkbox" name="include_2" id="include_2" checked filterable_exclude_container="[data-pub-type]" filterable_exclude_match="^((?!Journal Article).)*$">
                    </span>
                </div>
            </fieldset>
        </form>
    </script>
    <script type="text/template" filterable_empty_list_template>
        <p filterable_empty_list_message hidden>No matches found.</p>
    </script>

    <?php $i = 0; foreach($this->all as $year => $data): ?>
    <?php if(!empty($data['publications'])): ?>
    <h2 id="year_<?php echo $year; ?>"><?php echo $year; ?></h2>
    <ul filterable_list>
        <?php foreach($data['publications'] as $publication): ?>
        <li class="l-box--space--block-end" filterable_item>
            <?php if(!$this->is_filtered): ?>
            <span filterable_index filterable_index_name="title">
                <?php if (!empty($publication['url'])) : ?>
                <a href="<?php echo $publication['url']; ?>" rel="external">
                <?php endif; ?>
                <?php echo $this->escape($publication['full_entry']); ?>
                <?php if (!empty($publication['url'])) : ?>
                </a>
                <?php endif; ?>
            </span>
            <?php else: ?>
            <?php echo preg_replace('/(' . preg_quote(JRequest::getString('keywords')) . ')/i', '<mark><b>$1</b></mark>', $publication['full_entry']); ?>
            <?php endif; ?>
            <br>[<span data-pub-type><?php echo $publication['type']; ?></span>]
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <?php $i++; ?>
    <?php endforeach; ?>
</div>
<?php endif; ?>