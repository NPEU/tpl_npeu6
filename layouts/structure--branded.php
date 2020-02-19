    <div class="sticky-footer-wrap  c-page-wrap"  data-brand="<?php echo $page_brand->alias; ?>">

        <header class="c-page-header  t-<?php echo $page_brand->alias; ?>" aria-label="Page">

            <div class="u-text-group  u-text-group--push-apart  u-padding--sides--s">
                <ul class="c-utilitext  c-utilitext--skiplinks">
                    <li><a href="#main"><span>Skip to content</span></a></li>
                    <li><a href="#primary-nav"><span>Skip to navigation</span></a></li>
                    <li><a href="#page-footer"><span>Skip to footer</span></a></li>
                </ul>
                <p class="c-utilitext  no-print">
                    <?php if(!$user->get('guest')): ?>
                    <a href="/user-profile"><span><strong><?php echo $user->username; ?></strong></span></a> (<a href="/logout<?php /*echo '?' . JSession::getFormToken(); ?>=1&amp;return=<?php echo base64_encode('/login?logged-out'); */?>"><span>logout</span></a>)<?php if($user->get('is_staff')): ?> | <a href="/administrator"><span>Admin</span></a><?php endif; ?>
                    <?php else: ?>
                    <a href="/login"><span>NPEU Login</span></a>
                    <?php endif; ?>
                    | <a href="https://intranet.npeu.ox.ac.uk"><span>Staff Area</span></a>
                    <?php if($user->get('is_staff')): ?>
                    | <a href="http://api.qrserver.com/v1/create-qr-code/?data=http://qr.npeu.ox.ac.uk/<?php echo $menu_id; ?>&amp;format=eps" class="icon  icon-qrcode"><span>QR code (eps)</span></a>
                    <?php endif; ?>
                    <?php if ($user->authorise("core.edit", "com_menus.menu." . $menu_id)): ?>
                    | <a href="/administrator/index.php?option=com_menus&view=item&client_id=0&layout=edit&id=<?php echo $menu_item->id; ?>" target="_blank" class="u-padding--right--s"><span>Edit page</span><svg display="none" class="icon  u-space--left--xs" aria-hidden="true"><use xlink:href="#icon-edit"></use></svg></a>
                    <?php endif; ?>
                </p>
            </div>

            <div class="u-padding--bottom--s">
                <div class="l-col-to-row-wrap">
                    <div class="l-col-to-row">
                        <div class="l-col-to-row__item  ff-width-100--40--<?php echo $header_balance[0]; ?>  u-text-align--left  c-page-header__first  u-padding--top--s  u-padding--sides--s">
                            <a href="/<?php echo $page_brand->alias == 'npeu' ? '' : $page_brand->alias; ?>" class="c-badge  c-badge--primary-logo">
                                <?php echo $page_brand->logo_svg_with_fallback; ?>
                            </a>
                        </div>

                        <?php if ($page_display_cta || $page_unit == 'npeu') : ?>
                        <div class="l-col-to-row__item  ff-width-100--40--<?php echo $header_balance[1]; ?>  l-center  u-padding--top--s  u-padding--sides--s">
                            <?php if ($page_display_cta) : ?>
                            <span>
                                <a href="<?php echo $page_cta_url; ?>" class="c-primary-cta  t-<?php echo $page_brand->alias; ?>"><?php echo $page_cta_text; ?></a>
                            </span>
                            <?php endif; ?>
                            <?php if ($page_unit == 'npeu') : ?>
                            <div class="l-distribute-wrap">
                                <div class="l-distribute  l-distribute--gutter--small  l-distribute--limit-15">
                                    <div class="u-padding--s  l-center">
                                        <a href="http://www.ndph.ox.ac.uk/" class="c-badge  c-badge--limit-height" rel="external noopener noreferrer" target="_blank">
                                            <img src="/img/brand-logos/affiliate/ndph-logo.svg" onerror="this.src='/img/brand-logos/affiliate/ndph-logo.png'; this.onerror=null;" alt="Logo: Nuffield Department of Population Health" height="50">
                                        </a>
                                    </div>

                                    <div class="u-padding--s  l-center">
                                        <a href="http://www.ox.ac.uk/" class="c-badge  c-badge--limit-height" rel="external noopener noreferrer" target="_blank">
                                            <img src="/img/brand-logos/affiliate/ou-logo-rect.svg" onerror="this.src='/img/brand-logos/affiliate/ou-logo-rect.png'; this.onerror=null;" alt="Logo: University of Oxford" height="60">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php if($page_has_navbar) : ?>
            <div class="nav-bar  u-padding--sides--s  t-<?php echo $page_brand->alias; ?>">

                <div class="nav-bar__start" data-area="navbar-controls">
                    <?php if ($modules__header_nav_bar != '') : ?>
                    <div class="nav-bar__item">
                        <button class="over-panel-control t-<?php echo $page_brand->alias; ?> js-over-panel-control" hidden="" aria-controls="menu-panel" aria-label="Main menu" aria-expanded="false" data-js="overpanel__control"><svg display="none" class="icon  icon--is-closed"><use xlink:href="#icon-menu"></use></svg><svg display="none" class="icon  icon--is-open"><use xlink:href="#icon-cross"></use></svg></button>
                    </div>
                    <?php endif; ?>
                    <div class="nav-bar__item">
                        <button class="over-panel-control t-<?php echo $page_brand->alias; ?> js-over-panel-control" hidden="" aria-controls="search-panel" aria-label="Search" aria-expanded="false" data-js="overpanel__control"><svg display="none" class="icon  icon--is-closed"><use xlink:href="#icon-search"></use></svg><svg display="none" class="icon  icon--is-open"><use xlink:href="#icon-cross"></use></svg></button>
                    </div>
                </div>

                <nav class="nav-bar__main" id="primary-nav" aria-label="Primary" data-area="main-nav">

                    <div class="over-panel over-panel--fade js-over-panel" id="menu-panel" data-js="over-panel">
                        <button class="over-panel__overlay  t-<?php echo $page_brand->alias; ?>" hidden="" aria-hidden="true" tabindex="-1" data-js="over-panel__overlay"></button>
                        <div class="over-panel__contents  t-<?php echo $page_brand->alias; ?>" data-js="over-panel__contents">
                            <?php echo $modules__header_nav_bar; /*<jdoc:include type="modules" name="2-header-nav-bar" style="basic" />*/?>
                        </div>
                    </div>

                </nav>

                <div class="nav-bar__end" data-area="search-form">
                    <div class="over-panel over-panel--fade js-over-panel" id="search-panel" data-js="over-panel">
                        <button class="over-panel__overlay  t-<?php echo $page_brand->alias; ?>" hidden="" aria-hidden="true" tabindex="-1" data-js="over-panel__overlay"></button>
                        <div class="over-panel__contents  t-<?php echo $page_brand->alias; ?>" data-js="over-panel__contents">
                            <form action="<?php echo ($page_brand->alias != 'npeu') ? '/' . $page_brand->alias : ''; ?>/search" id="searchform" class="search-form  search-form---restrict-width  t-<?php echo $page_brand->alias; ?>  u-space--left--auto" method="GET">
                                <?php if ($page_search_area != ''): ?>
                                <input type="hidden" value="<?php echo $page_search_area; ?>" name="t[]">
                                <?php endif; ?>
                                <input type="search" class="search-form__field" id="search" placeholder="Search" name="q" value="" aria-label="Search">
                                <button class="search-form__submit" type="submit">
                                    <span>
                                        <svg width="20" height="20" viewBox="0 0 20 20">
                                            <path fill="#ffffff" d="M12.917 11.667h-0.662l-0.229-0.229c0.817-0.946 1.308-2.175 1.308-3.521 0-2.992-2.425-5.417-5.417-5.417s-5.417 2.425-5.417 5.417 2.425 5.417 5.417 5.417c1.346 0 2.575-0.492 3.521-1.304l0.229 0.229v0.658l4.167 4.158 1.242-1.242-4.158-4.167zM7.917 11.667c-2.071 0-3.75-1.679-3.75-3.75s1.679-3.75 3.75-3.75 3.75 1.679 3.75 3.75-1.679 3.75-3.75 3.75z"></path>
                                            <text y="-10">Search</text>
                                        </svg>
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <?php endif; ?>
            <?php if(!empty($modules__main_breadcumbs) && $menu_item->alias != $page_brand->alias) : ?>
            <div class="u-padding--sides  u-padding--bottom--xs  u-padding--top--xs  d-background--dark  t-<?php echo $page_brand->alias; ?>" data-area="breadcrumbs">
                <?php echo $modules__main_breadcumbs; /*<jdoc:include type="modules" name="3-main-breadcrumbs" style="basic" />*/?>
            </div>
            <?php endif; ?>
        </header>

        <?php if($page_has_hero) : ?>
            <?php if($page_has_carousel) : ?>
        <!-- @TOTO -->
            <?php else: /* @TODO - need to think about credit lines. */?>
        <div id="hero" class="c-hero<?php echo (isset($page_hero->text_position) && $page_hero->text_position == 1) ? '' : '  c-hero--reversed'; ?>  d-bands--bottom  t-<?php echo $page_brand->alias; ?>">
            <div class="c-hero__image">
                <div class="l-proportional-container  l-proportional-container--3-1  l-proportional-container--5-1--wide">
                    <div class="l-proportional-container__content">
                        <div class="u-image-cover  js-image-cover">
                            <div class="u-image-cover__inner">
                                <img src="<?php echo $page_hero->image; ?>?s=300" sizes="100vw" srcset="<?php echo $page_hero->image; ?>?s=1600 1600w, <?php echo $page_hero->image; ?>?s=900 900w, <?php echo $page_hero->image; ?>?s=300 300w" alt="<?php echo $page_hero->alt; ?>" class="u-image-cover__image" width="200">
                                <?php if ($page_hero->credit): ?>
                                <small class="c-hero__image-credit"><?php echo $page_hero->credit; ?></small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (!empty($page_hero->heading) || !empty($page_hero->text) || (!empty($page_hero->cta_link) && !empty($page_hero->cta_text))) : ?>
            <div class="c-hero__message<?php echo (!empty($page_hero->heading)) ? '  c-hero__message--wide' : ''; ?>"<?php echo (!empty($page_hero->text_width)) ? ' style="width: calc(' . $page_hero->text_width . 'em + 20%);"' : ''; ?>>
                <?php if (!empty($page_hero->heading)) : # @TODO change H1 for for 2nd of multiple items. ?>
                <h1 class="c-hero__message--fluid_heading"><?php echo $page_hero->heading; ?></h1>
                <?php endif; ?>
                <p class="c-hero__message--fluid_text"><?php echo $page_hero->text; ?></p>
                <?php if (!empty($page_hero->cta_link) && !empty($page_hero->cta_text)) : ?>
                <p class="u-space--left--auto"><a href="<?php echo $page_hero->cta_link; ?>" class="c-cta  c-cta--has-icon"><?php echo $page_hero->cta_text; ?><svg display="none" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg></a></p>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="sticky-footer-expand">
            <main role="main" id="main" aria-labelledby="<?php echo TplNPEU6Helper::html_id($page_heading); ?>">
                <br id="highlighter-start" />
                <div class="l-blockrow">
                    <div class="d-bands--bottom  t-<?php echo $page_brand->alias; ?>">
                        <?php if ($page_is_landing) : ?>
                        <?php if ($show_page_heading) : ?>
                        <div class="c-panel">
                            <?php if (isset($doc->header_cta)) : ?>
                            <header class="u-text-group  u-text-group--push-apart">
                                <h1 class="u-space--below--none" id="<?php echo TplNPEU6Helper::html_id($page_heading); ?>"><?php echo $page_heading; ?></h1>
                                <p>
                                    <a href="<?php echo $doc->header_cta['url']; ?>" class="c-cta  c-cta--has-icon"><?php echo $doc->header_cta['text']; ?><svg display="none" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg></a>
                                </p>
                            </header>
                            <?php else: ?>
                            <h1 id="<?php echo TplNPEU6Helper::html_id($page_heading); ?>"><?php echo $page_heading; ?></h1>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        <jdoc:include type="component" format="raw" />
                        <?php else: ?>

                        <div class="l-primary-content<?php if ($page_has_pull_outs) : ?>  l-primary-content--has-pull-outs<?php endif; ?>">


                            <div class="l-primary-content__header">

                                <?php echo $modules__main_upper; /*<jdoc:include type="modules" name="3-main-upper" style="basic" />*/?>

                                <div class="c-panel">
                                    <?php if (isset($doc->header_cta)) : ?>
                                    <header class="u-text-group  u-text-group--push-apart">
                                        <h1 class="u-space--below--none" id="<?php echo TplNPEU6Helper::html_id($page_heading); ?>"><?php echo $page_heading; ?></h1>
                                        <p>
                                            <a href="<?php echo $doc->header_cta['url']; ?>" class="c-cta  c-cta--has-icon"><?php echo $doc->header_cta['text']; ?><svg display="none" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg></a>
                                        </p>
                                    </header>
                                    <?php else: ?>
                                    <h1 id="<?php echo TplNPEU6Helper::html_id($page_heading); ?>"><?php echo $page_heading; ?></h1>
                                    <?php endif; ?>
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
                                        <a href="#menu"><span>Menu</span></a>
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

                            <?php if ($page_has_sidebar_super) : ?>
                            <?php if ($page_badge) : ?>
                            <div class="l-primary-content__pull-out  l-primary-content__pull-out--super  u-space--above  u-space--below">
                                <?php echo $page_badge; ?>
                            </div>
                            <?php endif; ?>
                            <?php endif; ?>

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

                                <div class="c-panel">
                                    <?php if ($page_has_article) : ?>
                                    <div class="c-longform-content  c-user-content">
                                        <?php if (!empty($doc->article->headline_image['headline-image']) && $show_headline_image == 1) : ?>
                                        <div class="u-space--below">
                                            <div class="l-proportional-container  l-proportional-container--2-1">
                                                <div class="l-proportional-container__content">
                                                    <div class="u-image-cover  js-image-cover">
                                                        <div class="u-image-cover__inner">
                                                            <img class="u-image-cover__image" src="<?php echo $doc->article->headline_image['headline-image']; ?>" alt="<?php echo $doc->article->headline_image['headline-image-alt-text']; ?>" width="600">
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
                                        <?php else: ?>
                                        <?php echo JHtml::_('content.prepare', $doc->article->introtext); ?>
                                        <?php echo JHtml::_('content.prepare', $doc->article->fulltext); ?>
                                        <?php endif; ?>
                                    </div>
                                    <?php else: ?>
                                    <jdoc:include type="component" format="raw" />
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($doc->article->pagination)) : ?>
                                <div class="u-space--below">
                                    <?php echo $doc->article->pagination; ?>
                                </div>
                                <?php endif; ?>
                                <?php if ($page_has_article) : ?>
                                <footer class="t-neutral  d-background--very-light  u-max-measure  u-padding--s">
                                    <p class="c-utilitext  u-text-group  u-text-group--push-apart">
                                        <span>Updated: <?php echo JHtml::_('date', $doc->article->modified, JText::_('DATE_FORMAT_LC2')); ?> (v<?php echo $doc->article->version; ?>)</span>
                                        <?php if ($user->authorise("core.edit", "com_content.article." . $doc->article->id)): ?><a href="/administrator/index.php?option=com_content&amp;task=article.edit&amp;id=<?php echo $doc->article->id; ?>" target="_blank" class="u-padding--right--s"><span>Edit content</span><svg display="none" class="icon  u-space--left--xs" aria-hidden="true"><use xlink:href="#icon-edit"></use></svg></a><?php endif; ?>
                                    </p>
                                </footer>
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
                        <?php endif; ?>
                    </div>
                </div><br id="highlighter-end" />
                <?php echo $modules__bottom; /*<jdoc:include type="modules" name="5-bottom" style="block" />*/?>

            </main>
        </div>

        <footer class="sticky-footer" role="contentinfo" id="page-footer" aria-label="Page">

            <?php echo $modules__footer_top; /*<jdoc:include type="modules" name="6-footer-top" style="block" />*/?>

            <?php if ($page_has_footer_mid_left || $page_has_footer_mid_right): ?>
            <div class="l-col-to-row-wrap  d-bands--bottom  t-<?php echo $page_brand->alias; ?>">
                <div class="l-col-to-row">
                    <?php if ($page_has_footer_mid_left): ?>
                    <div class="l-col-to-row__item  ff-width-100--40--50" data-position="6-footer-mid-left">
                        <?php echo $modules__footer_mid_left; ?>
                    </div>
                    <?php endif; ?>
                    <?php if ($page_has_footer_mid_right): ?>
                    <div class="l-col-to-row__item  ff-width-100--40--50" data-position="6-footer-mid-right">
                        <?php echo $modules__footer_mid_right; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
            
            <?php if ($page_unit != 'npeu') : ?>
            <div class="l-distribute-wrap">
                <div class="l-distribute  l-distribute--gutter--small  l-distribute--limit-15">            
                    <div class="u-padding--s  l-center">
                        <?php if ($page_unit == 'pru-mnhc') : ?>
                        <a href="https://www.npeu.ox.ac.uk" class="c-badge  c-badge--limit-height">
                            <img src="/img/brand-logos/unit/npeu-logo.svg" onerror="this.src='/img/brand-logos/unit/npeu-logo.png'; this.onerror=null;" alt="Logo: NPEU" height="80">
                        </a>
                        <?php elseif ($page_unit == 'npeu_ctu') : ?>
                        <a href="https://www.npeu.ox.ac.uk/ctu" class="c-badge  c-badge--limit-height">
                            <img src="/img/brand-logos/unit/npeu-ctu-logo.svg" onerror="this.src='/img/brand-logos/unit/npeu-ctu-logo.png'; this.onerror=null;" alt="Logo: NPEU CTU" height="80">
                        </a>
                        <?php elseif ($page_unit == 'sheer') : ?>
                        <a href="https://www.npeu.ox.ac.uk/sheer" class="c-badge  c-badge--limit-height">
                            <img src="/img/brand-logos/unit/sheer-logo.svg" onerror="this.src='/img/brand-logos/unit/sheer-logo.png'; this.onerror=null;" alt="Logo: SHEER" height="80">
                        </a>
                        <?php endif; ?>
                    </div>
                    <div class="u-padding--s  l-center">
                        <a href="https://www.npeu.ox.ac.uk/athena-swan" class="c-badge  c-badge--limit-height" rel="external noopener noreferrer" target="_blank">
                            <img src="/img/brand-logos/accolade/athena-swan-silver-award.svg" onerror="this.src='/img/brand-logos/accolade/athena-swan-silver-award.png'; this.onerror=null;" alt="Logo: Athena Swan Silver Award" height="70">
                        </a>
                    </div>

                    <div class="u-padding--s  l-center">
                        <a href="http://www.ndph.ox.ac.uk/" class="c-badge  c-badge--limit-height" rel="external noopener noreferrer" target="_blank">
                            <img src="/img/brand-logos/affiliate/ndph-logo.svg" onerror="this.src='/img/brand-logos/affiliate/ndph-logo.png'; this.onerror=null;" alt="Logo: Nuffield Department of Population Health" height="50">
                        </a>
                    </div>

                    <div class="u-padding--s  l-center">
                        <a href="http://www.ox.ac.uk/" class="c-badge  c-badge--limit-height" rel="external noopener noreferrer" target="_blank">
                            <img src="/img/brand-logos/affiliate/ou-logo-rect.svg" onerror="this.src='/img/brand-logos/affiliate/ou-logo-rect.png'; this.onerror=null;" alt="Logo: University of Oxford" height="60">
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php echo $modules__footer_bottom; ?>

            <div class="c-page-footer  u-text-align--center"><?php /* @TODO: sort out footer from form input. */ ?>
                <p class="c-utilitext">
                    <?php echo $page_footer_text; ?>
                </p>
            </div>

        </footer>

    </div>