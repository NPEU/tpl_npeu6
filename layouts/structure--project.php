---
layout: structure
---
    {% assign project_data = site.data.projects[page.project] %}
    <div class="sticky-footer-wrap  limit-page-width">

        <header class="c-page-header  t-{{ page.project }}  d-bands--bottom">
            
            <div class="u-padding--bottom--s">
                <div class="l-col-to-row">
                    <div class="l-col-to-row__item  ff-width-100--40--50  u-text-align--left  c-page-header__first  u-padding--top--s  u-padding--sides--s">
                        <a href="/{{ page.project }}" class="c-badge  c-page-header__primary-logo">
                            {{ project_data.logo_svg }}
                        </a>
                        <!--div class="svg  svg--fixed-height">-->
                            
                            
                            <!--<a href="/{{ page.project }}" class="svg__link">
                                <object type="image/svg+xml" data="/img/unit-logos/{{ page.project }}-logo.svg" height="100" class="svg__image" aria-hidden="true" tabindex="-1">
                                    <svg display="none">
                                        <image src="/img/unit-/logos/{{ page.project }}-logo.png" height="100" class="svg__fallback-image" alt="{{ project_data.name }} home"></image>
                                    </svg>
                                    <span class="svg__fallback-text-alpha" data-content="{{ project_data.name }} home"></span>
                                </object>
                                <div><i class="svg__fallback-text-beta">{{ project_data.name }} home</i></div>
                            </a>-->

                            <!--<a href="/listeningtoparents" class="svg__link">
                                <object type="image/svg+xml" data="/img/unit-logos/listeningtoparents-logo.svg" height="100" class="svg__image" aria-hidden="true" tabindex="-1">
                                    <svg display="none">
                                        <image src="/img/unit-logos/listeningtoparents-logo.png" height="100" class="svg__fallback-image" alt="{{ project_data.name }} home"></image>
                                    </svg>
                                    <span class="svg__fallback-text-alpha" data-content="{{ project_data.name }} home"></span>
                                </object>
                                <div><i class="svg__fallback-text-beta">{{ project_data.name }} home</i></div>
                            </a>-->

                            <!--<a href="/maternity-surveys" class="svg__link">
                                <object type="image/svg+xml" data="/img/unit-logos/maternity-surveys-logo.svg" height="100" class="svg__image" aria-hidden="true" tabindex="-1">
                                    <svg display="none">
                                        <image src="/img/unit-logos/maternity-surveys-logo.png" height="100" class="svg__fallback-image" alt="{{ project_data.name }} home"></image>
                                    </svg>
                                    <span class="svg__fallback-text-alpha" data-content="{{ project_data.name }} home"></span>
                                </object>
                                <div><i class="svg__fallback-text-beta">{{ project_data.name }} home</i></div>
                            </a>-->
                        <!--</div>-->
                    </div>

                    <!--<div class="l-col-to-row__item  ff-width-100--40--50  l-v-center  u-text-align--right  c-page-header__last">-->
                    <div class="l-col-to-row__item  ff-width-100--40--50  l-distribute  u-padding--top--s  u-padding--sides--s">
                        {% if page.display_navbar %}
                        <span>
                            <button class="over-panel-control" hidden aria-controls="menu-panel" aria-label="Main menu" aria-expanded="false" data-js="overpanel__control">
                                <svg display="none" class="icon  icon--is-closed  feather"><use xlink:href="#icon-menu"></use></svg><svg display="none" class="icon  icon--is-open  feather"><use xlink:href="#icon-cross"></use></svg>
                            </button>
                        </span>
                        {% endif %}
                        {% if page.display_cta %}
                        <span>
                            <a href="/{{ project_data.randomisation_url }}" class="c-primary-cta  t-{{ page.project }}">Randomise to {{ project_data.name }}</a>
                        </span>
                        {% endif %}
                    </div>
                </div>
            </div>
            
            {% if page.display_navbar %}
            <div class="over-panel over-panel--fade" id="menu-panel" data-js="over-panel">
                <button class="over-panel__overlay" hidden="" aria-hidden="true" tabindex="-1" data-js="over-panel__overlay"></button>
                <div class="over-panel__contents  d-background--sloped  t-{{ page.project }}" data-js="over-panel__contents">

                    <div class="nav-bar  u-padding--sides--s  t-{{ page.project }}  d-bands--bottom">

                        <nav class="nav-bar__main">

                            <ul class="nav-bar__items">

                                <!--<li class="nav-bar__item"><a href="/{{ page.project }}/about" class="nav-bar__link">About</a></li>-->

                                <li class="nav-bar__item"><a href="/{{ page.project }}/{{ project_data.participants_url }}" class="nav-bar__link">{{ project_data.participants_label }}</a></li>

                                <li class="nav-bar__item"><a href="/{{ page.project }}/clinicians" class="nav-bar__link">Clinicians</a></li>

                                <li class="nav-bar__item"><a href="/{{ page.project }}/contact" class="nav-bar__link">Contact</a></li>
                                
                                <li class="nav-bar__item"><a href="/{{ page.project }}/centres" class="nav-bar__link">Centres</a></li>
                                
                                <li class="nav-bar__item"><a href="/{{ page.project }}/recruitment" class="nav-bar__link">Reruitment</a></li>
                                
                                <li class="nav-bar__item"><a href="/{{ page.project }}/updates" class="nav-bar__link">Updates</a></li>

                                <!--<li class="nav-bar__item dropdown js-dropdown">

                                    <a href="/wireframes/about" class="nav-bar__link">About Us</a>
                                    <button id="about-us-sub-menu-toggle" class="dropdown__button" data-js="dropdown__button" hidden="" aria-label="About Us sub menu" aria-expanded="false"><svg display="none" class="icon  icon--is-closed  feather"><use xlink:href="#icon-chevron-down"></use></svg><svg display="none" class="icon  icon--is-open  feather"><use xlink:href="#icon-chevron-up"></use></svg></button>

                                    <div class="dropdown__area" id="about-us-sub-menu-toggle--target">
                                        <ul class="subnav__items  subnav__items--stacked">
                                            <li class="subnav__item"><a href="/wireframes/about/athena-swan" class="subnav__link">Athena SWAN</a></li>                                                
                                            <li class="subnav__item"><a href="/wireframes/about/jobs" class="subnav__link">Jobs</a></li>
                                            <li class="subnav__item"><a href="/wireframes/about/postgrad" class="subnav__link">Postgraduate Studies</a></li>
                                            <li class="subnav__item"><a href="/wireframes/about/privacy-notice" class="subnav__link">Privacy Notice</a></li>
                                            <li class="subnav__item"><a href="/wireframes/about/seminars" class="subnav__link">Seminars</a></li>                                                                                             
                                            <li class="subnav__item"><a href="/wireframes/about/working-in-npeu" class="subnav__link" data-js="dropdown__focus-start">Working in the NPEU</a></li>
                                        </ul>
                                    </div>

                                </li>-->
                            </ul>

                        </nav>
                        <div class="nav-bar__search">
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="20" height="20">
                                    <path fill="#fff" d="M 12.917 11.667 h -0.662 l -0.229 -0.229 c 0.817 -0.946 1.308 -2.175 1.308 -3.521 c 0 -2.992 -2.425 -5.417 -5.417 -5.417 s -5.417 2.425 -5.417 5.417 s 2.425 5.417 5.417 5.417 c 1.346 0 2.575 -0.492 3.521 -1.304 l 0.229 0.229 v 0.658 l 4.167 4.158 l 1.242 -1.242 l -4.158 -4.167 Z M 7.917 11.667 c -2.071 0 -3.75 -1.679 -3.75 -3.75 s 1.679 -3.75 3.75 -3.75 s 3.75 1.679 3.75 3.75 s -1.679 3.75 -3.75 3.75 Z"></path>
                                    <text y="-10">Search</text>
                                </svg>
                                <span>Search</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
            {% endif %}
        </header>
        
        
        {% if page.display_hero and page.hero_image %}
        <div id="hero" class="c-hero">
            <div class="c-hero__image">
                <div class="proportional-container  proportional-container--5-1  d-bands--bottom  t-{{ page.project }}  hero-image">
                    <div class="proportional-container__content">
                        <img class="proportional-container__image-cover" src="{{ page.hero_image }}" width="600" alt="">
                    </div>
                </div>
            </div>
            {% if page.hero_message %}
            <div class="c-hero__message">
                {% if page.is_home %}
                <h1>{{ page.hero_message }}</h1>
                {% else %}
                <p><b>{{ page.hero_message }}</b></h1>
                {% endif %}
            </div>
            {% endif %}
        </div>
        {% endif %}
        
        <div class="sticky-footer-expand  t-white  d-background">
            <main role="main" class="main-container  Xd-background--very-dark  Xt-{{ page.project }}  Xu-fill-area">
                {{ content }}
            </main>
        </div>

        <footer class="sticky-footer  t-{{ page.project }}  d-bands--top" role="contentinfo">
            <div class="d-background  t-white">
                <div class="l-distribute">

                    <div class="u-padding--s">
                        <a href="https://www.npeu.ox.ac.uk" class="c-badge  npeu  l-v-center">
                            <img src="/img/unit-logos/npeu-ctu-logo.svg" onerror="this.src='/img/unit-logos/npeu-ctu-logo.png'; this.onerror=null;" alt="Logo: NPEU CTU" height="80">
                        </a>
                    </div>

                    <div class="u-padding--s">
                        <a href="https://www.npeu.ox.ac.uk" class="c-badge  athena-swan  l-v-center" rel="external noopener noreferrer" target="_blank">
                            <img src="/img/affiliate-logos/athena-swan-silver-award.svg" onerror="this.src='/img/affiliate-logos/athena-swan-silver-award.png'; this.onerror=null;" alt="Logo: Athena Swan Silver Award" height="70">
                        </a>
                    </div>
                    
                    <div class="u-padding--s">
                        <a href="http://www.ndph.ox.ac.uk/" class="c-badge  ndph  l-v-center" rel="external noopener noreferrer" target="_blank">
                            <img src="/img/affiliate-logos/ndph-logo.svg" onerror="this.src='/img/affiliate-logos/ndph-logo.png'; this.onerror=null;" alt="Logo: Nuffield Department of Population Health" height="50">
                        </a>
                    </div>

                    <div class="u-padding--s">
                        <a href="http://www.ox.ac.uk/" class="c-badge  ou  l-v-center" rel="external noopener noreferrer" target="_blank">
                            <img src="/img/affiliate-logos/ou-logo-rect.svg" onerror="this.src='/img/affiliate-logos/ou-logo-rect.png'; this.onerror=null;" alt="Logo: University of Oxford" height="60">
                        </a>
                    </div>

                </div>

                <p class="c-page-footer  u-text-align--center">
                    &copy; NPEU {{ site.time | date: '%Y'}}
                </p>
            </div>
        </footer>

    </div>