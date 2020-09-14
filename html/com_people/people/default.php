<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_people
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

$application_env = $_SERVER['SERVER_NAME'] == 'dev.npeu.ox.ac.uk' ? 'development' : ($_SERVER['SERVER_NAME'] == 'test.npeu.ox.ac.uk' ? 'testing' : 'production');
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

unset($this->people['*']);
?>
<div class="l-blockrow">
    <div class="d-bands--bottom  t-npeu">

        <div class="l-col-to-row">
            <div class="ff-width-100--40--50">
                <div class="c-panel  u-padding--sides--l  t-white  u-space--none  u-fill-height">
                    <div class="c-longform-content  c-user-content">
                        <?php echo JHtml::_('content.prepare', '{loadposition people_intro}'); ?>
                    </div>
                </div>
            </div>

            <div class="ff-width-100--40--50">
                <?php echo JHtml::_('content.prepare', '{loadposition people_image}'); ?>
            </div>
        </div>

    </div>
</div>

<?php $director = $this->people['Director']['people'][0]; unset($this->people['Director']); ?>
<div class="l-blockrow">
    <div class="d-bands--bottom  t-npeu">
        <div class="c-panel  c-panel--dark  t-npeu  u-space--none  u-fill-height  u-padding--top--none">

            <div id="group-director" class="">

                <article class="c-glimpse  c-glimpse--large-image  u-space--below--none">
                    <a href="https://www.npeu.ox.ac.uk/about/people/<?php echo $director['alias']; ?>" class="c-glimpse__link">
                        <div class="c-glimpse__image  c-glimpse__image--rounded">
                            <div class="l-proportional-container  l-proportional-container--1-1">
                                <div class="l-proportional-container__content">
                                    <div class="u-image-cover  js-image-cover">
                                        <div class="u-image-cover__inner">
                                            <img src="<?php echo $director['profile_img_src']; echo strpos($director['profile_img_src'], '?') === false ? '?' : '&'; ?>s=340" alt="" width="170px" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="c-glimpse__content">
                            <h2 class="c-glimpse__heading"><?php echo $director['name']; ?></h2>
                            <p><?php echo $director['role']; ?></p>
                        </div>
                    </a>
                </article>

            </div>

        </div>
    </div>
</div>
<?php
if (!is_array($this->people) || empty($this->people)) {
    return;
}
?>
<div class="l-blockrow">
    <div class="c-panel  u-padding--sides--l">
        <div filterable_group>
            <script type="text/template" filterable_form_template>
                <form class="tool-form">
                    <div class="tool-form__fieldset">
                        <label for="filter_staff_list">Filter staff list:</label> <input id="filter_staff_list" filterable_input>
                    </div>
                    <div class="tool-form__fieldset">
                        <span class="tool-form__group  u-space--right">
                            <label for="filter_choice_firstname">Filter by first name:</label> <input type="radio" name="filter_choice" id="filter_choice_firstname" filterable_toggle="first_name">
                        </span>
                        <span class="tool-form__group  u-space--right">
                            <label for="filter_choice_lastname">Filter by last name:</label> <input type="radio" name="filter_choice" id="filter_choice_lastname" filterable_toggle="last_name">
                        </span>
                        <span class="tool-form__group">
                            <label for="filter_choice_all">Filter both:</label> <input type="radio" name="filter_choice" id="filter_choice_all" filterable_toggle="" checked>
                        </span>
                    </div>
                </form>
            </script>
            <script type="text/template" filterable_empty_list_template>
                <p filterable_empty_list_message hidden>No matches found.</p>
            </script>


            <?php $i = 0; foreach($this->people as $group_heading => $data): ?>
            <?php $html_id = trim(str_replace(' ', '-', preg_replace("/[^a-zA-Z0-9]/", '-', $group_heading))); ?>
            <?php if($data['length'] > 0): ?>
            <div id="group-<?php echo $data['alias']; ?>" class="u-space--below">
                <h2 class="" id="<?php echo $html_id; ?>"><?php echo $group_heading; ?></h2>
                <ul id="people-<?php echo $data['alias']; ?>" class="l-gallery-grid  l-gallery-grid--gutter--s  l-gallery-grid--basis-15" filterable_list>

                    <?php foreach($data['people'] as $person): ?>
                    <li filterable_item>
                        <article class="c-glimpse  u-space--none">
                            <a href="/about/people/<?php echo $person['alias']; ?>" aria-describedby="<?php echo $html_id; ?>" class="c-glimpse__link">
                                <div class="c-glimpse__image  c-glimpse__image--rounded">
                                    <div class="l-proportional-container  l-proportional-container--1-1">
                                        <div class="l-proportional-container__content">
                                            <div class="u-image-cover  js-image-cover">
                                                <div class="u-image-cover__inner">
                                                    <img src="<?php echo $person['profile_img_src']; echo strpos($person['profile_img_src'], '?') === false ? '?' : '&'; ?>s=140" alt="" width="70px" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="c-glimpse__content">
                                    <h3 class="c-glimpse__heading"><span filterable_index filterable_index_name="first_name"><?php echo $person['firstname']; ?></span></span> <span filterable_index filterable_index_name="last_name"><?php echo $person['lastname']; ?></span></h3>
                                    <?php if(!empty($person['role'])): ?>
                                    <p><?php echo $person['role']; ?></p>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </article>
                    </li>
                    <?php endforeach; ?>

                </ul>
            </div>
            <?php endif; ?>
            <?php $i++; endforeach; ?>
        </div>
    </div>
</div>

