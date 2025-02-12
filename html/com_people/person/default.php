<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_people
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use NPEU\Template\Npeu6\Site\Helper\Npeu6Helper as TplNPEU6Helper;

$person = $this->person;

if (isset($person['pa']) && (isset($person['pa_details_only']) && $person['pa_details_only'] == 'Yes')) {
    unset($person['email']);
}

function get_team($team) {
?>
        <section class="person__team">
            <h2>Team</h2>
            <div class="l-layout  l-gallery-grid  l-gallery-grid--gutter--s  l-gallery-grid--basis-15">
                <ul id="people-senior-staff" class="l-layout__inner">
                    <?php foreach($team as $id => $member): ?>
                    <li class="l-box  l-box--space--block">
                        <article class="c-glimpse js-c-glimpse c-glimpse--image-round d-border t-neutral c-glimpse--has-js">
                            <div data-fs-block="border">
                                <h3 class="c-glimpse__title"><a href="/about/people/<?php echo $member['alias']; ?>"><span><?php echo $member['firstname']; ?> <?php echo $member['lastname']; ?></span></a></h3>

                                <div class="c-glimpse__image  d-border  t-neutral">
                                    <div class="u-image-cover  js-image-cover  u-image-cover--min-100">
                                        <div class="u-image-cover__inner">
                                            <img src="<?php echo $member['profile_img_src']; echo strpos($member['profile_img_src'], '?') === false ? '?' : '&'; ?>s=300" sizes="100vw" srcset="<?php echo $member['profile_img_src']; echo strpos($member['profile_img_src'], '?') === false ? '?' : '&'; ?>s=1600 1600w, <?php echo $member['profile_img_src']; echo strpos($member['profile_img_src'], '?') === false ? '?' : '&'; ?>s=900 900w, <?php echo $member['profile_img_src']; echo strpos($member['profile_img_src'], '?') === false ? '?' : '&'; ?>s=300 300w" alt="Portrait of <?php echo $member['firstname']; ?> <?php echo $member['lastname']; ?>" class="u-image-cover__image" width="200" height="200">
                                        </div>
                                    </div>
                                </div>

                                <div class="c-glimpse__body">
                                    <?php if(!empty($member['role'])): ?>
                                    <p><?php echo $member['role']; ?></p>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </article>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
<?php
}

function get_projects($projects) {
?>
        <section class="person__projects">
            <h2>Projects</h2>
            <?php /*<div class="l-layout  l-gutter  l-distribute  l-distribute--balance-top  l--basis-20">*/ ?>
            <div class="l-layout  l-gallery-grid  l-gallery-grid--gutter--s  l-gallery-grid--basis-15">
                <p class="l-layout__inner" role="list">
                    <?php foreach($projects as $brand_id):
                        $brand = TplNPEU6Helper::get_brand($brand_id);
                        #echo '<pre>'; var_dump($brand); echo '</pre>'; exit;

                        //$svg_path = '/assets/images/brand-logos/unit/' . $project['alias'] . '-logo.svg';
                        //$png_path = '/assets/images/brand-logos/unit/' . $project['alias'] . '-logo.png';

                        $svg_path = $brand->logo_svg_path;
                        $png_path = $brand->logo_png_path;
                        $svg_info = TplNPEU6Helper::svg_info($svg_path);
                        $colour    = $brand->primary_colour;
                    ?>
                    <span class="l-box  l-box--center" role="listitem">
                        <a href="/<?php echo $brand->alias; ?>" class="c-badge  c-badge--decorated  c-badge--limit-height--xl  u-block-center" style="color: <?php echo $colour; ?>;">
                            <img src="<?php echo $svg_path; ?>" onerror="this.src='<?php echo $png_path; ?>'; this.onerror=null;" alt="<?php echo $svg_info['title']; ?>" <?php echo $svg_info['dimensions']; ?>>
                        </a>
                    </span>

                    <?php endforeach; ?>
                </p>
            </div>
        </section>
<?php
}

function get_custom($custom_title, $custom) {
?>
        <section class="person__custom">
            <h2><?php echo $custom_title; ?></h2>
            <?php echo $custom; ?>
        </section>
<?php
}
?>

