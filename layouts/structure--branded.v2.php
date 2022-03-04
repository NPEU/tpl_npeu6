    <div class="l-layout  page-wrap" data-brand="<?php echo $page_brand->alias; ?>">
        <div class="l-layout__inner">

            <?php if ($env == 'testing' || $env == 'development') : ?>
            <div class="env_container">
                <div>
                    <fieldset role="presentation">
                        <p>
                            <?php echo strtoupper($env); ?> V2
                        </p>
                        <button id="env-msg-close" aria-labelledby="env-msg-close-label" onclick="this.parentNode.parentNode.parentNode.style.display='none'">
                            <span id="env-msg-close-label" hidden>Close this notice</span>
                            <svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em"><use xlink:href="#icon-cross"></use></svg>
                        </button>
                    </fieldset>
                </div>
            </div>
            <?php endif; ?>

            <div class="l-box">

                <header aria-label="Page" class="page-header">
                    <div class="l-layout  l-row  l-row--push-apart  l-gutter--s  l-flush-block-gutter">
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
                                            <p class="c-utilitext  no-print">
                                                <a href="/staff-area"><span>Staff Area</span></a>
                                                <?php if($user->get('is_staff')): ?>
                                                | <a href="http://api.qrserver.com/v1/create-qr-code/?data=http://qr.npeu.ox.ac.uk/<?php echo $menu_item->id; ?>&amp;format=eps" class="icon  icon-qrcode"><span>QR code (eps)</span></a>
                                                <?php endif; ?>
                                                <?php if ($user->authorise("core.edit", "com_menus.menu." . $menu_id)): ?>
                                                | <a href="/administrator/index.php?option=com_menus&view=item&client_id=0&layout=edit&id=<?php echo $menu_item->id; ?>" target="_blank" class="u-padding--right--s"><span>Edit page</span>&nbsp;<svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em"><use xlink:href="#icon-edit"></use></svg></a>
                                                <?php endif; ?>
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


                    <div class="l-layout  l-distribute  l-gutter">
                        <p class="l-layout__inner"<?php if (!$page_display_cta) : ?> data-js="cmr" data-ie-safe-parent-level="1"<?php endif; ?>>

                            <span class="l-box"<?php if (!$page_display_cta) : ?> data-min-width="229"<?php endif; ?>>
                                <a href="/<?php echo $page_brand->alias == 'npeu' ? '' : $page_brand->alias; ?>" class="c-badge  c-badge--primary-logo">
                                    <?php echo str_replace('height="100"', 'height="100" width="' . $page_brand->svg_width_at_height_100 . '"', $page_brand->logo_svg_with_fallback); ?>
                                 </a>
                            </span>

                            <?php if ($page_display_cta) : ?>
                            <span class="l-box  l-box--center  l-box--push-apart">
                                <a href="<?php echo $page_cta_url; ?>" class="c-primary-cta  d-background  t-secondary"><?php echo $page_cta_text; ?></a>
                            </span>
                            <?php endif; ?>
                            <?php
                                if ($page_brand->alias == 'npeu') {
                                    $second_brand_id = 122;

                                } else {
                                    $parent_brand_alias_id = [
                                        'pru-mnhc' => 28,
                                        'npeu_ctu' => 14,
                                        'sheer'    => 16,
                                        'he'       => 106
                                    ];
                                    $second_brand_id = $parent_brand_alias_id[$page_brand->alias];
                                }

                                $second_brand = TplNPEU6Helper::get_brand($second_brand_id);
                                $second_brand_url = 'http://www.npeu.ox.ac.uk';
                                if ($page_brand->alias == 'npeu') {
                                    $second_brand_width = $second_brand->svg_width_at_height_100;
                                } else {
                                    $second_brand_url .= '/' . ($page_unit == 'he') ? 'sheer' : $second_brand->alias;
                                    $second_brand_width = $second_brand->svg_width_at_height_80;
                                }

                           ?>
                            <span class="l-box"<?php if (!$page_display_cta) : ?> data-min-width="<?php echo $second_brand_width; ?>"<?php endif; ?>>
                                <a href="<?php echo $second_brand_url; ?>" class="c-badge  c-badge--primary-logo">
                                    <?php if ($page_brand->alias == 'npeu') : ?>
                                    <?php echo str_replace('height="80"', 'height="100" width="' . $second_brand_width . '"', $second_brand->logo_svg_with_fallback); ?>
                                    <?php else: ?>
                                    <img src="<?php echo $second_brand->logo_svg_path; ?>" onerror="this.src='<?php echo $second_brand->logo_png_path; ?>'; this.onerror=null;" alt="Logo: <?php echo $second_brand->name; ?>" height="80" width="<?php $second_brand_width; ?>">
                                    <?php endif; ?>
                                </a>
                            </span>

                        </p>
                    </div>


                    <?php if($page_has_navbar) : ?>
                    <div class="d-background">
                        <div class="nav-bar js-cmr--wide" data-js="cmr">

                            <div class="nav-bar__start" data-area="navbar-controls">
                                <?php if ($modules__header_nav_bar != '') : ?>
                                <div class="nav-bar__item">
                                    <button class="over-panel-control" hidden="" aria-controls="menu-panel" aria-label="Main menu" aria-expanded="false" data-js="overpanel__control"><svg display="none" focusable="false" class="icon  icon--is-closed" width="1.25em" height="1.25em"><use xlink:href="#icon-menu"></use></svg><svg display="none" focusable="false" class="icon  icon--is-open" width="1.25em" height="1.25em"><use xlink:href="#icon-cross"></use></svg></button>
                                </div>
                                <?php endif; ?>
                                <div class="nav-bar__item">
                                    <button class="over-panel-control" hidden="" aria-controls="search-panel" aria-label="Search" aria-expanded="false" data-js="overpanel__control"><svg display="none" focusable="false" class="icon  icon--is-closed" width="1.25em" height="1.25em"><use xlink:href="#icon-search"></use></svg><svg display="none" focusable="false" class="icon  icon--is-open" width="1.25em" height="1.25em"><use xlink:href="#icon-cross"></use></svg></button>
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
                                            <button class="search-form__submit" type="submit">
                                                <span>
                                                    <svg width="1.25em" height="1.25em" viewBox="0 0 20 20" focusable="false">
                                                        <path fill="currentColor" d="M12.917 11.667h-0.662l-0.229-0.229c0.817-0.946 1.308-2.175 1.308-3.521 0-2.992-2.425-5.417-5.417-5.417s-5.417 2.425-5.417 5.417 2.425 5.417 5.417 5.417c1.346 0 2.575-0.492 3.521-1.304l0.229 0.229v0.658l4.167 4.158 1.242-1.242-4.158-4.167zM7.917 11.667c-2.071 0-3.75-1.679-3.75-3.75s1.679-3.75 3.75-3.75 3.75 1.679 3.75 3.75-1.679 3.75-3.75 3.75z"></path>
                                                        <text y="-10">Search</text>
                                                    </svg>
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

                <main id="main" aria-labelledby="<?php echo TplNPEU6Helper::html_id($page_heading); ?>">

                    <?php if($page_has_hero) : ?>
                    <?php if($page_has_carousel) : ?>
                    <?php
                        $needs_wide = false;
                        foreach ($page_heroes as $key => $page_hero) {
                            if (!empty($page_hero->heading)) {
                                $needs_wide = true;
                            }
                        }
                    ?>
                    <fieldset role="region" aria-label="banner slides" class="c-hero-wrap  c-hero-carousel<?php echo $needs_wide ? '  c-hero__message--wide' : ''; ?>  d-border--bottom--thick">
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
                    <fieldset role="presentation" class="c-hero-wrap<?php echo (!empty($page_hero->heading)) ? '  c-hero__message--wide' : ''; ?>  d-border--top--thick  d-border--bottom--thick" data-fs-text="center">
                    <?php endif; /* @TODO - need to think about credit lines. */ ?>
                            <?php $i = 0; foreach ($page_heroes as $key => $page_hero) : $i++; ?>
                                <?php if($page_has_carousel) : ?>
                                <hr noShade size="1">
                                <?php endif; ?>
                                <div id="banner<?php if($page_has_carousel) : ?>-slide-<?php echo $i; ?><?php endif; ?>"<?php if($page_has_carousel) : ?>role="listitem"<?php endif; ?> class="c-hero  c-info-overlay-wrap<?php echo (isset($page_hero->text_position) && $page_hero->text_position == 1) ? '' : '  c-hero--reversed'; ?>">
                                    <div data-fs-block="border">
                                        <div class="c-hero__image">
                                            <div class="u-image-cover  js-image-cover  u-image-cover--min-40  u-image-cover--min-25--wide">
                                                <div class="u-image-cover__inner">
                                                    <img src="<?php echo $page_hero->image; ?>?s=300" sizes="100vw" srcset="<?php echo $page_hero->image; ?>?s=1600 1600w, <?php echo $page_hero->image; ?>?s=900 900w, <?php echo $page_hero->image; ?>?s=300 300w" alt="<?php echo $page_hero->alt; ?>" class="u-image-cover__image" width="200">
                                                </div>
                                            </div>
                                        </div>

                                        <?php if ($page_hero->credit): ?>
                                        <details class="c-info-overlay  c-info-overlay--half-width">
                                            <summary><span>Details</span><svg display="none" width="1.25em" height="1.25em" focusable="false" class="icon  icon--is-closed"><use xlink:href="#icon-info"></use></svg><svg display="none" width="1.25em" height="1.25em" focusable="false" class="icon  icon--is-open"><use xlink:href="#icon-cross"></use></svg></summary>
                                            <div><?php echo $page_hero->credit; ?></div>
                                        </details>
                                        <?php endif; ?>

                                        <?php if (!empty($page_hero->heading) || !empty($page_hero->text) || (!empty($page_hero->cta_link) && !empty($page_hero->cta_text))) : ?>
                                        <div class="c-hero__message"<?php echo (!empty($page_hero->text_width)) ? ' style="width: calc(' . $page_hero->text_width . 'em + 10%);"' : ''; ?>>
                                            <?php if (!empty($page_hero->heading)) :
                                                $h = $i > 0 ? '2' : '1';
                                            ?>
                                            <h<?php echo $h; ?> class="c-hero__message--fluid_heading" id="<?php echo TplNPEU6Helper::html_id($page_heading); ?>" <?php /* not 100% sure this is needed: tabindex="-1"*/ ?>><?php echo $page_hero->heading; ?></h<?php echo $h; ?>>
                                            <?php endif; ?>
                                            <p class="c-hero__message--fluid_text"><?php echo $page_hero->text; ?></p>
                                            <?php if (!empty($page_hero->cta_link) && !empty($page_hero->cta_text)) : ?>
                                            <p class="c-hero__cta"><a href="<?php echo $page_hero->cta_link; ?>" class="c-cta"><?php echo $page_hero->cta_text; ?><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em"><use xlink:href="#icon-chevron-right"></use></svg></a></p>
                                            <?php endif; ?>
                                        </div>

                                        <?php endif; ?>

                                    </div>
                                </div>
                            <?php endforeach; ?>

                        <?php if($page_has_carousel) : ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </fieldset>
                    <?php endif; /* End $page_has_hero */ ?>


                    <br id="highlighter-start" />

                    <div class="d-border--bottom--thick">
                        <?php if ($page_is_landing) : ?>
                        <!-- Page is landing -->
                        <?php if ($show_page_heading) : /* E.g. /news NOT DONE >>>> */?>
                        <!-- Page Heading -->
                        <div class="c-panel  n--page-is-landing">
                            <?php if (isset($doc->header_cta) || $is_blog) : ?>
                            <header>
                                <h1 id="<?php echo TplNPEU6Helper::html_id($page_heading); ?>" tabindex="-1">TO DO<?php echo $page_heading; ?></h1>
                                <p>
                                    <?php if (isset($doc->header_cta)) : /* E.g. User Profile (Edit CTA) */ ?>
                                    <a href="<?php echo $doc->header_cta['url']; ?>" class="c-cta  c-cta--has-icon"><?php echo $doc->header_cta['text']; ?><svg display="none" focusable="false" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg></a>
                                    <?php endif; ?>
                                    <?php if ($is_blog && $page_is_subroute == false && $has_add_form_child == false) : /* E.g. What's New */ ?>
                                    <a href="<?php echo $uri->getPath(); ?>?format=feed&type=rss" class="c-cta  c-cta--has-icon">RSS Feed<svg display="none" focusable="false" class="icon" aria-hidden="true"><use xlink:href="#icon-rss"></use></svg></a>
                                    <?php endif; ?>
                                    <?php if ($has_add_form_child && $page_is_subroute == false) : /* E.g. Staff Notices */ ?>
                                    <a href="<?php echo $add_form_child_url; ?>" class="c-cta  c-cta--has-icon">Add new &nbsp;<svg display="none" focusable="false" class="icon" aria-hidden="true"><use xlink:href="#icon-edit"></use></svg></a>
                                    <?php endif; ?>
                                </p>
                            </header>
                            <?php else : ?>
                            <h1 id="<?php echo TplNPEU6Helper::html_id($page_heading); ?>" tabindex="-1"><?php echo $page_heading; ?></h1>
                            <?php endif; ?>
                        </div>
                        <?php endif; /* <<<< */ ?>

                        <?php echo TplNPEU6Helper::get_messages(); ?>

                        <jdoc:include type="component" format="raw" />

                        <?php else : /* NOT DONE >>>> */ ?>
                        <!-- Page is NOT landing -->
                        <div class="l-primary-content<?php if ($page_has_pull_outs) : ?>  l-primary-content--has-pull-outs<?php endif; ?>   n--page-not-landing">

                            <?php if ($page_has_sidebar_super) : ?>
                            <?php if ($page_badge) : ?>
                            <div class="l-primary-content__pull-out  l-primary-content__pull-out--super  l-primary-content__pull-out__margin--@large  u-space--above  u-text-align--center">
                                <?php echo $page_badge; ?>
                            </div>
                            <?php endif; ?>
                            <?php endif; ?>

                            <div class="l-primary-content__header">

                                <?php echo $modules__main_upper; /*<jdoc:include type="modules" name="3-main-upper" style="basic" />*/?>

                                <div class="c-panel">
                                    <?php if (isset($doc->header_cta) || $is_blog) : ?>
                                    <header>
                                        <h1 id="<?php echo TplNPEU6Helper::html_id($page_heading); ?>" tabindex="-1"><?php echo $page_heading; ?></h1>
                                        <p>
                                            <?php if (isset($doc->header_cta)) : ?>
                                            <a href="<?php echo $doc->header_cta['url']; ?>" class="c-cta  c-cta--has-icon"><?php echo $doc->header_cta['text']; ?><svg display="none" focusable="false" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg></a>
                                            <?php endif; ?>
                                            <?php if ($is_blog && $page_is_subroute == false && $has_add_form_child == false) : ?>
                                            <a href="<?php echo $uri->getPath(); ?>?format=feed&type=rss" class="c-cta  c-cta--has-icon">RSS Feed<svg display="none" focusable="false" class="icon" aria-hidden="true"><use xlink:href="#icon-rss"></use></svg></a>
                                            <?php endif; ?>
                                            <?php if ($has_add_form_child && $page_is_subroute == false) : ?>
                                            <a href="<?php echo $add_form_child_url; ?>" class="c-cta  c-cta--has-icon">Add new &nbsp;<svg display="none" focusable="false" class="icon" aria-hidden="true"><use xlink:href="#icon-edit"></use></svg></a>
                                            <?php endif; ?>
                                        </p>
                                    </header>
                                    <?php else : ?>
                                    <h1 id="<?php echo TplNPEU6Helper::html_id($page_heading); ?>" tabindex="-1"><?php echo $page_heading; ?></h1>
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
                                    <p class="l-primary-content__hidden--wide  c-utilitext  u-text-align--right">
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
                            <div class="l-primary-content__pull-out  l-primary-content__pull-out--top">
                                <?php if ($page_has_priority_content) : ?>
                                <div class="l-primary-content__pull-out__padded--@small  c-user-content" data-contains="priority-content">
                                    <?php echo JHtml::_('content.prepare', $doc->article->introtext); ?>
                                </div>
                                <?php endif; ?>
                                <?php echo $page_toc; ?>
                                <?php echo $component__sidebar_top; ?>
                                <?php echo $modules__sidebar_top; /*<jdoc:include type="modules" name="4-sidebar-top" style="sidebar" />*/?>

                            </div>
                            <?php endif; ?>

                            <div class="l-primary-content__main  u-space--below">

                                <div class="c-panel  u-padding--top--none">
                                    <?php if ($page_has_article) : ?>
                                    <div class="c-longform-content  c-user-content">
                                        <?php if (!empty($doc->article->headline_image['headline-image']) && $show_headline_image == 1) : ?>
                                        <div class="u-space--below">
                                            <div class="l-proportional-container  l-proportional-container--2-1">
                                                <div class="l-proportional-container__content">
                                                    <div class="u-image-cover  js-image-cover">
                                                        <div class="u-image-cover__inner">
                                                            <img class="u-image-cover__image" src="<?php echo $doc->article->headline_image['headline-image']; ?>?s=700" alt="<?php echo $doc->article->headline_image['headline-image-alt-text']; ?>" sizes="(max-width: 380px) 350px, 90vw" srcset="<?php echo $doc->article->headline_image['headline-image']; ?>?s=350 350w, <?php echo $doc->article->headline_image['headline-image']; ?>?s=700 700w" width="700">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if (!empty($doc->article->headline_image['headline-image-credit-line'])) : ?>
                                            <p class="c-utilitext  c-utilitext--smaller  c-utilitext--pale">
                                                Credit: <?php echo $doc->article->headline_image['headline-image-credit-line']; ?>
                                            </p>
                                            <?php endif; ?>
                                        </div>
                                        <?php endif; ?>
                                        <?php if ($page_has_priority_content) : ?>
                                        <?php echo JHtml::_('content.prepare', $doc->article->fulltext); ?>
                                        <?php else : ?>
                                        <?php echo JHtml::_('content.prepare', $doc->article->introtext); ?>
                                        <?php echo JHtml::_('content.prepare', $doc->article->fulltext); ?>
                                        <?php endif; ?>
                                    </div>
                                    <?php else : ?>
                                    <jdoc:include type="component" format="raw" />
                                    <?php endif; ?>
                                </div>
                                <?php if ($page_has_article) : ?>
                                <?php if ($page_article_brand) : ?>
                                <div class="u-max-measure  u-padding--s">
                                    <p>
                                        <a href="/<?php echo $page_article_brand->alias; ?>" class="c-badge  c-badge--limit-height--6">
                                            <img alt="Logo: <?php echo $page_article_brand->name; ?>" height="60" onerror="this.src='<?php echo $page_article_brand->logo_png_path; ?>'; this.onerror=null;" src="<?php echo $page_article_brand->logo_svg_path; ?>">
                                        </a>
                                    </p>
                                </div>
                                <?php endif; ?>
                                <footer class="t-neutral  d-background--very-light  u-max-measure  u-padding--s">

                                    <p class="c-utilitext  u-text-group  u-text-group--push-apart">
                                        <?php if ($is_blog && !empty($doc->article->publish_up)) : ?>
                                        <?php if ($doc->article->params->get('show_author')) : ?>
                                        <span>Posted by: <?php echo $doc->article->author; ?></span>
                                        <?php endif; ?>
                                        <span>Published on <?php echo JHtml::_('date', $doc->article->publish_up, JText::_('DATE_FORMAT_LC1')); ?></span>
                                        <?php else : ?>
                                        <span>Updated: <?php echo JHtml::_('date', $doc->article->modified, JText::_('DATE_FORMAT_LC2')); ?> (v<?php echo $doc->article->version; ?>)</span>
                                        <?php endif; ?>
                                        <?php if ($user->authorise("core.edit", "com_content.article." . $doc->article->id)): ?><a href="<?php echo $has_add_form_child ? $uri_route . '?task=article.edit&a_id=' . $doc->article->id : '/administrator/index.php?option=com_content&amp;task=article.edit&amp;id=' . $doc->article->id . '" target="_blank"'; ?>" class="u-padding--right--s"><span>Edit content</span><svg display="none" focusable="false" class="icon  u-space--left--xs" aria-hidden="true"><use xlink:href="#icon-edit"></use></svg></a><?php endif; ?>
                                    </p>
                                </footer>
                                <?php endif; ?>
                                <?php if (!empty($doc->article->pagination)) : ?>
                                <div class="u-space--below">
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
                            <div class="l-primary-content__pull-out  l-primary-content__pull-out--bottom">
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
                <footer class="sticky-footer" id="page-footer" aria-label="Page">

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
                                    <?php echo $modules__footer_mid_left; ?>
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
                    <div class="d-border--bottom--thick">
                        <div class="l-layout  l-gutter  l-distribute  l-distribute--balance-top  l--basis-20">
                            <div class="l-layout__inner">
                                <?php
                                $page_units = array('pru-mnhc', 'npeu_ctu', 'sheer', 'he');
                                if (in_array($page_unit, $page_units)) : ?>
                                <p class="l-box  l-box--center">
                                    <?php /* Note the following should be made DRYer using brands info */ ?>
                                    <?php /*if ($page_unit == 'npeu') : ?>
                                    <a href="https://www.npeu.ox.ac.uk" class="c-badge  c-badge--limit-height  l-center">
                                        <img src="/assets/images/brand-logos/unit/npeu-logo.svg" onerror="this.src='/assets/images/brand-logos/unit/npeu-logo.png'; this.onerror=null;" alt="Logo: NPEU" height="80">
                                    </a>
                                    <?php else*/ if ($page_unit == 'pru-mnhc') : ?>
                                    <a href="https://www.npeu.ox.ac.uk" class="c-badge  c-badge--limit-height  l-center">
                                        <img src="/assets/images/brand-logos/unit/pru-mnhc-logo.svg" onerror="this.src='/assets/images/brand-logos/unit/pru-mnhc-logo.png'; this.onerror=null;" alt="Logo: PRU-MNHC" height="80">
                                    </a>
                                    <?php elseif ($page_unit == 'npeu_ctu') : ?>
                                    <a href="https://www.npeu.ox.ac.uk/ctu" class="c-badge  c-badge--limit-height  l-center">
                                        <img src="/assets/images/brand-logos/unit/npeu-ctu-logo.svg" onerror="this.src='/assets/images/brand-logos/unit/npeu-ctu-logo.png'; this.onerror=null;" alt="Logo: NPEU CTU" height="80">
                                    </a>
                                    <?php elseif ($page_unit == 'sheer') : ?>
                                    <a href="https://www.npeu.ox.ac.uk/sheer" class="c-badge  c-badge--limit-height  l-center">
                                        <img src="/assets/images/brand-logos/unit/sheer-logo.svg" onerror="this.src='/assets/images/brand-logos/unit/sheer-logo.png'; this.onerror=null;" alt="Logo: SHEER" height="80">
                                    </a>
                                    <?php elseif ($page_unit == 'he') : ?>
                                    <a href="https://www.npeu.ox.ac.uk/sheer" class="c-badge  c-badge--limit-height  l-center">
                                        <img src="/assets/images/brand-logos/unit/he-logo.svg" onerror="this.src='/assets/images/brand-logos/unit/he-logo.png'; this.onerror=null;" alt="Logo: Health Economics" height="80">
                                    </a>
                                    <?php endif; ?>
                                </p>
                                <?php endif; ?>

                                <p class="l-box  l-box--center">
                                    <a href="https://www.npeu.ox.ac.uk" class="c-badge  c-badge--limit-height">
                                        <img src="/assets/images/brand-logos/unit/npeu-logo.svg" onerror="this.src='/assets/images/brand-logos/unit/npeu-logo.png'; this.onerror=null;" alt="Logo: NPEU" height="80" width="183">
                                    </a>
                                </p>

                                <p class="l-box  l-box--center">
                                    <a href="http://www.ndph.ox.ac.uk/" class="c-badge  c-badge--limit-height" rel="external noopener noreferrer" target="_blank">
                                        <img src="/assets/images/brand-logos/affiliate/ndph-logo.svg" onerror="this.src='/assets/images/brand-logos/affiliate/ndph-logo.png'; this.onerror=null;" alt="Logo: Nuffield Department of Population Health" height="80" width="264">
                                    </a>
                                </p>

                                <p class="l-box  l-box--center">
                                    <a href="http://www.ox.ac.uk/" class="c-badge  c-badge--limit-height" rel="external noopener noreferrer" target="_blank">
                                        <img src="/assets/images/brand-logos/affiliate/ou-logo-rect.svg" onerror="this.src='/assets/images/brand-logos/affiliate/ou-logo-rect.png'; this.onerror=null;" alt="Logo: University of Oxford" height="80" width="260">
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php echo $modules__footer_bottom; ?>

                    <div class="d-background--dark  page-footer">

                        <div class="l-layout  l-row  l-gutter">
                            <div class="l-layout__inner">
                                <div class="l-box  l-box--center">
                                    <p role="list" class="c-utilitext  l-layout  l-row  l-row--center  l-gutter--s">
                                        <span class="l-layout__inner">
                                            <?php echo $page_footer_text; ?>
                                        </span>
                                    </p>
                                    <p role="list" class="c-utilitext  l-layout  l-row  l-row--center  l-gutter--s">
                                        <span class="l-layout__inner">
                                            <span role="listitem" class="l-box">
                                                <a href="https://www.npeu.ox.ac.uk"><span>NPEU Main Site</span></a><span class="l-box__separator">&nbsp;&nbsp;|</span>
                                            </span>
                                            <span role="listitem" class="l-box">
                                                <a href="https://www.npeu.ox.ac.uk/ctu"><span>NPEU CTU Site</span></a><span class="l-box__separator">&nbsp;&nbsp;|</span>
                                            </span>
                                            <span role="listitem" class="l-box">
                                                <a href="https://www.npeu.ox.ac.uk/pru-mnhc"><span>PRU-MNHC Site</span></a><span class="l-box__separator">&nbsp;&nbsp;|</span>
                                            </span>
                                            <span role="listitem" class="l-box">
                                                <a href="https://www.npeu.ox.ac.uk/sheer"><span>NPEU SHEER Site</span></a>
                                            </span>

                                        </span>
                                    </p>
                                    <p class="c-utilitext">
                                        © NPEU <?php echo date('Y'); ?>
                                    </p>
                                </div>
                                <div class="l-box  l-box--center">
                                    <div class="d-border--thick">
                                        <p class="c-panel  d-background--white">
                                            <a href="https://www.npeu.ox.ac.uk/about/athena-swan" class="c-badge  c-badge--limit-height">
                                                <img src="/assets/images/brand-logos/accolade/athena-swan-silver-logo.svg" onerror="this.src='/assets/images/brand-logos/accolade/athena-swan-silver-logo.png'; this.onerror=null;" alt="Logo: Athena Swan Silver Award" height="80" width="129">
                                            </a>
                                        </p>
                                    </div>
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
            <button data-a11y-dialog-hide class="dialog-close  close-button" aria-label="Close this dialog window"><svg focusable="false" class="icon  icon--is-open"><use xlink:href="#icon-cross"></use></svg></button>
            <div role="document">
                  <iframe id="avatar-image-editor" frameborder="0" width="756" height="720"></iframe>
            </div>
            <button data-a11y-dialog-hide class="dialog-close  close-button" aria-label="Close this dialog window"><svg focusable="false" class="icon  icon--is-open"><use xlink:href="#icon-cross"></use></svg></button>
        </div>
    </div>
    <?php endif; ?>