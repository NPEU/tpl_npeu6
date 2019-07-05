<?php
defined('_JEXEC') or die;
ini_set('display_errors', 'On');

if (!isset($this->error)) {
	$this->error = JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
	$this->debug = false;
}
#echo "<pre>\n"; var_dump($this->error); echo "</pre>\n"; exit;
$is_error   = true;
$error_code = $this->error->getCode();
#echo '<pre>'; var_dump($is_error); echo '</pre>'; #exit;
ob_start();
?>
    <?php if ($error_code == 404) : ?>
    <div id="hero" class="c-hero  c-hero--reversed  d-bands--top  d-bands--bottom  u-space--below">
        <div class="c-hero__image">
            <div class="l-proportional-container  l-proportional-container--3-1  l-proportional-container--4-1--wide  hero-image">
                <div class="l-proportional-container__content">
                    <div class="u-image-cover  js-image-cover">
                        <div class="u-image-cover__inner">
                            <img src="/img/npeu/hero-image-404.jpg" alt="" class="u-image-cover__image" width="200">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="c-hero__message">
            <p class="u-padding--s">
                <a href="https://www..npeu.ox.ac.uk" class="c-badge">
                    <img src="/img/unit-logos/npeu-logo.svg" onerror="this.src='/img/unit-logos/npeu-logo.png'; this.onerror=null;" alt="Logo: NPEU" height="80">
                </a>
            </p>
            <p class="u-padding--top--s  u-padding--bottom--s  u-padding--sides">Uh oh. We couldn't find that page.</p>
        </div>
    </div>

    <div class="sticky-footer-expand">
        <main id="main" role="main">
            <div class="l-blockrow">
                <div class="d-bands--bottom t-npeu">
                    <div class="l-primary-content l-primary-content--has-pull-outs">
                        <div class="l-primary-content__header">
                            <div class="c-panel">
                                <h1 id="404-page-not-found">404 Page not found</h1>
                            </div>
                        </div>
                        <div class="l-primary-content__main">
                            <div class="c-panel">
                                <p>You could try searching:</p>

                                <form action="/search" id="searchform" class="" method="GET">
                                    <span class="composite">
                                        <input type="search" class="search-form__field" id="search" placeholder="Search" name="q" value="" size="40 aria-label="Search">
                                        <button class="search-form__submit" type="submit">
                                            <span>Search</span>
                                        </button>
                                    </span>
                                </form>

                                <p>Or one of these links:</p>
                                <ul>
                                    <li><a href="https://www.npeu.ox.ac.uk"><span>Home</span></a></li>
                                    <li><a href="https://www.npeu.ox.ac.uk/ctu/trials"><span>CTU Trials Portfolio</span></a></li>
                                    <li><a href="https://www.npeu.ox.ac.uk/sheer"><span>SHEER Portfolio</span></a></li>
                                    <li><a href="https://www.npeu.ox.ac.uk/prumnhc"><span>PRU-MNHC</span></a></li>
                                    <li><a href="https://www.npeu.ox.ac.uk/about"><span>About the NPEU</span></a></li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php else : ?>
    <div class="sticky-footer-expand">
        <main id="main" role="main">
            <h1>Error <?php echo $error_code; ?></h1>
            <p><?php $error_message = $this->error->getMessage(); ?></p>
        </main>
    </div>
    <?php endif; ?>
    <footer class="sticky-footer  t-npeu  d-bands--top" role="contentinfo" id="page-footer">

        <div class="l-distribute-wrap">
            <div class="l-distribute  l-distribute--gutter--small  l-distribute--limit-15">

                <div class="u-padding--s  l-center">
                    <a href="https://www.npeu.ox.ac.uk/athena-swan" class="c-badge" rel="external noopener noreferrer" target="_blank">
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

        <div class="c-page-footer  u-text-align--center">
            <p class="c-utilitext">
                © NPEU <?php echo date('Y');?> | <a href="https://www.npeu.ox.ac.uk"><span>Home</span></a> | <a href="https://www.npeu.ox.ac.uk/about"><span>About the NPEU</span></a> | <a href="https://www.npeu.ox.ac.uk/privacy-cookies"><span>Privacy &amp; Cookies</span></a> | <a href="https://www.npeu.ox.ac.uk/accessibility-help"><span>Accessibility &amp; Help</span></a> | <a href="#top"><span>Top of page</span></a>
            </p>
        </div>

    </footer>
<?php
$error_output = ob_get_contents();
ob_end_clean();

require_once('setup.php');

?>