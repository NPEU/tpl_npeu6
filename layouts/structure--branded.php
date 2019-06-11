    <div class="sticky-footer-wrap  c-page-wrap">

        <header class="c-page-header  t-<?php echo $page_brand->alias; ?>">

            <div class="u-padding--bottom--s">
                <div class="l-col-to-row-wrap">
                    <div class="l-col-to-row">
                        <div class="l-col-to-row__item  ff-width-100--40--50  u-text-align--left  c-page-header__first  u-padding--top--s  u-padding--sides--s">
                            <a href="/<?php echo $page_brand->alias; ?>" class="c-badge  c-badge--primary-logo">
                                <?php echo $page_brand->logo_svg; ?>
                            </a>
                        </div>

                        <?php if ($page_display_cta): ?>
                        <div class="l-col-to-row__item  ff-width-100--40--50  l-center  u-padding--top--s  u-padding--sides--s">

                            <span>
                                <a href="<?php echo $page_cta_url; ?>" class="c-primary-cta  t-<?php echo $page_brand->alias; ?>"><?php echo $page_cta_text; ?></a>
                            </span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php if($page_has_navbar): ?>
            <div class="nav-bar  u-padding--sides--s  t-<?php echo $page_brand->alias; ?>">

                <div class="nav-bar__start">
                    <div class="nav-bar__item">
                        <button class="over-panel-control t-<?php echo $page_brand->alias; ?> js-over-panel-control" hidden="" aria-controls="menu-panel" aria-label="Main menu" aria-expanded="false" data-js="overpanel__control"><svg display="none" class="icon  icon--is-closed"><use xlink:href="#icon-menu"></use></svg><svg display="none" class="icon  icon--is-open"><use xlink:href="#icon-cross"></use></svg></button>
                    </div>
                    <div class="nav-bar__item">
                        <button class="over-panel-control t-<?php echo $page_brand->alias; ?> js-over-panel-control" hidden="" aria-controls="search-panel" aria-label="Search" aria-expanded="false" data-js="overpanel__control"><svg display="none" class="icon  icon--is-closed"><use xlink:href="#icon-search"></use></svg><svg display="none" class="icon  icon--is-open"><use xlink:href="#icon-cross"></use></svg></button>
                    </div>
                </div>

                <nav class="nav-bar__main">

                    <div class="over-panel over-panel--fade js-over-panel" id="menu-panel" data-js="over-panel">
                        <button class="over-panel__overlay  t-<?php echo $page_brand->alias; ?>" hidden="" aria-hidden="true" tabindex="-1" data-js="over-panel__overlay"></button>
                        <div class="over-panel__contents  t-<?php echo $page_brand->alias; ?>" data-js="over-panel__contents">
                            <jdoc:include type="modules" name="2-header-nav-bar" style="basic" />
                        </div>
                    </div>

                </nav>

                <div class="nav-bar__end">
                    <div class="over-panel over-panel--fade js-over-panel" id="search-panel" data-js="over-panel">
                        <button class="over-panel__overlay  t-<?php echo $page_brand->alias; ?>" hidden="" aria-hidden="true" tabindex="-1" data-js="over-panel__overlay"></button>
                        <div class="over-panel__contents  t-<?php echo $page_brand->alias; ?>" data-js="over-panel__contents">
                            <form action="#search" id="searchform" class="search-form  search-form---restrict-width  t-<?php echo $page_brand->alias; ?>  u-space--left--auto" method="GET">
                                <input type="search" class="search-form__field" id="search" placeholder="Search" name="s" value="" aria-label="Search">
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
        </header>

        <?php if($page_has_hero): ?>
            <?php if($page_has_carousel): ?>
        <!-- @TOTO -->
            <?php else: /* @TODO - need to think about credit lines. */?>
        <div id="hero" class="c-hero  c-hero--reversed  d-bands--bottom  t-<?php echo $page_brand->alias; ?>">
            <div class="c-hero__image">
                <div class="l-proportional-container  l-proportional-container--3-1  l-proportional-container--5-1--wide">
                    <div class="l-proportional-container__content">
                        <div class="u-image-cover  js-image-cover">
                            <div class="u-image-cover__inner">
                                <img class="u-image-cover__image" src="<?php echo $page_hero->image; ?>" width="600" alt="<?php echo $page_hero->alt; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="c-hero__message">
                <?php if ($page_is_landing): ?>
                <h1><?php echo $page_hero->text; ?></h1>
                <?php else: ?>
                <p><?php echo $page_hero->text; ?></p>
                <?php endif; ?>
            </div>

        </div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="sticky-footer-expand">
            <main role="main">
                <?php if ($page_is_landing): ?>
                <jdoc:include type="component" format="raw" />
                <?php else: ?>
                <div class="l-blockrow">
                    <div class="d-bands--bottom  t-<?php echo $page_brand->alias; ?>">

                        <div class="l-primary-content<?php if ($page_has_pull_outs): ?>  l-primary-content--has-pull-outs<?php endif; ?>">

                            <div class="l-primary-content__header">

                                <jdoc:include type="modules" name="3-main-breadcrumbs" style="basic" />
                                <jdoc:include type="modules" name="3-main-upper" style="basic" />

                                <div class="c-panel">
                                    <h1><?php echo $page_heading; ?></h1>
                                    <?php if ($page_has_article ): ?>
                                    <?php // Content is generated by content plugin event "onContentAfterTitle"
                                    // Not sure this is the best place for this?
                                    ?>
                                    <?php echo $doc->article->event->afterDisplayTitle; ?>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php if ($page_has_article ): ?>
                            <?php // Content is generated by content plugin event "onContentBeforeDisplay"
                            // Not sure this is the best place for this? ?>
                            <?php echo $doc->article->event->beforeDisplayContent; ?>
                            <?php endif; ?>

                            <?php if ($page_has_sidebar_top || $page_has_priority_content): ?>
                            <div class="l-primary-content__pull-out  l-primary-content__pull-out--top">
                                <jdoc:include type="modules" name="4-sidebar-top" style="sidebar" />
                                <?php if ($page_has_priority_content): ?>
                                <?php echo $doc->article->introtext; ?>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>

                            <div class="l-primary-content__main">

                                <div class="c-panel">
                                    <?php if ($page_has_article ): ?>
                                    <div class="c-longform-content">
                                        <?php if ($page_has_priority_content): ?>
                                        <?php echo $doc->article->fulltext; ?>
                                        <?php else: ?>
                                        <?php echo $doc->article->introtext; ?>
                                        <?php endif; ?>
                                    </div>
                                    <?php else: ?>
                                    <jdoc:include type="component" format="raw" />
                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php if ($page_has_article ): ?>
                            <?php // Content is generated by content plugin event "onContentAfterDisplay"
                            // Not sure this is the best place for this? ?>
                            <?php echo $doc->article->event->afterDisplayContent; ?>
                            <?php endif; ?>

                            <?php if ($page_has_sidebar_bottom): ?>
                            <div class="l-primary-content__pull-out  l-primary-content__pull-out--bottom">
                                <jdoc:include type="modules" name="4-sidebar-bottom" style="sidebar" />
                            </div>
                            <?php endif; ?>
                            <?php if ($page_has_main_lower): ?>
                            <div class="l-primary-content__footer">
                                <jdoc:include type="modules" name="3-main-lower" style="basic" />
                            </div>
                            <?php endif; ?>

                        </div>

                    </div>
                </div>
                <?php endif; ?>
                <jdoc:include type="modules" name="5-bottom" style="block" />
            </main>
        </div>

        <footer class="sticky-footer  t-<?php echo $page_brand->alias; ?>  d-bands--top" role="contentinfo">
            <div class="l-distribute-wrap">
                <div class="l-distribute  l-distribute--gutter--small  l-distribute--limit-15">

                    <div class="u-padding--s  l-center">
                        <?php if ($page_unit == 'npeu'): ?>
                        <a href="https://www.npeu.ox.ac.uk" class="c-badge">
                            <img src="/img/unit-logos/npeu-logo.svg" onerror="this.src='/img/unit-logos/npeu-logo.png'; this.onerror=null;" alt="Logo: NPEU" height="80">
                        </a>
                        <?php elseif ($page_unit == 'npeu_ctu'): ?>
                        <a href="https://www.npeu.ox.ac.uk/ctu" class="c-badge">
                            <img src="/img/unit-logos/npeu-ctu-logo.svg" onerror="this.src='/img/unit-logos/npeu-ctu-logo.png'; this.onerror=null;" alt="Logo: NPEU CTU" height="80">
                        </a>
                        <?php elseif ($page_unit == 'sheer'): ?>
                        <a href="https://www.npeu.ox.ac.uk/sheer" class="c-badge">
                            <img src="/img/unit-logos/sheer-logo.svg" onerror="this.src='/img/unit-logos/sheer-logo.png'; this.onerror=null;" alt="Logo: SHEER" height="80">
                        </a>
                        <?php endif; ?>
                    </div>

                    <div class="u-padding--s  l-center">
                        <a href="https://www.npeu.ox.ac.uk" class="c-badge" rel="external noopener noreferrer" target="_blank">
                            <img src="/img/affiliate-logos/athena-swan-silver-award.svg" onerror="this.src='/img/affiliate-logos/athena-swan-silver-award.png'; this.onerror=null;" alt="Logo: Athena Swan Silver Award" height="70">
                        </a>
                    </div>

                    <div class="u-padding--s  l-center">
                        <a href="http://www.ndph.ox.ac.uk/" class="c-badge" rel="external noopener noreferrer" target="_blank">
                            <img src="/img/affiliate-logos/ndph-logo.svg" onerror="this.src='/img/affiliate-logos/ndph-logo.png'; this.onerror=null;" alt="Logo: Nuffield Department of Population Health" height="50">
                        </a>
                    </div>

                    <div class="u-padding--s  l-center">
                        <a href="http://www.ox.ac.uk/" class="c-badge" rel="external noopener noreferrer" target="_blank">
                            <img src="/img/affiliate-logos/ou-logo-rect.svg" onerror="this.src='/img/affiliate-logos/ou-logo-rect.png'; this.onerror=null;" alt="Logo: University of Oxford" height="60">
                        </a>
                    </div>

                </div>
            </div>

            <p class="c-page-footer  u-text-align--center"><?php /* @TODO: sort out footer from form input. */ ?>
                <?php echo $page_footer_text; ?>
            </p>

        </footer>

    </div>