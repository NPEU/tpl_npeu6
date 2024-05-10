<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_researchprojects
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;

use NPEU\Component\Researchprojects\Administrator\Helper\ResearchprojectsHelper;

defined('_JEXEC') or die;

$table_id = 'researchprojectsTable';
// If you need specific JS/CSS for this view, add them here.
// Example included for DataTables (https://datatables.net/) delete if you don't want this.
// Make sure jQuery is loaded first:

// Get the doc object:
$doc = Factory::getDocument();
$template_path = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname(dirname(dirname(__DIR__))));
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
        <div class="l-layout">
            <ul class="l-layout__inner">
                <?php foreach ($this->topics as $topic) : ?>
                <li class="l-box"><a href="<?php echo Route::_('index.php?option=com_researchprojects') . '/' . $topic->alias; ?>"><?php echo $topic->title; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<div class="c-panel  d-background--dark">
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
        <form class="c-form  c-form--tool-form">
            <label for="filter">Filter projects:</label>
            <span class="c-form__composite">
                 <input id="filter" filterable_input> <button filterable_submit>Filter</button>
            </span>
            <input type="reset" value="Clear" filterable_reset>
            <fieldset class="c-form--tool-form__fieldset">
                <div>
                    <legend>Filter by:</legend>
                    <span class="c-form__group">
                        <label for="filter_title">Title:</label> <input type="radio" name="filter_choice" id="filter_title" filterable_toggle="title">
                    </span>
                    <span class="c-form__group">
                        <label for="filter_lead">Lead:</label> <input type="radio" name="filter_choice" id="filter_lead" filterable_toggle="lead">
                    </span>
                    <span class="c-form__group">
                        <label for="filter_all">Both:</label> <input type="radio" name="filter_choice" id="filter_all" filterable_toggle checked>
                    </span>
                </div>
            </fieldset>
        </form>
    </script>
    <script type="text/template" filterable_empty_list_template>
        <p filterable_empty_list_message hidden>No matches found.</p>
    </script>
    <div class="l-layout  l-gutter">
        <ul class="l-layout__inner" filterable_list>
        <?php foreach ($this->items as $i => $row) :
            #$view_link = Route::_('index.php?option=com_researchprojects&task=researchproject.view&id=' . $row->id);
            #$view_link = Route::_('index.php?option=com_researchprojects&task=researchproject.view');
            #$view_link .= '/' . $row->id . '-' . $row->alias;
            $view_link = Route::_('index.php?option=com_researchprojects&view=researchproject&id=' . $row->id . '-' . $row->alias);
        ?>
            <li class="l-box" filterable_item>
                <?php
                $card_data = array();

                $card_data['theme_classes']    = 'd-border  t-neutral'; //empty($theme) ? 'd-background' : $theme;

                $card_data['link']             = $view_link;
                $card_data['header_span_attr'] = 'filterable_index filterable_index_name="title"';
                $card_data['title']            = $row->title;


                $has_pi_2 = !empty($row->pi_2);
                $card_data['body']  = '<p>' . "\n";
                $card_data['body'] .= '    <span>Lead' . ($has_pi_2 ? 's' : '') . ': <span filterable_index filterable_index_name="lead">' . format_person($row->pi_1) . ($has_pi_2 ? ' and ' . format_person($row->pi_2) : '') . '</span></span><br>' . "\n";
                $card_data['body'] .= '    <span>Topics: ' . implode(", ", $row->topics) . '<span>' . "\n";
                $card_data['body'] .= '</p>' . "\n";

                include(dirname(dirname(dirname(__DIR__))) . '/layouts/partial-card.php');
                ?>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php else: ?>
<p>There are currently no project with this topic.</p>
<?php endif; ?>
