<?php
if (!empty($_SERVER['JTV2'])) {
    include(str_replace('.php', '.v2.php', __FILE__));
    return;
}
?><?php
/**
 * @package     Joomla.Site
 * @subpackage  com_researchprojects
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;
require_once JPATH_ROOT . '/administrator/components/com_researchprojects/helpers/researchprojects.php';
$doc = JFactory::getDocument();

// Set page title
$page_title = $this->item->title;

$skip = array(
    'id',
    'alias',
    'title',
    'owner_user_id',
    'content',
    'brand_id',
    'state'
);

if (!function_exists('format_person')) {
    function format_person($p) {
        $pp = ResearchProjectsHelper::parseCollaborator($p);
        return $pp['first_name'] . ' ' . $pp['last_name'] . (empty($pp['institution']) ? '' : ' (' . $pp['institution'] .')');
    }
}


$pi_s = empty($this->item->pi_2) ? '' : 's';
$fu_s = count($this->item->funders) > 1 ? 's' : '';

$brand = false;
if (!empty($this->item->brand_details)) {
    $brand = $this->item->brand_details;
}
#echo '<pre>'; var_dump($this->item); echo '</pre>'; exit;

ob_start();
?>
<div class="u-space">
    <?php if ($brand) : ?>
    <div class="u-space--below">
        <a href="<?php echo $this->item->brand_details->alias; ?>" class="c-badge"><img src="<?php echo $this->item->brand_details->logo_svg_path; ?>" onerror="this.src='<?php echo $this->item->brand_details->logo_png_path; ?>'; this.onerror=null;" alt="Logo: <?php echo $this->item->brand_details->name; ?>" height="80"></a>
    </div>
    <?php endif; ?>
    <dl>
        <dt>Principal investigator<?php echo $pi_s; ?></dt>
        <dd><?php echo format_person($this->item->pi_1) . (empty($this->item->pi_2) ? '' : ', ' . format_person($this->item->pi_2)); ?></dd>
        <?php if (!empty($this->item->collaborators)) : ?>
        <dt>Collaborators</dt>
        <dd><?php
            $i = 0;
            $c = count($this->item->collaborators) - 1;
            foreach($this->item->collaborators as $collaborator) {
                echo format_person($collaborator['collaborator']) . ($i <  $c ? ', ' : '');
                $i++;
            }
        ?></dd>
        <?php endif; ?>
        <dt>Topics</dt>
        <dd><?php
            $i = 0;
            $topics = $this->item->topic_details;
            $c = count($topics) - 1;
            foreach($topics as $topic) {
                echo $topic . ($i <  $c ? ', ' : '');
                $i++;
            }
        ?></dd>
        <?php if (!empty($this->item->funders)) : ?>
        <dt>Funder<?php echo $fu_s; ?></dt>
        <dd><?php $i = 0;
            $c = count($this->item->funders) - 1;
            foreach($this->item->funders as $funder) {
                echo $funder['funder'] . ($i <  $c ? ', ' : '');
                $i++;
            } ?></dd>
        <?php endif; ?>
        <dt>Start year</dt>
        <dd><?php echo $this->item->start_year; ?></dd>
        <dt>End year</dt>
        <dd><?php echo $this->item->end_year; ?></dd>
        <dt>NPEU Contact</dt>
        <dd><?php echo $this->item->owner_details->name; ?></dd>
    </dl>
</div>
<?php
$doc->component__sidebar_top = ob_get_contents();
ob_end_clean();
?>

<div class="c-user-content  u-space--below">
    <h2>Summary</h2>
    <?php echo $this->item->content; ?>
    <?php if (!empty($this->item->publications)) : ?>
    <h2>Publications</h2>
    <?php echo $this->item->publications; ?>
    <?php endif; ?>
</div>
<p>
    <a href="<?php echo JRoute::_('index.php?option=com_researchprojects'); ?>">Back</a>
</p>