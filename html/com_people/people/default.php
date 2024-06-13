<?php
/**
 * @package        Joomla.Site
 * @subpackage    com_people
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

$application_env = $_SERVER['SERVER_NAME'] == 'dev.npeu.ox.ac.uk' ? 'development' : ($_SERVER['SERVER_NAME'] == 'test.npeu.ox.ac.uk' ? 'testing' : 'production');
HTMLHelper::addIncludePath(JPATH_COMPONENT . '/helpers');

// Get the doc object:
$doc = Factory::getDocument();
$template_path = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname(dirname(dirname(__DIR__))));
$doc->addScript($template_path . '/js/filter.min.js');

unset($this->people['*']);

function get_person_image_info($img_url) {
    #echo '<p datathing>' . $img_url . '</p>';
    return ['src'=>$img_url,'w'=>200, 'h'=>'200'];
    $r = [
        'src' => $img_url
    ];
    $public_root_path = realpath($_SERVER['DOCUMENT_ROOT']) . DIRECTORY_SEPARATOR;
    $image_path       = $public_root_path . $img_url;
    $image_info       = getimagesize(urldecode($image_path));
    $image_real_ratio = $image_info[0] / $image_info[1];
    $r['w'] = '200';
    $r['h'] = round($r['w'] / $image_real_ratio);

    return $r;
}

function person_img_size($img_url, $size) {
    return $img_url . (strpos($img_url, '?') === false ? '?' : '&') . 's=' . $size;
}
?>

<div class="d-border--bottom--thick  d-background--white">

    <div class="l-layout  l-row">
        <div class="l-layout__inner">

            <div class="l-box  ff-width-100--70--50  l-box--space--block-end--l">
                <?php echo HTMLHelper::_('content.prepare', '{loadposition people_intro}'); ?>
            </div>

            <div class="l-box  ff-width-100--40--50">
                <?php echo HTMLHelper::_('content.prepare', '{loadposition people_image}'); ?>
            </div>
        </div>
    </div>

</div>

<?php $director = $this->people['Director']['people'][0]; unset($this->people['Director']); ?>

<div class="d-border--bottom--thick">
    <div class="c-panel  d-background--dark  l-box--space--inline--l">

        <div id="group-director" class="">

            <article class="c-glimpse  js-c-glimpse c-glimpse--image-round  c-glimpse--image-large  d-border  d-border--light  d-background">
                <div data-fs-block="border">
                    <h3 class="c-glimpse__title"><a href="https://www.npeu.ox.ac.uk/about/people/<?php echo $director['alias']; ?>"><span><?php echo $director['name']; ?></span></a></h3>

                    <div class="c-glimpse__image  d-border  d-border--dark">
                        <div class="u-image-cover  js-image-cover  u-image-cover--min-100">
                            <div class="u-image-cover__inner">
                                <?php
                                $img_info = get_person_image_info($director['profile_img_src']);
                                ?>
                                <img src="<?php echo $img_info['src']; ?>" sizes="100vw" srcset="<?php echo person_img_size($img_info['src'], 1600); ?> 1600w, <?php echo person_img_size($img_info['src'], 900); ?> 900w, <?php echo person_img_size($img_info['src'], 300); ?> 300w" alt="Portrait of <?php echo $director['name']; ?>" class="u-image-cover__image" width="<?php echo $img_info['w']; ?>" height="<?php echo $img_info['h']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="c-glimpse__body">
                        <p><?php echo $director['role']; ?></p>
                    </div>

                </div>
            </article>

        </div>

    </div>
</div>

<?php
if (!is_array($this->people) || empty($this->people)) {
    return;
}

$people = [];

foreach ($this->people as $group_heading => $data) {
    if ($data['length'] > 0) {
        $people[$group_heading] = $data;
    }
}
$l = count($people);
?>
<div class="c-panel  l-box--space--inline--l  d-background--white">
    <div filterable_group>
        <script type="text/template" filterable_form_template>
            <form class="c-form  c-form--tool-form">
                <label for="filter_staff_list">Filter staff list:</label>
                <span class="c-form__composite">
                    <input id="filter_staff_list" filterable_input> <button filterable_submit>Filter</button>
                </span>
                <input type="reset" value="Clear" filterable_reset>
                <fieldset class="c-form--tool-form__fieldset">
                    <div>
                        <legend>Filter by:</legend>
                        <span class="c-form__group">
                            <label for="filter_choice_firstname">First name:</label> <input type="radio" name="filter_choice" id="filter_choice_firstname" filterable_toggle="firstname">
                        </span>
                        <span class="c-form__group">
                            <label for="filter_choice_lastname">Last name:</label> <input type="radio" name="filter_choice" id="filter_choice_lastname" filterable_toggle="lastname">
                        </span>
                        <span class="tool-form__group">
                            <label for="filter_choice_all">Both:</label> <input type="radio" name="filter_choice" id="filter_choice_all" filterable_toggle="" checked>
                        </span>
                    </div>
                </fieldset>
            </form>
        </script>
        <script type="text/template" filterable_empty_list_template>
            <p filterable_empty_list_message hidden>No matches found.</p>
        </script>


        <?php $i = 1; foreach($people as $group_heading => $data): ?>
        <?php $html_id = trim(str_replace(' ', '-', preg_replace("/[^a-zA-Z0-9]/", '-', $group_heading))); ?>
        <div id="group-<?php echo $data['alias']; ?>">
            <h2 id="<?php echo $html_id; ?>"><?php echo $group_heading; ?></h2>
            <div class="l-layout  l-gallery-grid  l-gallery-grid--gutter--m  l-gallery-grid--basis-15">
                <ul id="people-<?php echo $data['alias']; ?>" class="l-layout__inner" filterable_list>

                    <?php foreach($data['people'] as $person): ?>
                    <li class="l-box  l-box--space--block" filterable_item>
                        <article class="c-glimpse  js-c-glimpse c-glimpse--image-round  d-border  t-neutral">
                            <div data-fs-block="border">
                            <h3 class="c-glimpse__title"><a href="https://www.npeu.ox.ac.uk/about/people/<?php echo $person['alias']; ?>"><span filterable_index filterable_index_name="firstname"><?php echo $person['firstname']; ?></span> <span filterable_index filterable_index_name="lastname"><?php echo $person['lastname']; ?></span></a></h3>

                                <div class="c-glimpse__image  d-border  t-neutral">
                                    <div class="u-image-cover  js-image-cover  u-image-cover--min-100">
                                        <div class="u-image-cover__inner">
                                            <?php
                                            $img_info = get_person_image_info($person['profile_img_src']);
                                            ?>
                                            <img src="<?php echo $img_info['src']; ?>" sizes="100vw" srcset="<?php echo person_img_size($img_info['src'], 1600); ?> 1600w, <?php echo person_img_size($img_info['src'], 900); ?> 900w, <?php echo person_img_size($img_info['src'], 300); ?> 300w" alt="Portrait of <?php echo $person['name']; ?>" class="u-image-cover__image" width="<?php echo $img_info['w']; ?>" height="<?php echo $img_info['h']; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="c-glimpse__body">
                                    <p><?php echo $person['role']; ?></p>
                                </div>

                            </div>
                        </article>
                    </li>
                    <?php endforeach; ?>

                </ul>
            </div>
        </div>
        <?php $i++; endforeach; ?>
    </div>
</div>

