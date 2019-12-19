<?php
/**
 * @package		People
 * @subpackage	com_people
 * @copyright	Copyright (C) 2012 Andy Kirk.
 * @author		Andy Kirk
 * @license		License GNU General Public License version 2 or later
 */

// No direct access
defined('_JEXEC') or die;

$application_env = $_SERVER['SERVER_NAME'] == 'dev.npeu.ox.ac.uk' ? 'development' : ($_SERVER['SERVER_NAME'] == 'test.npeu.ox.ac.uk' ? 'testing' : 'production');
#$application_env = 'production';

if ($application_env != 'development') {
    jimport('joomla.html.html.bootstrap');
}

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
            <ul class="gallery-grid  gallery-grid--gutter--medium  gallery-grid--basis-20">

                <?php foreach($team as $id => $member): ?>
                <li class="gallery-grid__item">
                
                    <article class="c-glimpse  u-word-wrap--insideX">
                        <a href="/about/people/<?php echo $member['alias']; ?>" class="c-glimpse__link">
                            <div class="c-glimpse__image">
                                <div class="l-proportional-container  l-proportional-container--1-1">
                                    <div class="l-proportional-container__content">
                                        <div class="u-image-cover  js-image-cover">
                                            <div class="u-image-cover__inner">
                                                <img src="<?php echo $member['profile_img_src']; echo strpos($member['profile_img_src'], '?') === false ? '?' : '&'; ?>s=300" sizes="100vw" srcset="<?php echo $member['profile_img_src']; echo strpos($member['profile_img_src'], '?') === false ? '?' : '&'; ?>s=1600 1600w, <?php echo $member['profile_img_src']; echo strpos($member['profile_img_src'], '?') === false ? '?' : '&'; ?>s=900 900w, <?php echo $member['profile_img_src']; echo strpos($member['profile_img_src'], '?') === false ? '?' : '&'; ?>s=300 300w" alt="" class="u-image-cover__image" width="200">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="c-glimpse__content">
                                <h3 class="c-glimpse__heading"><span><?php echo $member['firstname']; ?></span></span> <span><?php echo $member['lastname']; ?></span></h3>
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
            <ul class="gallery-grid  gallery-grid--gutter--medium  gallery-grid--basis-20">
            
                <?php foreach($projects as $project):
                    $svg_path = '/img/brand-logos/unit/' . $project['alias'] . '-logo.svg';
                    $png_path = '/img/brand-logos/unit/' . $project['alias'] . '-logo.png';
                    $svg_info = svg_info($svg_path);
                ?>
                <li class="gallery-grid__item">
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
<div class="l-blockrow">
    <div class="">
        <div class="c-panel  u-padding--sides--l">
            <article class="person">
            <?php #echo '<pre>'; var_dump($person); echo '</pre>'; ?>

                <?php /*<h1 class="person__name   [ flr_main-page-heading  flr_main-page-heading--flush  flr_main-page-heading--npeu ]"><?php if(!empty($person['title'])): ?><?php echo $person['title']; ?> <?php endif; ?><?php echo $person['name']; ?><?php if(!empty($person['qualifications'])): ?> <small><?php echo $person['qualifications']; ?></small><?php endif; ?></h1> */?>
                <h1 class="person__name"><?php if(!empty($person['title'])): ?><?php echo $person['title']; ?> <?php endif; ?><?php echo $person['name']; ?><?php if(!empty($person['qualifications'])): ?> <small><?php echo $person['qualifications']; ?></small><?php endif; ?></h1>
                <div class="person__image">      
                    <img src="<?php echo $person['profile_img_src']; echo strpos($person['profile_img_src'], '?') === false ? '?' : '&'; ?>s=200" alt="" />
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