<div class="l-primary-content  l-primary-content--has-pull-outs  d-background--white">


    <div class="l-primary-content__header">

        <div class="c-panel">
            <header class="c-panel__header">
                <h1 id="<?php echo TplNPEU6Helper::html_id($person['name']); ?>"><?php if(!empty($person['title'])): ?><?php echo $person['title']; ?> <?php endif; ?><?php echo $person['name']; ?><?php if(!empty($person['qualifications'])): ?> <small><?php echo $person['qualifications']; ?></small><?php endif; ?></h1>
            </header>
            <?php if(!empty($person['role']) || !empty($person['email'])): ?>
            <div class="l-layout  l-row  l-row--start  l-gutter--s  l-flush-edge-gutter">
                <p class="l-layout__inner">
                    <?php if(!empty($person['role'])): ?>
                    <span class="l-box">
                        <b><?php echo $person['role']; ?></b>
                    </span>
                    <?php endif; ?>
                    <?php if(!empty($person['email'])): ?>
                    <span class="l-box">
                        <a href="mailto:<?php echo $person['email']; ?>"><?php echo $person['email']; ?></a>
                    </span>
                    <?php endif; ?>
                </p>
            </div>
            <?php endif; ?>
            <?php if(!empty($person['pa_details'])): ?>
            <div class="l-layout  l-row  l-row--start  l-gutter--s  l-flush-edge-gutter">
                <p class="l-layout__inner">
                    <span class="l-box">
                    <b>PA:</b> <?php echo $person['pa_details']['name']; ?>
                    </span>
                    <?php if(!empty($person['pa_details']['email'])): ?>
                    <span class="l-box">
                        <a href="mailto:<?php echo $person['pa_details']['email']; ?>"><?php echo $person['pa_details']['email']; ?></a>
                    </span>
                    <?php endif; ?>
                </p>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php /*if (!true) : ?>
    <div class="l-primary-content__pull-out  l-primary-content__pull-out--super  u-space--above  c-user-content">
        <div class="l-primary-content__pull-out__padded--@small">
            <div aria-hidden="true" class="" data-display-is="width-one-quarter  pulled-left">
                <span data-contains="image portrait">
                    <b>
                        <img src="<?php echo $person['profile_img_src']; echo strpos($person['profile_img_src'], '?') === false ? '?' : '&'; ?>s=200" alt="Portrait of <?php echo $person['name']; ?>" width="180" />
                    </b>
                </span>
            </div>
        </div>
    </div>
    <?php endif;*/ ?>

    <?php #if (!true) : ?>
    <div class="l-primary-content__pull-out  l-primary-content__pull-out--top  has-longform-content">
        <div class="longform-content  user-content  l-box--space--block-start">
            <div aria-hidden="true">
                <span data-contains="image portrait">
                    <b>
                        <img alt="Portrait of <?php echo $person['name']; ?>" sizes="100vw" src="<?php echo $person['profile_img_src']; echo strpos($person['profile_img_src'], '?') === false ? '?' : '&'; ?>s=500" srcset="<?php echo $person['profile_img_src']; echo strpos($person['profile_img_src'], '?') === false ? '?' : '&'; ?>s=700 700w, <?php echo $person['profile_img_src']; echo strpos($person['profile_img_src'], '?') === false ? '?' : '&'; ?>s=300 300w" width="300">
                    </b>
                </span>
            </div>
        </div>
    </div>
    <?php #endif; ?>

    <div class="l-primary-content__main  has-longform-content">

        <?php if(!empty($person['biography'])): ?>
        <section class="l-box--space--edge  d-background--very-light  t-neutral">
            <div class="longform-content user-content">
                <h2>Biography</h2>
                <?php echo $person['biography']; ?>
            </div>
        </section>
        <?php endif; ?>

        <?php if(!empty($person['custom_title']) && !empty($person['custom']) && $person['custom_placement'] == "Main area"): ?>
        <div class="user-content">
        <?php echo get_custom($person['custom_title'], $person['custom']); ?>
        </div>
        <?php endif; ?>

        <?php if(!empty($person['publications_data']) || !empty(trim($person['publications_manual']))): ?>
        <section class="longform-content  user-content">
            <h2>Publications</h2>
            <?php if(!empty($person['publications_data'])): /* Publications data present */?>
            <?php if(isset($person['publications_data'][0])): /* Publications as single list */?>
            <ul>
            <?php foreach($person['publications_data'] as $publication): ?>
                <li class="u-word-wrap">
                <?php echo $this->escape($publication['full_entry']); ?>
                <?php if (!empty($publication['url'])) : ?><br><a href="<?php echo $publication['url']; ?>"><?php echo $publication['url']; ?></a><?php endif; ?>
                </li>
            <?php endforeach; ?>
            </ul>
            <?php else: /* Publications collected */ ?>
            <?php foreach($person['publications_data'] as $heading=>$collection): ?>
            <?php if (!empty($collection['publications'])): ?>
            <section>
                <h3><?php echo is_numeric($heading) ? $heading : $heading . 's'; ?></h3>
                <ul>
                    <?php foreach($collection['publications'] as $publication): ?>
                    <li class="u-word-wrap">
                    <?php echo $this->escape($publication['full_entry']); ?>
                    <?php if (!empty($publication['url'])) : ?><br><a href="<?php echo $publication['url']; ?>"><?php echo $publication['url']; ?></a><?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </section>
            <?php endif; ?>
            <?php endforeach; ?>
            <?php endif; ?>
            <?php endif; ?>

            <?php if(!empty(trim($person['publications_manual']))): ?>
            <?php echo $person['publications_manual']; ?>
            <?php endif; ?>
        </section>
        <?php endif; ?>


        <?php if(!empty($person['team']) && $person['team_placement'] == "Main area"): ?>
        <div class="l-box--space--inline">
            <?php echo get_team($person['team']); ?>
        </div>
        <?php endif; ?>

        <?php if(!empty($person['projects']) && $person['projects_placement'] == "Main area"): ?>
        <div class="l-box--space--inline">
            <?php echo get_projects($person['projects']); ?>
        </div>
        <?php endif; ?>

    </div>

    <?php if (
        !empty($person['team']) && $person['team_placement'] == "Sidebar"
     || !empty($person['projects']) && $person['projects_placement'] == "Sidebar"
     || !empty($person['custom_title']) && !empty($person['custom']) && $person['custom_placement'] == "Sidebar"
    ) : ?>
    <div class="l-primary-content__pull-out  l-primary-content__pull-out--bottom">
        <div class="l-primary-content__space-inline--@small">

            <?php if(!empty($person['team']) && $person['team_placement'] == "Sidebar"): ?>
            <?php echo get_team($person['team']); ?>
            <?php endif; ?>

            <?php if(!empty($person['projects']) && $person['projects_placement'] == "Sidebar"): ?>
            <?php echo get_projects($person['projects']); ?>
            <?php endif; ?>

            <?php if(!empty($person['custom_title']) && !empty($person['custom']) && $person['custom_placement'] == "Sidebar"): ?>
            <?php echo get_custom($person['custom_title'], $person['custom']); ?>
            <?php endif; ?>

        </div>
    </div>
    <?php endif; ?>
