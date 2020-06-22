<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_people
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

JLoader::register('TplNPEU6Helper', dirname(dirname(dirname(__DIR__))) . '/helper.php');

$person = $this->person;

function svg_info($img_src, $fallback_width = 180) {
    if (file_exists($img_src)) {
        $svg = file_get_contents($img_src);
        preg_match('/viewBox="([^"]+)"/', $svg, $matches);
        #echo '<pre>'; var_dump($matches); echo '</pre>';
        $viewbox = isset($matches[1]) ? $matches[1] : '';
        
        $values = explode(' ', $viewbox);
        $w = $values[2];
        $h = $values[3];
        $ratio = ($w < $h) ? ($w / $h) : ($h / $w);
        $fallback_height = round($fallback_width * $ratio);

        $values[2] = $fallback_width;
        $values[3] = $fallback_height;
        
        $return = array(
            0 => $fallback_width,
            1 => $fallback_height,
            'viewbox' => 'viewBox="' . implode(' ', $values) . '"',
            'dimensions' => 'width="' . $fallback_width . '" height="' . $fallback_height . '"'
        );
        
        return $return;
    }
}

function get_team($team) {
?>
        <section class="person__team">
            <h2>Team</h2>
            <ul class="l-gallery-grid  l-gallery-grid--gutter--medium  l-gallery-grid--basis-20">

                <?php foreach($team as $id => $member): ?>
                <li class="l-gallery-grid__item" filterable_item>
                    <article class="c-glimpse  u-space--none">
                        <a href="/about/people/<?php echo $member['alias']; ?>" class="c-glimpse__link">
                            <div class="c-glimpse__image  c-glimpse__image--rounded">
                                <div class="l-proportional-container  l-proportional-container--1-1">
                                    <div class="l-proportional-container__content">
                                        <div class="u-image-cover  js-image-cover">
                                            <div class="u-image-cover__inner">
                                                <img src="<?php echo $member['profile_img_src']; echo strpos($member['profile_img_src'], '?') === false ? '?' : '&'; ?>s=140" alt="" width="70px" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-glimpse__content">
                                <h3 class="c-glimpse__heading"><span filterable_index filterable_index_name="first_name"><?php echo $member['firstname']; ?></span></span> <span filterable_index filterable_index_name="last_name"><?php echo $member['lastname']; ?></span></h3>         
                                <?php if(!empty($member['role'])): ?>
                                <p><?php echo $member['role']; ?></p>
                                <?php endif; ?>
                            </div>
                        </a>
                    </article>
                </li>
                <?php endforeach; ?>
            </ul>
            
        </section>
<?php
}

function get_projects($projects) {
?>
        <section class="person__projects">
            <h2>Projects</h2>
            <ul class="l-gallery-grid  l-gallery-grid--gutter--medium  l-gallery-grid--basis-20">
            
                <?php foreach($projects as $project):
                    $svg_path = '/assets/images/brand-logos/unit/' . $project['alias'] . '-logo.svg';
                    $png_path = '/assets/images/brand-logos/unit/' . $project['alias'] . '-logo.png';
                    $svg_info = svg_info($svg_path);
                ?>
                <li class="l-gallery-grid__item">
                    <a href="/<?php echo $project['alias']; ?>" class="c-badge  c-badge--limit-height">
         
                        <img src="<?php echo $svg_path; ?>" onerror="this.src='<?php echo $png_path; ?>'; this.onerror=null;" alt="<?php echo $project['title']; ?>: <?php echo $project['long_title']; ?>" <?php echo $svg_info['dimensions']; ?>>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
            
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

<div class="l-primary-content  l-primary-content--has-pull-outs">
                            

    <div class="l-primary-content__header">

        <div class="c-panel">
            <h1 id="<?php echo TplNPEU6Helper::html_id($person['name']); ?>"><?php if(!empty($person['title'])): ?><?php echo $person['title']; ?> <?php endif; ?><?php echo $person['name']; ?><?php if(!empty($person['qualifications'])): ?> <small><?php echo $person['qualifications']; ?></small><?php endif; ?></h1>
            
            <?php if(!empty($person['role']) || !empty($person['email'])): ?>
            <p class="u-text-group  u-text-group--wide-space">
                <?php if(!empty($person['role'])): ?>
                <b><?php echo $person['role']; ?></b>
                <?php endif; ?>
                <?php if(!empty($person['email'])): ?>
                <a href="mailto:<?php echo $person['email']; ?>"><?php echo $person['email']; ?></a>
                <?php endif; ?>
            </p>
            <?php endif; ?>
        </div>
    </div>
    
    <?php if (!true) : ?>
    <div class="l-primary-content__pull-out  l-primary-content__pull-out--super  u-space--above  c-user-content">
        <div class="l-primary-content__pull-out__padded--@small">
            <div aria-hidden="true" class="" data-display-is="width-one-quarter  pulled-left" data-extra-id="2095">
                <span data-contains="image portrait">
                    <b>
                        <img src="<?php echo $person['profile_img_src']; echo strpos($person['profile_img_src'], '?') === false ? '?' : '&'; ?>s=200" alt="Portrait of <?php echo $person['name']; ?>" width="180" />
                    </b>
                </span>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php #if (!true) : ?>
    <div class="l-primary-content__pull-out  l-primary-content__pull-out--top  c-user-content">
        <div class="l-primary-content__pull-out__padded--@small">
            <div aria-hidden="true" class="" data-display-is="width-one-quarter  pulled-left" data-extra-id="2095">
                <span data-contains="image portrait">
                    <b>
                        <img src="<?php echo $person['profile_img_src']; echo strpos($person['profile_img_src'], '?') === false ? '?' : '&'; ?>s=200" alt="Portrait of <?php echo $person['name']; ?>" width="180" />
                    </b>
                </span>
            </div>
        </div>
    </div>
    <?php #endif; ?>

    <div class="l-primary-content__main">

        <div class="c-panel">
            <div>
                <?php if(!empty($person['biography'])): ?>
                    <section class="c-user-content">
                        <h2>Biography</h2>
                        <?php echo $person['biography']; ?>
                    </section>
                <?php endif; ?>
                
                <?php if(!empty($person['custom_title']) && !empty($person['custom']) && $person['custom_placement'] == "Main area"): ?>
                    <div class="c-user-content">
                    <?php echo get_custom($person['custom_title'], $person['custom']); ?>
                    </div>
                <?php endif; ?>
                
                <?php if(!empty($person['publications_data']) || !empty($person['publications_manual'])): ?>
                <section>
                    <h2>Publications</h2>
                    <?php if(!empty($person['publications_data'])): /* Publications data present */?>
                    <?php if(isset($person['publications_data'][0])): /* Publications as single list */?>
                    <ul>
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
                        <ul>
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
        </div>

    </div>

    <?php if (
        !empty($person['team']) && $person['team_placement'] == "Sidebar"
     || !empty($person['projects']) && $person['projects_placement'] == "Sidebar"
     || !empty($person['custom_title']) && !empty($person['custom']) && $person['custom_placement'] == "Sidebar"
    ) : ?>
    <div class="l-primary-content__pull-out  l-primary-content__pull-out--bottom">
        <div class="l-primary-content__pull-out__padded--@small">
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
                <div aria-hidden="true" class="user-insert user-insert--left user-insert--one-quarter user-insert--portrait" data-display-is="width-one-quarter  pulled-left" data-extra-id="2095">
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