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

$doc = Factory::getDocument();

// Set page title
#$page_title = $this->item->title;

$skip = array(
    'id',
    'alias',
    'title',
    'owner_user_id',
    'content',
    'brand_id',
    'state'
);

function format_person($p) {
    $pp = ResearchProjectsHelper::parseCollaborator($p);
    return $pp['first_name'] . ' ' . $pp['last_name'] . (empty($pp['institution']) ? '' : ' (' . $pp['institution'] .')');
}

#echo 'here<pre>'; var_dump((array) $this->item->funders); echo '</pre>'; exit;
#echo 'here<pre>'; var_dump(empty((array) $this->item->collaborators)); echo '</pre>'; exit;
$pi_s = empty($this->item->pi_2) ? '' : 's';
$fu_s = count(get_object_vars($this->item->funders)) > 1 ? 's' : '';

$brand = false;
if (!empty($this->item->brand_details)) {
    $brand = $this->item->brand_details;
}

// Construct the protocol (http|https):
$s                 = empty($_SERVER['SERVER_PORT']) ? '' : (($_SERVER['SERVER_PORT'] == '443') ? 's' : '');
$protocol          = preg_replace('#/.*#',  $s, strtolower($_SERVER['SERVER_PROTOCOL']));

// Construct the domain url:
$domain            = $protocol.'://'.$_SERVER['SERVER_NAME'];

// Construct the public root path: (note: this is the SERVER path, not a URL)
$public_root_path  = realpath($_SERVER['DOCUMENT_ROOT']) . DIRECTORY_SEPARATOR;

$brand = false;
if (!empty($this->item->brand_details)) {
    $brand = $this->item->brand_details;


    $image_path = $public_root_path . $brand->logo_png_path;
    $image_info = getimagesize(urldecode($image_path));

    $w = $image_info[0];
    $h = $image_info[1];
    $image_ratio = ($w < $h) ? ($w / $h) : ($h / $w);

    $image_height = 100;
    $image_width  = round($image_height / $image_ratio);
}
ob_start();
?>
<div>
    <?php if ($brand) : ?>
    <div class="l-box l-box--center  l-box--space--block">
        <a href="<?php echo $brand->alias; ?>" class="c-badge  c-badge--limit-height--xl">
            <img src="<?php echo $brand->logo_svg_path; ?>" onerror="<?php echo $brand->logo_png_path; ?>" alt="Logo: <?php echo $brand->name; ?>" height="<?php echo $image_height; ?>" width="<?php echo $image_width; ?>">
        </a>
    </div>
    <?php endif; ?>
    <dl>
        <dt>Principal investigator<?php echo $pi_s; ?></dt>
        <dd><?php echo format_person($this->item->pi_1) . (empty($this->item->pi_2) ? '' : ', ' . format_person($this->item->pi_2)); ?></dd>
        <?php if (!empty((array) $this->item->collaborators)) : ?>
        <dt>Collaborators</dt>
        <dd><?php
            $i = 0;
            $c = count((array) $this->item->collaborators) - 1;
            foreach($this->item->collaborators as $collaborator) {
                echo format_person($collaborator->collaborator) . ($i <  $c ? ', ' : '');
                $i++;
            }
        ?></dd>
        <?php endif; ?>
        <dt>Topics</dt>
        <dd><?php
            $i = 0;
            $topics = $this->item->topic_details;
            $c = count((array) $topics) - 1;
            foreach($topics as $topic) {
                echo $topic . ($i <  $c ? ', ' : '');
                $i++;
            }
        ?></dd>
        <?php if (!empty((array) $this->item->funders)) : ?>
        <dt>Funder<?php echo $fu_s; ?></dt>
        <dd><?php $i = 0;
            $c = count((array) $this->item->funders) - 1;
            foreach($this->item->funders as $funder) {
                echo $funder->funder . ($i <  $c ? ', ' : '');
                $i++;
            } ?></dd>
        <?php endif; ?>
        <dt>Start year</dt>
        <dd><?php echo $this->item->start_year; ?></dd>
        <dt>End year</dt>
        <dd><?php echo $this->item->end_year; ?></dd>
        <?php if (!empty($this->item->owner_details->name)) : ?>
        <dt>NPEU Contact</dt>
        <dd><?php echo $this->item->owner_details->name; ?></dd>
        <?php endif; ?>
    </dl>
</div>
<?php
$doc->component__sidebar_top = ob_get_contents();
ob_end_clean();
?>

<div class="longform-content  user-content">
    <h2>Summary</h2>
    <?php echo $this->item->content; ?>
    <?php if (!empty($this->item->publications)) : ?>
    <h2>Publications</h2>
    <?php echo $this->item->publications; ?>
    <?php endif; ?>
</div>
<?php /*
<p>
    <a href="<?php echo Route::_('index.php?option=com_researchprojects'); ?>">Back</a>
</p>
*/?>