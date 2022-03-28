<?php
/**
 * @package     Joomla.Site
 * @subpackage  tpl_npeu6
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

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
    <div id="hero" class="c-hero  c-hero--right  d-bands--top  d-bands--bottom">
        <div class="c-hero__image">
            <div class="l-proportional-container  l-proportional-container--3-1  l-proportional-container--4-1--wide  hero-image">
                <div class="l-proportional-container__content">
                    <div class="u-image-cover  js-image-cover">
                        <div class="u-image-cover__inner">
                            <img src="/assets/images/npeu/hero-image-404.jpg" alt="" class="u-image-cover__image" width="200">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="c-hero__message">
            <p class="u-padding--s">
                <a href="/" class="c-badge">
                    <img src="/assets/images/brand-logos/unit/npeu-logo.svg" onerror="this.src='/assets/images/brand-logos/unit/npeu-logo.png'; this.onerror=null;" alt="Logo: NPEU" height="80">
                </a>
            </p>
            <p class="u-padding--top--s  u-padding--bottom--s  u-padding--sides" style="max-width: 100%;">Uh oh. We couldn't find that page.</p>
        </div>
    </div>

    <div class="sticky-footer-expand">
        <main id="main" role="main">
            <div class="l-blockrow">
                <div class="d-bands--bottom t-npeu">

                    <div class="c-panel">
                        <h1 id="404-page-not-found">404 Page not found</h1>
                    </div>

                    <div class="c-panel">
                    
                        <div class="l-layout  l-row  l-gutter--l  l-flush-edge-gutter">
                            <div class="l-layout__inner">
                                <div class="l-box  ff-width-100--40--50">
                                    <p>You could try searching:</p>

                                    <form action="/search" id="searchform" class="" method="GET">
                                        <span class="composite  u-fill-width">
                                            <input type="search" class="search-form__field  u-expand-width" id="search" placeholder="Search" name="q" value="" aria-label="Search">
                                            <button class="search-form__submit" type="submit">
                                                <span>Search</span>
                                            </button>
                                        </span>
                                    </form>
                        
                                </div>
                                <div class="l-box  ff-width-100--40--50">

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
            </div>
        </main>
    </div>
    <?php else : ?>
    <div class="sticky-footer-expand">
        <main id="main" role="main">
            <h1>Error <?php echo $error_code; ?></h1>
            <p><?php echo $this->error->getMessage(); ?></p>
            <p><?php echo str_replace("\n", "<br>\n", $this->error->getTraceAsString()); ?></p>
        </main>
    </div>
    <?php endif; ?>
    <footer class="sticky-footer" role="contentinfo" id="page-footer">

        <div class="l-layout  l-gutter--s  l-basis--25  l-distribute">
            <div class="l-layout__inner">
                <div class="l-box  u-padding--s  l-center">
                    <a href="https://www.npeu.ox.ac.uk/athena-swan" class="c-badge  c-badge--limit-height" rel="external noopener noreferrer" target="_blank">
                        <img src="/assets/images/brand-logos/accolade/athena-swan-silver-logo.svg" onerror="this.src='/assets/images/brand-logos/accolade/athena-swan-silver-logo.png'; this.onerror=null;" alt="Logo: Athena Swan Silver Award" height="80">
                    </a>
                </div>

                <div class="l-box  u-padding--s  l-center">
                    <a href="http://www.ndph.ox.ac.uk/" class="c-badge  c-badge--limit-height" rel="external noopener noreferrer" target="_blank">
                        <img src="/assets/images/brand-logos/affiliate/ndph-logo.svg" onerror="this.src='/assets/images/brand-logos/affiliate/ndph-logo.png'; this.onerror=null;" alt="Logo: Nuffield Department of Population Health" height="80">
                    </a>
                </div>

                <div class="l-box  u-padding--s  l-center">
                    <a href="http://www.ox.ac.uk/" class="c-badge  c-badge--limit-height" rel="external noopener noreferrer" target="_blank">
                        <img src="/assets/images/brand-logos/affiliate/ou-logo-rect.svg" onerror="this.src='/assets/images/brand-logos/affiliate/ou-logo-rect.png'; this.onerror=null;" alt="Logo: University of Oxford" height="80">
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