</div>

<?php return; ?>

<div class="l-blockrow">
    <div class="">
        <div class="c-panel  u-padding--sides--l">
            <article class="c-longform-content  c-user-content">
            <?php #echo '<pre>'; var_dump($person); echo '</pre>'; ?>

                <?php /*<h1 class="person__name   [ flr_main-page-heading  flr_main-page-heading--flush  flr_main-page-heading--npeu ]"><?php if(!empty($person['title'])): ?><?php echo $person['title']; ?> <?php endif; ?><?php echo $person['name']; ?><?php if(!empty($person['qualifications'])): ?> <small><?php echo $person['qualifications']; ?></small><?php endif; ?></h1> */?>
                <h1 class="person__name"><?php if(!empty($person['title'])): ?><?php echo $person['title']; ?> <?php endif; ?><?php echo $person['name']; ?><?php if(!empty($person['qualifications'])): ?> <small><?php echo $person['qualifications']; ?></small><?php endif; ?></h1>
                <?php /*<div class="person__image">
                    <img src="<?php echo $person['profile_img_src']; echo strpos($person['profile_img_src'], '?') === false ? '?' : '&'; ?>s=200" alt="" />
                </div>*/ ?>
                <div aria-hidden="true" class="user-insert user-insert--left user-insert--one-quarter user-insert--portrait" data-display-is="width-one-quarter  pulled-left">
                    <span data-contains="image portrait">
                        <b>
                            <img src="<?php echo $person['profile_img_src']; echo strpos($person['profile_img_src'], '?') === false ? '?' : '&'; ?>s=200" alt="Portrait of <?php echo $person['name']; ?>" width="180" />
                        </b>
                    </span>
                </div>
                <div>
                    <?php if(!empty($person['role'])): ?>
                    <div class="person__role">
                        <p><b><?php echo $person['role']; ?></b></p>
                    </div>
                    <div class="person__email">
                        <p>Email: <a href="mailto:<?php echo $person['email']; ?>"><?php echo $person['email']; ?></a></p>
                    </div>
                    <?php endif; ?>
                    <?php /* if(!empty($person['strapline'])): ?>
                    <div class="person__summary">
                        <p><?php echo $person['strapline']; ?></p>
                    </div>
                    <?php endif; */?>
                    <?php if(!empty($person['biography'])): ?>
                    <section class="person__biography">
                        <h2>Biography</h2>
                        <?php echo $person['biography']; ?>
                    </section>
                    <?php endif; ?>

                    <?php if(!empty($person['custom_title']) && !empty($person['custom']) && $person['custom_placement'] == "Main area"): ?>
                    <?php echo get_custom($person['custom_title'], $person['custom']); ?>
                    <?php endif; ?>

                    <?php if(!empty($person['publications_data']) || !empty($person['publications_manual'])): ?>
                    <section class="person__publications">
                        <h2>Publications</h2>
                        <?php if(!empty($person['publications_data'])): /* Publications data present */?>
                        <?php if(isset($person['publications_data'][0])): /* Publications as single list */?>
                        <ul class="spaced-list">
                        <?php foreach($person['publications_data'] as $publication): ?>
                            <li>
                            <?php echo $this->escape($publication['full_entry']); ?>
                            <?php if (!empty($publication['url'])) : ?><br><a href="<?php echo $publication['url']; ?>"><?php echo $publication['url']; ?></a><?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                        <?php else: /* Publications collected */ ?>
                        <?php foreach($person['publications_data'] as $heading=>$collection): ?>
                        <?php if (!empty($collection['publications'])): ?>
                        <section>
                            <h3><?php echo is_numeric($heading) ? $heading : $heading . 's'; ?></h3>
                            <ul class="spaced-list">
                                <?php foreach($collection['publications'] as $publication): ?>
                                <li>
                                <?php echo $this->escape($publication['full_entry']); ?>
                                <?php if (!empty($publication['url'])) : ?><br><a href="<?php echo $publication['url']; ?>"><?php echo $publication['url']; ?></a><?php endif; ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </section>
                        <?php endif; ?>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        <?php endif; ?>

                        <?php if(!empty($person['publications_manual'])): ?>
                        <?php echo $person['publications_manual']; ?>
                        <?php endif; ?>
                    </section>
                    <?php endif; ?>

                    <?php if(!empty($person['team']) && $person['team_placement'] == "Main area"): ?>
                    <?php echo get_team($person['team']); ?>
                    <?php endif; ?>

                    <?php if(!empty($person['projects']) && $person['projects_placement'] == "Main area"): ?>
                    <?php echo get_projects($person['projects']); ?>
                    <?php endif; ?>
                </div>
                <div class="person__sidebar">
                    <?php if(!empty($person['team']) && $person['team_placement'] == "Sidebar"): ?>
                    <?php echo get_team($person['team']); ?>
                    <?php endif; ?>

                    <?php if(!empty($person['projects']) && $person['projects_placement'] == "Sidebar"): ?>
                    <?php echo get_projects($person['projects']); ?>
                    <?php endif; ?>

                    <?php if(!empty($person['custom_title']) && !empty($person['custom']) && $person['custom_placement'] == "Sidebar"): ?>
                    <?php echo get_custom($person['custom_title'], $person['custom']); ?>
                    <?php endif; ?>
                </div>
            </article>
        </div>
    </div>
</div>