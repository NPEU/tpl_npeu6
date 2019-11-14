<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_researchprojects
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

$table_id = 'researchprojectsTable';
// If you need specific JS/CSS for this view, add them here.
// Example included for DataTables (https://datatables.net/) delete if you don't want this.
// Make sure jQuery is loaded first:
#JHtml::_('jquery.framework');
#JHtml::_('bootstrap.framework');
// Get the doc object:
$doc = JFactory::getDocument();

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
<div class="u-space">
    <h2>Research Topics</h2>
    <ul class="u-list--plain">
        <?php foreach ($this->topics as $topic) : ?>
        <li><a href="<?php echo JRoute::_('index.php?option=com_researchprojects') . '/' . $topic->alias; ?>"><?php echo $topic->title; ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php
$doc->component__sidebar_bottom = ob_get_contents();
ob_end_clean();
endif; ?>

<?php if (!empty($this->items)) : ?>
<div filterable_group>
    <script type="text/template" filterable_form_template>
        <form class="tool-form  u-space--below">
            <div class="tool-form__fieldset">
                <label for="filter_title" class="u-space--right">Filter projects by title:</label> <input id="filter_title" filterable_input>
            </div>
        </form>
    </script>
    <script type="text/template" filterable_empty_list_template>
        <p filterable_empty_list_message hidden>No matches found.</p>
    </script>
    <ul class="u-list--plain">
    <?php foreach ($this->items as $i => $row) :
        #$view_link = JRoute::_('index.php?option=com_researchprojects&task=researchproject.view&id=' . $row->id);
        $view_link = JRoute::_('index.php?option=com_researchprojects&task=researchproject.view');
        $view_link .= '/' . $row->id . '-' . $row->alias;
    ?>
        <li class="u-space--below" filterable_item>
            <div class="c-card-wrap">
                <div class="c-card  c-card--light  t-white">
                    <a href="<?php echo $view_link; ?>" class="c-card__full-link  u-fill-height--column">
                        <div class="c-card__main">
                            <h2 class="c-card__title" filterable_index filterable_index_name="title"><?php echo $row->title; ?></h2>
                            <div class="c-card__body">
                                <p><?php $has_pi_2 = !empty($row->pi_2); ?>
                                    <span>Lead<?php echo ($has_pi_2 ? 's' : '') ?>: <?php echo format_person($row->pi_1); ?><?php if ($has_pi_2) : ?> and <?php echo format_person($row->pi_2); ?><?php endif; ?><span><br>
                                    <span>Topics: <?php echo implode(", ", $row->topics); ?><span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>