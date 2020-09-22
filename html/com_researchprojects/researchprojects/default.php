<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_researchprojects
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

$template_path = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname(dirname(dirname(__DIR__))));

$table_id = 'researchprojectsTable';
// If you need specific JS/CSS for this view, add them here.
// Example included for DataTables (https://datatables.net/) delete if you don't want this.
// Make sure jQuery is loaded first:
#JHtml::_('jquery.framework');
#JHtml::_('bootstrap.framework');
// Get the doc object:
$doc = JFactory::getDocument();

$doc->addScript($template_path . '/js/filter.min.js');

/*
// Add a script tag with a src:
$doc->addScript("//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js");
#$doc->addScript("//cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js");
// Add a CSS link tag:
$doc->addStyleSheet('//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css');
#$doc->addStyleSheet('//cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css');
// Add a script tag with content:
$js = '
jQuery(document).ready(function(){
    jQuery("#' . $table_id . '").DataTable();
});
';
$doc->addScriptDeclaration($js);
*/

function format_person($p) {
    $pp = ResearchProjectsHelper::parseCollaborator($p);
    return $pp['first_name'] . ' ' . $pp['last_name'] . (empty($pp['institution']) ? '' : ' (' . $pp['institution'] .')');
}

?>
<?php if (!empty($this->topics)) :
ob_start(); ?>
<div class="c-panel">
    <div class="c-panel__module">
        <h2>Research Topics</h2>
        <ul class="u-list--plain">
            <?php foreach ($this->topics as $topic) : ?>
            <li><a href="<?php echo JRoute::_('index.php?option=com_researchprojects') . '/' . $topic->alias; ?>"><?php echo $topic->title; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<div class="c-panel  c-panel--dark  t-npeu">
    <div class="c-panel__module">
        <h2>Suggest a Topic</h2>
        <p>If you'd like to suggest a new topic for us to consider, please email <a href="mailto:general@npeu.ox.ac.uk">general@npeu.ox.ac.uk</a></p>
    </div>
</div>
<?php
$doc->component__sidebar_bottom = ob_get_contents();
ob_end_clean();
endif; ?>

<?php if (!empty($this->items)) : ?>
<div filterable_group filterable_mark_results>
    <script type="text/template" filterable_form_template>
        <form class="c-tool-form  c-panel  d-bands  u-space--below">
            <label for="filter">Filter projects:</label>
            <span class="c-composite">
                 <input id="filter" filterable_input> <button filterable_submit>Filter</button>
            </span>
            <a class="c-cta" href="/research/projects">Clear</a>
            <fieldset class="c-tool-form__fieldset">
                <legend>Filter by:</legend>
                <span class="c-tool-form__group">
                    <label for="filter_title">Title:</label> <input type="radio" name="filter_choice" id="filter_title" filterable_toggle="title">
                </span>
                <span class="c-tool-form__group">
                    <label for="filter_lead">Lead:</label> <input type="radio" name="filter_choice" id="filter_lead" filterable_toggle="lead">
                </span>
                <span class="c-tool-form__group">
                    <label for="filter_all">Both:</label> <input type="radio" name="filter_choice" id="filter_all" filterable_toggle checked>
                </span>
            </fieldset>
        </form>
    </script>
    <script type="text/template" filterable_empty_list_template>
        <p filterable_empty_list_message hidden>No matches found.</p>
    </script>
    <ul class="u-list--plain  u-fill-width">
    <?php foreach ($this->items as $i => $row) :
        #$view_link = JRoute::_('index.php?option=com_researchprojects&task=researchproject.view&id=' . $row->id);
        $view_link = JRoute::_('index.php?option=com_researchprojects&task=researchproject.view');
        $view_link .= '/' . $row->id . '-' . $row->alias;
    ?>
        <li class="u-space--below" filterable_item>
            <div class="c-card  c-card--light  t-white">
                <a href="<?php echo $view_link; ?>" class="c-card__full-link  u-fill-height--column">
                    <div class="c-card__main">
                        <h2 class="c-card__title" filterable_index filterable_index_name="title"><?php echo $row->title; ?></h2>
                        <div class="c-card__body">
                            <p><?php $has_pi_2 = !empty($row->pi_2); ?>
                                <span>Lead<?php echo ($has_pi_2 ? 's' : '') ?>: <span filterable_index filterable_index_name="lead"><?php echo format_person($row->pi_1); ?><?php if ($has_pi_2) : ?> and <?php echo format_person($row->pi_2); ?><?php endif; ?></span></span><br>
                                <span>Topics: <?php echo implode(", ", $row->topics); ?><span>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </li>
    <?php endforeach; ?>
    </ul>
</div>
<?php else: ?>
<p>There are currently no project with this topic.</p>
<?php endif; ?>
