<?php
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

use NPEU\Template\Npeu6\Site\Helper\Npeu6Helper as TplNPEU6Helper;

$menu_item = TplNPEU6Helper::get_menu_item();
$menu_item_params = $menu_item->getParams();
?>
    <div class="l-layout  page-wrap" data-brand="<?php echo $page_brand->alias; ?>">
        <div class="l-layout__inner">

            <?php if ($env != 'production') : ?>
            <div class="env_container" id="env-container">
                <div>
                    <fieldset role="presentation">
                        <p>
                            <?php echo strtoupper($env); ?>
                        </p>
                        <button id="env-msg-close-button" aria-labelledby="env-msg-close-button-label" onclick="this.parentNode.parentNode.parentNode.style.display='none'">
                            <svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em">
                                <use xlink:href="#icon-cross"></use>
                                <text visibility="hidden" id="env-msg-close-button-label">Close this notice</text>
                            </svg>
                        </button>
                    </fieldset>
                </div>
            </div>
            <?php endif; ?>

            <div class="l-box">

                <header aria-label="Page" class="page-header">
                    <div class="l-layout  l-row  l-row--push-apart  l-gutter--s  l-flush-block-gutter  d-background--very-dark">
                        <div class="l-layout__inner">
                            <div class="l-box">
                                <p role="list" class="c-utilitext  c-utilitext--skiplinks">
                                    <span role="listitem"><a href="#main"><span>Skip to content</span></a></span>
                                    <span role="listitem"><a href="#primary-nav"><span>Skip to navigation</span></a></span>
                                    <span role="listitem"><a href="#page-footer"><span>Skip to footer</span></a></span>
                                </p>
                            </div>
                            <div class="l-box">
                                <div class="l-layout  l-row  l-gutter  l-flush-edge-gutter">
                                    <div class="l-layout__inner">
                                        <div class="l-box">
                                            <?php echo $modules__log_in_out_button; ?>
                                        </div>
                                        <div class="l-box">
                                            <p class="c-utilitext   l-layout  l-row  l-row--start  l-gutter--xs  l-flush-edge-gutter  no-print">
                                                <span role="list" class="l-layout__inner">
                                                    <span role="listitem" class="l-box">
                                                        <a href="/staff-area"><span>Staff Area</span></a>
                                                    </span>
                                                    <?php if($user->get('is_staff')): ?>
                                                    <span class="l-box__separator">|</span>

                                                    <span role="listitem" class="l-box">
                                                        <a href="http://api.qrserver.com/v1/create-qr-code/?data=http://qr.npeu.ox.ac.uk/<?php echo $menu_item->id; ?>&amp;format=eps"><span>QR code (eps)</span></a>
                                                    </span>
                                                    <?php endif; ?>
                                                    <?php if ($user->authorise("core.edit", "com_menus.menu." . $menu_id)): ?>
                                                    <span class="l-box__separator">|</span>

                                                    <span role="listitem" class="l-box">
                                                        <a href="/administrator/index.php?option=com_menus&amp;view=item&amp;client_id=0&amp;layout=edit&amp;id=<?php echo $menu_item->id; ?>" target="_blank"><span>Edit page</span><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-edit"></use></svg></a>
                                                    </span>
                                                    <?php endif; ?>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php if ($modules__top != '') : ?>
                    <?php echo $modules__top; ?>
                    <?php endif; ?>
                    <?php
                        $is_brc = ($menu_route == 'brc-cardiovascular-medicine');
                    ?>

                    <div class="l-layout  l-distribute  l-gutter  page-header__brand-banner  <?php echo $page_brand->alias; ?>">
                        <p class="l-layout__inner"<?php if (!$page_display_cta) : ?> data-js="cmr" data-ie-safe-parent-level="1"<?php endif; ?>>

                            <span class="l-box  primary-logo-wrap"<?php if (!$page_display_cta) : ?> data-min-width="229"<?php endif; ?>>
                                <a href="/<?php echo $page_brand->alias == 'npeu' ? '' : $page_brand->alias; ?>" class="c-badge  c-badge--primary-logo"><?php echo str_replace('height="80"', 'height="100" width="' . $page_brand->svg_width_at_height_100 . '"', str_replace('height="150"', 'height="100" width="' . $page_brand->svg_width_at_height_100 . '"', $page_brand->logo_svg_with_fallback)); ?></a>
                            </span>

                            <?php if ($page_display_cta) : ?>
                            <span class="l-box  l-box--center  l-box--push-apart">
                                <a href="<?php echo $page_cta_url; ?>" class="c-primary-cta  d-background  t-secondary"><?php echo $page_cta_text; ?></a>
                            </span>
                            <?php endif; ?>
                            <?php
                                // Ugh - this is getting very hacky. If possible, change template to allow for 'secondary logo'
                                // to be specified as an 'overide'.
                                if ($is_brc) {
                                    $second_brand_id = 146;
                                } elseif ($page_brand->alias == 'npeu') {
                                    //$second_brand_id = 122;
                                    $second_brand_id = false;

                                } elseif ($page_brand->alias == 'pru-mnhc') {
                                    $second_brand_id = 2;
                                } elseif ($page_unit == 'npeu') {
                                    $second_brand_id = 1;
                                } else {
                                    $parent_brand_alias_id = [
                                        'pru-mnhc' => 28,
                                        'npeu_ctu' => 14,
                                        'sheer'    => 16,
                                        'he'       => 106
                                    ];

                                    $second_brand_id = $parent_brand_alias_id[$page_unit];
                                }

                            ?>
                            <?php if ($second_brand_id) :
                            $second_brand = TplNPEU6Helper::get_brand($second_brand_id);
                            $second_brand_url = 'https://www.npeu.ox.ac.uk';
                            if ($is_brc) {
                                $second_brand_url = $second_brand->params->logo_url;
                                $second_brand_width = $second_brand->svg_width_at_height_80;
                            } elseif ($page_brand->alias == 'npeu') {
                                $second_brand_width = $second_brand->svg_width_at_height_100;
                            } elseif ($page_brand->alias == 'pru-mnhc') {
                                $second_brand_url = $second_brand->params->logo_url;
                                $second_brand_width = $second_brand->svg_width_at_height_80;
                            } else {
                                $second_brand_url .= '/' . (($page_unit == 'he') ? 'sheer' : ($page_unit == 'npeu' ? '' : $second_brand->alias));
                                $second_brand_width = $second_brand->svg_width_at_height_80;
                            }
                            ?>
                            <span class="l-box  l-box  l-box--center"<?php if (!$page_display_cta) : ?> data-min-width="<?php echo $second_brand_width; ?>"<?php endif; ?>>
                                <a href="<?php echo $second_brand_url; ?>" class="c-badge  c-badge--primary-logo"><?php if ($page_brand->alias == 'npeu') : ?>
                                    <?php echo str_replace('height="80"', 'height="100" width="' . $second_brand_width . '"', $second_brand->logo_svg_with_fallback); ?>
                                    <?php else: ?>
                                    <img src="<?php echo $second_brand->logo_svg_path; ?>" onerror="this.src='<?php echo $second_brand->logo_png_path; ?>'; this.onerror=null;" alt="Logo: <?php echo $second_brand->name; ?>" height="80" width="<?php echo $second_brand_width; ?>">
                                    <?php endif; ?></a>
                            </span>
                            <?php endif; ?>
                        </p>
                    </div>

                    <?php if($page_has_navbar) : ?>
                    <div class="d-background" data-fs-block="inverted flush">
                        <div class="nav-bar" data-js="cmr" data-ie-safe-parent-level="1">

                            <div class="nav-bar__start" data-area="navbar-controls">
                                <?php if ($modules__header_nav_bar != '') : ?>
                                <div class="nav-bar__item">
                                    <button class="over-panel-control" hidden="" aria-controls="menu-panel" aria-label="Main menu" aria-expanded="false" data-js="overpanel__control"><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none" class="icon  icon--is-closed"><use xlink:href="#icon-menu"></use></svg><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none" class="icon  icon--is-open"><use xlink:href="#icon-cross"></use></svg></button>
                                </div>
                                <?php endif; ?>
                                <div class="nav-bar__item">
                                    <button class="over-panel-control" hidden="" aria-controls="search-panel" aria-label="Search" aria-expanded="false" data-js="overpanel__control"><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none" class="icon  icon--is-closed"><use xlink:href="#icon-search"></use></svg><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none" class="icon  icon--is-open"><use xlink:href="#icon-cross"></use></svg></button>
                                </div>
                            </div>

                            <nav class="nav-bar__main" id="primary-nav" aria-label="Primary" data-area="main-nav">

                                <div class="over-panel  over-panel--fade" id="menu-panel" data-js="over-panel">
                                    <button class="over-panel__overlay" hidden="" aria-hidden="true" tabindex="-1" data-js="over-panel__overlay"></button>
                                    <div class="over-panel__contents  d-background" data-js="over-panel__contents">
                                        <?php echo $modules__header_nav_bar; ?>
                                    </div>
                                </div>

                            </nav>

                            <div class="nav-bar__end" data-area="search-form" data-min-width="250">
                                <div class="over-panel  over-panel--fade" id="search-panel" data-js="over-panel">
                                    <button class="over-panel__overlay" hidden="" aria-hidden="true" tabindex="-1" data-js="over-panel__overlay"></button>
                                    <div class="over-panel__contents  d-background" data-js="over-panel__contents">
                                        <form action="<?php echo ($page_brand->alias != 'npeu') ? '/' . $page_brand->alias : ''; ?>/search" id="searchform" class="search-form  search-form---restrict-width" method="GET">
                                            <?php if ($page_search_area != ''): ?>
                                            <input type="hidden" value="<?php echo $page_search_area; ?>" name="t[]">
                                            <?php endif; ?>
                                            <input type="search" class="search-form__field" id="search" placeholder="Search<?php if (!empty($search_field_hint)): ?> (e.g. <?php echo $search_field_hint; ?>)<?php endif; ?>" name="q" value="" aria-label="Search">
                                            <button class="search-form__submit" type="submit" id="search-button" aria-labelledby="search-button-label">
                                                <span>
                                                    <svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em"><use xlink:href="#icon-search"></use>
                                                    <text visibility="hidden" id="search-button-label">Search</text></svg>
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <?php else: ?>
                    <div class="d-border--bottom--thick"></div>
                    <?php endif; ?>

                    <?php if(!empty($modules__main_breadcumbs)) : ?>
                    <?php echo $modules__main_breadcumbs; /*<jdoc:include type="modules" name="3-main-breadcrumbs" style="basic" />*/?>
                    <?php endif; ?>
                </header>
            </div>
            <div class="l-box  l-box--expand">

                <main id="main" aria-labelledby="<?php echo TplNPEU6Helper::html_id($page_heading); ?>" class="dX-background--dark<?php if ($is_blog && $page_has_article) :?>  is-blog-article<?php endif; ?>">

                    <?php if($page_has_hero) : ?>
                    <?php if (!empty($page_heroes['hero_image0']->heading)) {
                        $h_el = 'p';
                        if ($page_is_landing && $show_page_heading) {
                            $h_el = 'h1';
                            $heading_shown = true;
                        }
                    } ?>
                    <?php if($page_has_carousel) : ?>
                    <fieldset role="region" aria-label="banner slides" class="c-hero-wrap  c-hero-carousel  c-hero--message-wide  js-c-carousel  d-border--top--thick  d-border--bottom--thick  d-background--dark" data-slide-name="banner-slide">
                        <div>
                            <nav class="c-hero-carousel__nav" aria-label="banner slides">
                                <p data-fs-text="center" role="list">
                                    <?php $i = 0; foreach ($page_heroes as $key => $page_hero) : $i++; ?>
                                    <span role="listitem">
                                        &ensp;<a href="#banner-slide-<?php echo $i; ?>">Slide <?php echo $i; ?></a>&ensp;
                                    </span>
                                    <?php endforeach; ?>
                                </p>
                            </nav>
                            <div tabindex="0" class="c-hero-carousel__scroll-area" role="list">
                    <?php else : ?>

                    <div class="c-hero-wrap<?php echo ((!empty($page_heroes['hero_image0']->heading) && $h_el == 'h1') || strlen($page_heroes['hero_image0']->text) > 185) ? '  c-hero__message--wide' : ''; ?><?php echo !empty($page_heroes['hero_image0']->heading) ? '  c-hero--message-wide' : ''; ?>  d-border--top--thick  d-border--bottom--thick  d-background--dark" data-fs-text="center">
                    <?php endif; /* @TODO - need to think about credit lines. */ ?>
                            <?php $i = 0; foreach ($page_heroes as $key => $page_hero) : $i++; ?>
                                <?php if ($i > 1) { $h_el = 'p'; } ?>
                                <?php if ($page_has_carousel) : ?>
                                <hr noShade size="1">
                                <?php endif; ?>
                                <div<?php if($page_has_carousel) : ?><?php echo ' id="banner-slide-' . $i . '" role="listitem"'; ?><?php endif; ?> class="c-hero<?php if (!empty($page_hero->text_position)) : echo '  c-hero--message-' . $page_hero->text_position; endif; ?>  c-info-overlay-wrapx" data-fs-text="center">

                                    <div class="c-hero__image">
                                        <div class="u-image-cover  js-image-cover  <?php if ($is_blog && $page_has_article) :?>u-image-cover--min-50<?php else: ?>u-image-cover--min-33-33<?php endif; ?>">
                                            <div class="u-image-cover__inner">
                                                <img src="<?php echo $page_hero->image; ?>?s=300" sizes="100vw" srcset="<?php echo $page_hero->image; ?>?s=1600 1600w, <?php echo $page_hero->image; ?>?s=900 900w, <?php echo $page_hero->image; ?>?s=300 300w" alt="<?php echo $page_hero->alt; ?>" class="u-image-cover__image" width="200">
                                            </div>
                                        </div>
                                    </div>

                                    <?php if ($page_hero->credit): ?>
                                    <details class="c-info-overlay  c-info-overlay--half-width">
                                        <summary><span>Details</span><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none" class="icon  icon--is-closed"><use xlink:href="#icon-info"></use></svg><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none" class="icon  icon--is-open"><use xlink:href="#icon-cross"></use></svg></summary>
                                        <div><?php echo $page_hero->credit; ?></div>
                                    </details>
                                    <?php endif; ?>

                                    <?php if (!empty($page_hero->heading) || !empty($page_hero->text) || (!empty($page_hero->cta_link) && !empty($page_hero->cta_text))) : ?>
                                    <div class="c-hero__message">
                                        <?php if (!empty($page_hero->heading)) : ?>
                                        <<?php echo $h_el; ?> class="c-hero__message--fluid_heading" id="<?php echo TplNPEU6Helper::html_id($page_heading); ?>" <?php /* not 100% sure this is needed: tabindex="-1"*/ ?>><?php echo ($h_el == 'p' ? '<b>' : ''); ?><?php echo $page_hero->heading; ?><?php echo ($h_el == 'p' ? '</b>' : ''); ?></<?php echo $h_el; ?>>
                                        <?php endif; ?>
                                        <p class="c-hero__message--fluid_text"><?php echo $page_hero->text; ?></p>
                                        <?php if (!empty($page_hero->cta_link) && !empty($page_hero->cta_text)) : ?>
                                        <p class="c-hero__cta"><a href="<?php echo $page_hero->cta_link; ?>" class="c-cta"><?php echo $page_hero->cta_text; ?><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-chevron-right"></use></svg></a></p>
                                        <?php endif; ?>
                                    </div>

                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>

                        <?php if($page_has_carousel) : ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php if($page_has_carousel) : ?>
                    </fieldset>
                    <?php else: ?>
                    </div>
                    <?php endif; ?>
                    <?php endif; /* End $page_has_hero */ ?>


                    <br id="highlighter-start" />

                    <div class="d-border--bottom--thick">
                        <?php if ($page_is_landing) : ?>
                        <!-- Page is landing -->
                        <?php if ($show_page_heading && !isset($heading_shown)) : /* E.g. /news NOT DONE >>>> */?>
                        <!-- Page Heading -->
                        <div class="c-panel  d-background--white  n--page-is-landing">
                            <header class="c-panel__header">
                                <?php if (isset($doc->header_cta) || $is_blog) : ?>
                                <div>
                                    <h1 id="<?php echo TplNPEU6Helper::html_id($page_heading); ?>" tabindex="-1"><?php echo $page_heading; ?></h1>
                                    <p>
                                        <?php if (isset($doc->header_cta)) : /* E.g. User Profile (Edit CTA) */ ?>
                                        <a href="<?php echo $doc->header_cta['url']; ?>" class="c-cta"><?php echo $doc->header_cta['text']; ?><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-chevron-right"></use></svg></a>
                                        <?php endif; ?>
                                        <?php if ($is_blog && $page_is_subroute == false && $has_add_form_child == false && $menu_item_params->get('show_feed_link', true) == true) : /* E.g. What's New */ ?>
                                        <a href="<?php echo $uri->getPath(); ?>?format=feed&type=rss" class="c-cta">RSS Feed<svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-rss"></use></svg></a>
                                        <?php endif; ?>
                                        <?php if ($has_add_form_child && $page_is_subroute == false) : /* E.g. Staff Notices */ ?>
                                        <a href="<?php echo $add_form_child_url; ?>" class="c-cta">Add new<svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none" class="icon" aria-hidden="true"><use xlink:href="#icon-edit"></use></svg></a>
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <?php else : ?>
                                <h1 id="<?php echo TplNPEU6Helper::html_id($page_heading); ?>" tabindex="-1"><?php echo $page_heading; ?></h1>
                                <?php endif; ?>
                            </header>
                        </div>
                        <?php endif; /* <<<< */ ?>

                        <?php echo TplNPEU6Helper::get_messages(); ?>

                        <jdoc:include type="component" format="raw" />

                        <?php else : /* NOT DONE >>>> */ ?>
                        <!-- Page is NOT landing -->
                        <div class="l-primary-content<?php if ($page_has_pull_outs) : ?>  l-primary-content--has-pull-outs<?php endif; ?><?php if (!($page_has_sidebar_super || $page_has_sidebar_top || $page_has_priority_content || $page_toc)) : ?>  l-primary-content--has-pull-outs--only-bottom<?php endif; ?>  n--page-not-landing  d-background--white">

                            <?php if ($page_has_sidebar_super) : ?>
                            <?php if ($page_badge) : ?>
                            <div class="l-primary-content__pull-out  l-primary-content__pull-out--super  u-text-align--center">
                                <?php echo $page_badge; ?>
                            </div>
                            <?php endif; ?>
                            <?php endif; ?>

                            <div class="l-primary-content__header">

                                <?php echo $modules__main_upper; /*<jdoc:include type="modules" name="3-main-upper" style="basic" />*/?>

                                <div class="c-panel">
                                    <?php if (isset($doc->header_cta) || $is_blog) : ?>
                                    <header class="c-panel__header">
                                        <div>
                                            <h1 id="<?php echo TplNPEU6Helper::html_id($page_heading); ?>" tabindex="-1"><?php echo $page_heading; ?></h1>
                                            <p>
                                                <?php if (isset($doc->header_cta)) : ?>
                                                <a href="<?php echo $doc->header_cta['url']; ?>" class="c-cta"><?php echo $doc->header_cta['text']; ?><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-chevron-right"></use></svg></a>
                                                <?php endif; ?>
                                                <?php if ($is_blog && $page_is_subroute == false && $has_add_form_child == false && $menu_item_params->get('show_feed_link', true) == true) : ?>
                                                <a href="<?php echo $uri->getPath(); ?>?format=feed&type=rss" class="c-cta">RSS Feed<svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-rss"></use></svg></a>
                                                <?php endif; ?>
                                                <?php if ($has_add_form_child && $page_is_subroute == false) : ?>
                                                <a href="<?php echo $add_form_child_url; ?>" class="c-cta">Add new &nbsp;<svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-edit"></use></svg></a>
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                    </header>
                                    <?php else : ?>
                                    <header class="c-panel__header">
                                        <h1 id="<?php echo TplNPEU6Helper::html_id($page_heading); ?>" tabindex="-1"><?php echo $page_heading; ?></h1>
                                    </header>
                                    <?php endif; ?>
                                    <?php echo TplNPEU6Helper::get_messages(); ?>
                                    <?php if ($page_has_article) : ?>
                                    <?php
                                    // Content is generated by content plugin event "onContentAfterTitle"
                                    // Not sure this is the best place for this?
                                    ?>
                                    <?php echo $doc->article->event->afterDisplayTitle; ?>
                                    <?php endif; ?>
                                    <?php if ($page_has_area_menu || $page_has_section_menu) : ?>
                                    <div class="l-primary-content__hidden--wide">
                                        <p class="c-utilitext  u-text-align--right">
                                            <?php if ($page_has_area_menu) : ?>
                                            <a href="#<?php echo $page_area_menu_id; ?>"><span>Menu</span></a>
                                            <?php endif; ?>
                                            <?php if ($page_has_section_menu) : ?>
                                            <?php if ($page_has_area_menu) : ?>
                                            |
                                            <?php endif; ?>
                                            <a href="#in-this-section"><span>In this section</span></a>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php /*if ($page_has_sidebar_super) : ?>
                            <?php if ($page_badge) : ?>
                            <div class="l-primary-content__pull-out  l-primary-content__pull-out--super  u-space--above  l-primary-content__pull-out__margin--@large">
                                <?php echo $page_badge; ?>
                            </div>
                            <?php endif; ?>
                            <?php endif; */?>

                            <?php if ($page_has_article) : ?>
                            <?php // Content is generated by content plugin event "onContentBeforeDisplay"
                            // Not sure this is the best place for this? ?>
                            <?php echo $doc->article->event->beforeDisplayContent; ?>
                            <?php endif; ?>

                            <?php if ($page_has_sidebar_top || $page_has_priority_content || $page_toc) : ?>
                            <div class="l-primary-content__pull-out  l-primary-content__pull-out--top  page-sidebar">
                                <?php echo $page_toc; ?>
                                <?php if ($page_has_priority_content) : ?>
                                <div class="user-content" data-contains="priority-content">
                                    <?php echo HTMLHelper::_('content.prepare', $doc->article->introtext); ?>
                                </div>
                                <?php endif; ?>

                                <?php echo $component__sidebar_top; ?>
                                <?php echo $modules__sidebar_top; /*<jdoc:include type="modules" name="4-sidebar-top" style="sidebar" />*/?>

                            </div>
                            <?php endif; ?>

                            <div class="l-primary-content__main<?php if ($page_has_article) {echo '  has-longform-content';} ?>">

                                <?php if ($page_has_article) : ?>
                                <div class="longform-content  user-content">

                                    <?php if (!empty($doc->article->headline_image['headline-image']) && $show_headline_image == 1) : ?>
                                    <p class="u-image-cover  js-image-cover  u-image-cover--min-56-25">
                                        <span class="u-image-cover__inner">
                                            <img src="<?php echo $doc->article->headline_image['headline-image']; ?>?s=700" alt="<?php echo $doc->article->headline_image['headline-image-alt-text']; ?>" sizes="(max-width: 380px) 350px, 90vw" srcset="<?php echo $doc->article->headline_image['headline-image']; ?>?s=350 350w, <?php echo $doc->article->headline_image['headline-image']; ?>?s=700 700w" class="u-image-cover__image" width="700">
                                        </span>
                                    </p>

                                    <?php if (!empty($doc->article->headline_image['headline-image-credit-line'])) : ?>
                                    <p class="c-utilitext  c-utilitext--smaller  c-utilitext--pale">
                                        Credit: <?php echo $doc->article->headline_image['headline-image-credit-line']; ?>
                                    </p>
                                    <?php endif; ?>

                                    <?php endif; ?>

                                    <?php if ($is_blog && ((!empty($doc->article->publish_up) && $menu_item_params->get('show_publish_date', true) == true) || !empty($doc->article->twitter_url))) : ?>
                                    <p class="l-layout  l-row  l-row--push-apart  l-gutter--s  l-flush-edge-gutter">
                                        <span class="l-layout__inner">
                                        <?php if (!empty($doc->article->publish_up)) : ?><span class="l-box  l-box--center"><span>Published on <?php echo HTMLHelper::_('date', $doc->article->publish_up, Text::_('DATE_FORMAT_LC1')); ?></span></span><?php endif; ?>
                                        <?php if (!empty($doc->article->twitter_url)) : ?><span class="l-box"><a href="<?php echo $doc->article->twitter_url; ?>" class="c-cta" target="_blank"><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-twitter--inverted"></use></svg> <span>Tweet</span></a></span><?php endif; ?>
                                        </span>
                                    </p>
                                    <?php endif; ?>

                                    <?php if ($doc->article->params->get('show_author')) : ?>
                                    <p>Posted by: <?php echo $doc->article->author; ?></p>
                                    <?php endif; ?>

                                    <?php if ($page_has_priority_content) : ?>
                                    <?php echo HTMLHelper::_('content.prepare', $doc->article->fulltext); ?>
                                    <?php else : ?>
                                    <?php echo HTMLHelper::_('content.prepare', $doc->article->introtext); ?>
                                    <?php echo HTMLHelper::_('content.prepare', $doc->article->fulltext); ?>
                                    <?php endif; ?>
                                </div>

                                <?php else : ?>
                                <jdoc:include type="component" format="raw" />
                                <?php endif; ?>

                                <?php if ($page_has_article) : ?>
                                <footer class="longform-content__companion">
                                    <div class="l-layout  l-row  l-row--push-apart  l-gutter--s  t-neutral  d-background--very-light">
                                        <p class="l-layout__inner  c-utilitext">
                                            <span>Updated: <?php echo HTMLHelper::_('date', $doc->article->modified, Text::_('DATE_FORMAT_LC2')); ?> (v<?php echo $doc->article->version; ?>)</span>
                                            <?php if ($user->authorise("core.edit", "com_content.article." . $doc->article->id)) : ?><a href="<?php echo $has_add_form_child ? $uri_route . '?task=article.edit&a_id=' . $doc->article->id : '/administrator/index.php?option=com_content&amp;task=article.edit&amp;id=' . $doc->article->id . '" target="_blank"'; ?>" class="u-padding--right--s"><span>Edit content</span><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none" class="icon  u-space--left--xs"><use xlink:href="#icon-edit"></use></svg></a><?php endif; ?>
                                        </p><!-- End layout-inner -->
                                    </div>
                                </footer>
                                <?php endif; ?>
                                <?php if (!empty($doc->article->pagination)) : ?>
                                <div class="longform-content__companion">
                                    <?php echo $doc->article->pagination; ?>
                                </div>
                                <?php endif; ?>
                            </div>

                            <?php if ($page_has_article) : ?>
                            <?php // Content is generated by content plugin event "onContentAfterDisplay"
                            // Not sure this is the best place for this? ?>
                            <?php echo $doc->article->event->afterDisplayContent; ?>
                            <?php endif; ?>
                            <?php if ($page_has_pull_outs && $page_has_sidebar_bottom) : ?>
                            <div class="l-primary-content__pull-out  l-primary-content__pull-out--bottom  page-sidebar">

                                <?php if ($page_article_brand) : ?>
                                <div class="c-panel  c-panel--rounded  d-background--very-light  t-neutral  u-space--below">
                                    <div class="c-panel__module">
                                        <header class="c-panel__header" aria-labelledby="in-this-section">
                                            <h2>More on <?php echo $page_article_brand->name; ?>:</h2>
                                        </header>
                                        <?php
                                        if ($page_article_brand->alias == 'npeu') {
                                            $page_article_brand_url = '/';
                                        } else {
                                            if (!empty($page_article_brand->params && !empty($page_article_brand->params->logo_url))) {
                                                $page_article_brand_url = $page_article_brand->params->logo_url;
                                            } else {
                                                $page_article_brand_url = '/' . $page_article_brand->alias;
                                            }
                                        }
                                        ?>
                                        <p class="u-text-align--center">
                                            <a href="/<?php echo $page_article_brand->alias; ?>" class="c-badge  c-badge--limit-height--6">
                                                <?php
                                                    $public_root_path = realpath($_SERVER['DOCUMENT_ROOT']) . DIRECTORY_SEPARATOR;
                                                    $image_path       = $public_root_path . $page_article_brand->logo_png_path;
                                                    $image_info       = getimagesize(urldecode($image_path));
                                                    $image_real_ratio = $image_info[0] / $image_info[1];

                                                    $height = 80;
                                                    if ($image_info[0] > $image_info[1]) {
                                                        $width = round($height * $image_real_ratio);
                                                    } else {
                                                        $width = round($height / $image_real_ratio);
                                                    }
                                                ?>
                                                <img alt="Logo: <?php echo $page_article_brand->name; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" onerror="this.src='<?php echo $page_article_brand->logo_png_path; ?>'; this.onerror=null;" src="<?php echo $page_article_brand->logo_svg_path; ?>">
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <?php echo $component__sidebar_bottom; ?>
                                <?php echo $modules__sidebar_bottom; /*<jdoc:include type="modules" name="4-sidebar-bottom" style="sidebar" />*/ ?>
                            </div>
                            <?php endif; ?>

                            <?php if ($page_has_main_lower) : ?>
                            <div class="l-primary-content__footer">
                                <?php echo $modules__main_lower; /*<jdoc:include type="modules" name="3-main-lower" style="basic" />*/?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; /* <<<< */ ?>
                    </div>

                    <br id="highlighter-end" />
                    <?php echo $modules__bottom; /*<jdoc:include type="modules" name="5-bottom" style="block" />*/?>

                </main>
            </div>

            <div class="l-box">
                <footer id="page-footer" aria-label="Page" class="page-footer">

                    <?php if ($page_has_footer_top): ?>
                    <?php /*<div data-position="6-footer-top">
                        <?php echo $modules__footer_top; /*<jdoc:include type="modules" name="6-footer-top" style="block" />* /?>
                    </div>*/ ?>


                    <div class="l-layout  l-row  m-footer-top-count--<?php echo $page_footer_top_count; ?>" data-position="6-footer-top">
                        <div class="l-layout__inner">
                            <?php echo $modules__footer_top; ?>
                        </div>
                    </div>

                    <?php endif; ?>

                    <?php if ($page_has_footer_mid_left || $page_has_footer_mid_right): ?>
                    <div class="d-border--bottom--thick">
                        <div class="l-layout  l-row">
                            <div class="l-layout__inner">
                                <?php if ($page_has_footer_mid_left): ?>
                                <div class="l-box  ff-width-100--40--50" data-position="6-footer-mid-left">
                                    <div class="l-layout l-row">
                                        <div class="l-layout__inner">
                                            <?php echo $modules__footer_mid_left; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if ($page_has_footer_mid_right): ?>
                                <div class="l-box  ff-width-100--40--50" data-position="6-footer-mid-right">
                                    <div class="l-layout l-row">
                                        <div class="l-layout__inner">
                                            <?php echo $modules__footer_mid_right; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php echo $modules__footer_mid_bottom; ?>

                    <?php #if ($page_unit != 'npeu') : ?>
                    <?php #if ($page_unit != $page_brand->alias) : ?>
                    <?php if (true) : ?>
                    <div class="d-border--bottom--thick" data-fs-text="center">
                        <div class="l-layout  l-gutter  l-distribute  l-distribute--balance-top  l--basis-20">
                            <p class="l-layout__inner">
                                <?php
                                $page_units = array('pru-mnhc', 'npeu_ctu', 'sheer', 'he');
                                if (in_array($page_unit, $page_units)) : ?>
                                <span class="l-box  l-box--center">
                                    <?php /* Note the following should be made DRYer using brands info */ ?>
                                    <?php /*if ($page_unit == 'npeu') : ?>
                                    <a href="https://www.npeu.ox.ac.uk" class="c-badge  c-badge--limit-height  l-center">
                                        <img src="/assets/images/brand-logos/unit/npeu-logo.svg" onerror="this.src='/assets/images/brand-logos/unit/npeu-logo.png'; this.onerror=null;" alt="Logo: NPEU" height="80">
                                    </a>
                                    <?php else*/ if ($page_unit == 'pru-mnhc') : ?>
                                    <a href="https://www.npeu.ox.ac.uk" class="c-badge  c-badge--limit-height  l-center"><img src="/assets/images/brand-logos/unit/pru-mnhc-logo.svg" onerror="this.src='/assets/images/brand-logos/unit/pru-mnhc-logo.png'; this.onerror=null;" alt="Logo: PRU-MNHC" height="80" width="236"></a>
                                    <?php elseif ($page_unit == 'npeu_ctu') : ?>
                                    <a href="https://www.npeu.ox.ac.uk/ctu" class="c-badge  c-badge--limit-height  l-center"><img src="/assets/images/brand-logos/unit/npeu-ctu-logo.svg" onerror="this.src='/assets/images/brand-logos/unit/npeu-ctu-logo.png'; this.onerror=null;" alt="Logo: NPEU CTU" height="80" width="236"></a>
                                    <?php elseif ($page_unit == 'sheer') : ?>
                                    <a href="https://www.npeu.ox.ac.uk/sheer" class="c-badge  c-badge--limit-height  l-center"><img src="/assets/images/brand-logos/unit/sheer-logo.svg" onerror="this.src='/assets/images/brand-logos/unit/sheer-logo.png'; this.onerror=null;" alt="Logo: SHEER" height="80" width="236"></a>
                                    <?php elseif ($page_unit == 'he') : ?>
                                    <a href="https://www.npeu.ox.ac.uk/sheer" class="c-badge  c-badge--limit-height  l-center"><img src="/assets/images/brand-logos/unit/he-logo.svg" onerror="this.src='/assets/images/brand-logos/unit/he-logo.png'; this.onerror=null;" alt="Logo: Health Economics" height="80" width="236"></a>
                                    <?php endif; ?>
                                </span>
                                <?php endif; ?>

                                <span class="l-box  l-box--center">
                                    <a href="https://www.npeu.ox.ac.uk" class="c-badge  c-badge--limit-height"><img src="/assets/images/brand-logos/unit/npeu-logo.svg" onerror="this.src='/assets/images/brand-logos/unit/npeu-logo.png'; this.onerror=null;" alt="Logo: NPEU" height="80" width="183"></a>
                                </span>

                                <span class="l-box  l-box--center">
                                    <a href="http://www.ndph.ox.ac.uk/" class="c-badge  c-badge--limit-height" rel="external noopener noreferrer" target="_blank"><img src="/assets/images/brand-logos/affiliate/ndph-logo.svg" onerror="this.src='/assets/images/brand-logos/affiliate/ndph-logo.png'; this.onerror=null;" alt="Logo: Nuffield Department of Population Health" height="80" width="264"></a>
                                </span>

                                <span class="l-box  l-box--center">
                                    <a href="http://www.ox.ac.uk/" class="c-badge  c-badge--limit-height" rel="external noopener noreferrer" target="_blank"><img src="/assets/images/brand-logos/affiliate/ou-logo-rect.svg" onerror="this.src='/assets/images/brand-logos/affiliate/ou-logo-rect.png'; this.onerror=null;" alt="Logo: University of Oxford" height="80" width="260"></a>
                                </span>
                            </p>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php echo $modules__footer_bottom; ?>

                    <div class="d-background--dark  page-footer__brand-footer  <?php echo $page_brand->alias; ?>" data-fs-block="inverted flush" data-fs-text="center">

                        <div class="l-layout  l-row  l-gutter">
                            <div class="l-layout__inner">
                            <div class="l-box  l-box--center  page-footer__info-box">
                                    <?php echo $page_footer_text; ?>
                                    <p class="c-utilitext   l-layout  l-row  l-row--center  l-gutter--xs  no-print">
                                        <span role="list" class="l-layout__inner">
                                            <span role="listitem" class="l-box">
                                                <a href="https://www.npeu.ox.ac.uk"><span>NPEU Main Site</span></a>
                                            </span>

                                            <span class="l-box__separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>

                                            <span role="listitem" class="l-box">
                                                <a href="https://www.npeu.ox.ac.uk/ctu"><span>NPEU CTU Site</span></a>
                                            </span>

                                            <span class="l-box__separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>

                                            <span role="listitem" class="l-box">
                                                <a href="https://www.npeu.ox.ac.uk/pru-mnhc"><span>PRU-MNHC Site</span></a>
                                            </span>

                                            <span class="l-box__separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>

                                            <span role="listitem" class="l-box">
                                                <a href="https://www.npeu.ox.ac.uk/sheer"><span>NPEU SHEER Site</span></a>
                                            </span>
                                        </span>
                                    </p>
                                    <p class="c-utilitext   l-layout  l-row  l-row--center  l-gutter--xs  no-print">
                                        <span role="list" class="l-layout__inner">

                                            <span role="listitem" class="l-box">
                                                <a href="/about"><span>About the NPEU</span></a>
                                            </span>

                                            <span class="l-box__separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>

                                            <span role="listitem" class="l-box">
                                                <a href="/privacy-cookies"><span>Privacy &amp; Cookies</span></a>
                                            </span>

                                            <span class="l-box__separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>

                                            <span role="listitem" class="l-box">
                                                <a href="https://dev.npeu.ox.ac.uk/accessibility"><span>Accessibility</span></a>
                                            </span>

                                            <span class="l-box__separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>

                                            <span role="listitem" class="l-box">
                                                <a href="#top"><span>Top of page</span></a>
                                            </span>
                                        </span>
                                    </p>
                                    <p class="c-utilitext   l-layout  l-row  l-row--center  l-gutter--xs">
                                        <span class="l-layout__inner">
                                            <span class="l-box">
                                                © NPEU <?php echo date('Y'); ?>
                                            </span>
                                        </span>
                                    </p>
                                </div>

                                <div class="l-box  l-box--center">
                                    <p class="c-panel  c-panel--rounded  d-background--white  d-border--thick">
                                        <a href="https://www.npeu.ox.ac.uk/about/athena-swan" class="c-badge  c-badge--limit-height">
                                            <img src="/assets/images/brand-logos/accolade/athena-swan-silver-logo.svg" onerror="this.src='/assets/images/brand-logos/accolade/athena-swan-silver-logo.png'; this.onerror=null;" alt="Logo: Athena Swan Silver Award" height="80" width="129">
                                        </a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                </footer>
            </div>

        </div>
    </div>

    <?php if (!empty($doc->include_avatar_modal)): ?>
    <div class="dialog" id="avatar-dialog" aria-hidden="true" data-a11y-dialog="#top">
        <div class="dialog-overlay" tabindex="-1" data-a11y-dialog-hide></div>
        <div role="alertdialog" class="dialog-content" aria-label="Avatar image upload and edit dialog">
            <button data-a11y-dialog-hide class="dialog-close  close-button" aria-label="Close this dialog window"><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none" class="icon  icon--is-open"><use xlink:href="#icon-cross"></use></svg></button>
            <div role="document">
                  <iframe id="avatar-image-editor" frameborder="0" width="756" height="720"></iframe>
            </div>
            <button data-a11y-dialog-hide class="dialog-close  close-button" aria-label="Close this dialog window"><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none" class="icon  icon--is-open"><use xlink:href="#icon-cross"></use></svg></button>
        </div>
    </div>
    <?php endif; ?>