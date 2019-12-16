<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_publications
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

// No direct access
defined('_JEXEC') or die;

$template_path = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname(dirname(dirname(__DIR__))));

$doc = JFactory::getDocument();
$doc->addScript($template_path . '/js/filter.min.js');

unset($this->all['*']);

ob_start(); ?>
<div class="c-panel  c-panel--white  c-panel--framed">
    <div class="c-panel__module">

        <form class="control-form" id="pubsForm" name="pubsForm" method="get" action="/research/publications">
            <fieldset>
                    <label class="" for="filter_keywords" id="filter_keywords-lbl">Search publications</label>
                    <span class="c-composite">
                        <input type="text" value="<?php echo isset($_GET['keywords']) ? htmlspecialchars($_GET['keywords']) : ''; ?>" id="filter_keywords" name="keywords">
                        <button type="submit" class="btn">Search</button>
                        <a class="c-cta" href="/research/publications">Clear</a>
                    </span>
                </span>
            </fieldset>
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
<p>Found <strong><?php echo $this->publications_total; ?></strong> publications matching <em><?php echo $_GET['keywords']; ?></em></p>
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
        <form class="control-form">
            <fieldset>
                <div class="tool-form__fieldset">
                    <label for="filter_title" class="u-space--right">Filter publications by title:</label>
                    <span class="c-composite">
                         <input id="filter_title" filterable_input> <button filterable_submit>Filter</button>
                    </span>
                    <a class="c-cta" href="/research/publications">Clear</a>
                </div>
                <div class="tool-form__fieldset">
                    <label for="include_1">Include Journal Articles:</label> <input type="checkbox" name="include_1" id="include_1" checked filterable_exclude_container="[data-pub-type]" filterable_exclude_match="^(Journal Article)$"><br>
                    <label for="include_2">Include Reports / Other:</label> <input type="checkbox" name="include_2" id="include_2" checked filterable_exclude_container="[data-pub-type]" filterable_exclude_match="^((?!Journal Article).)*$">
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
        <li class="u-space--below--s" filterable_item>
            <?php if(!$this->is_filtered): ?>
            <span filterable_index filterable_index_name="title"><?php echo $this->escape($publication['full_entry']); ?></span>
            <?php else: ?>
            <?php echo preg_replace('/(' . preg_quote(JRequest::getString('keywords')) . ')/i', '<mark><b>$1</b></mark>', $publication['full_entry']); ?>
            <?php endif; ?>
            <?php if (!empty($publication['url'])) : ?>
            <br><a href="<?php echo $publication['url']; ?>">Link to the publication or abstract</a>
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