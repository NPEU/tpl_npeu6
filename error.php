<?php
/**
 * @package     Joomla.Site
 * @subpackage  tpl_npeu6
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;

#ini_set('display_errors', 0);

if (!isset($this->error)) {
    #$this->error = JError::raiseWarning(404, Text::_('JERROR_ALERTNOAUTHOR'));
    $this->error = new GenericDataException(Text::_('JERROR_ALERTNOAUTHOR'), 404);
    $this->debug = false;
}
#echo "<pre>\n"; var_dump($this->error); echo "</pre>\n"; exit;
$is_error   = true;
$error_code = $this->error->getCode();
#echo '<pre>'; var_dump($is_error); echo '</pre>'; #exit;
$display_errors = preg_match('/^(1|yes|on|true)$/i', ini_get('display_errors'));

$error_code_id = $error_code . '-' . $error_code;
$error_page_title = 'Error ' . $error_code;

if (!$display_errors) {
    $error_code_id = 'error';
    $error_page_title = 'A server error occured';
}

if ($error_code == 404) {
    $error_image_src = 'hero-image-404.jpg';
    $error_hero_message = "Uh oh. We couldn't find that page.";
    $error_page_title = 'Error ' . $error_code;
} else {
    $error_image_src = 'hero-image-error.jpg';
    $error_hero_message = "Oops! Something isn't working";
}
ob_start();
?>
    <div class="l-box  l-box--expand">

        <main id="main" aria-labelledby="<?php echo $error_code_id; ?>">

            <div class="c-hero-wrap  c-hero__message--wide  d-border--top--thick  d-border--bottom--thick  d-background--dark" data-fs-text="center">

                <div class="c-hero  c-hero--message-right  c-info-overlay-wrapx" data-fs-text="center">
                    <div class="c-hero__image">
                        <div class="u-image-cover  js-image-cover  u-image-cover--min-33-33">
                            <div class="u-image-cover__inner">
                                <img src="/assets/images/npeu/<?php echo $error_image_src; ?>?s=300" sizes="100vw" srcset="/assets/images/npeu/<?php echo $error_image_src; ?>?s=1600 1600w, /assets/images/npeu/<?php echo $error_image_src; ?>?s=900 900w, /assets/images/npeu/<?php echo $error_image_src; ?>?s=300 300w" alt="" class="u-image-cover__image" width="200">
                            </div>
                        </div>
                    </div>

                    <div class="c-hero__message">

                        <p class="c-panel  d-background--white">
                            <a href="https://www.npeu.ox.ac.uk" class="c-badge">
                                <img src="/assets/images/brand-logos/unit/npeu-logo.svg" onerror="this.src='/assets/images/brand-logos/unit/npeu-logo.png'; this.onerror=null;" alt="Logo: NPEU" width="344" height="150">
                            </a>
                        </p>
                        <p class="c-hero__message--fluid_text"><?php echo $error_hero_message; ?></p>

                    </div>
                </div>

            </div>
            <div class="d-border--bottom--thick">
                <div class="l-primary-content  n--page-not-landing  d-background--white">
                    <div class="l-primary-content__header">

                        <div class="c-panel">
                            <header class="c-panel__header">
                                <h1 id="<?php echo $error_code_id; ?>" tabindex="-1"><?php echo $error_page_title; ?></h1>
                            </header>

                        </div>
                    </div>

                    <div class="c-panel">

                        <div class="l-layout  l-row  l-gutter--l  l-flush-edge-gutter">
                            <div class="l-layout__inner">
                                <div class="l-box  ff-width-100--40--50">
                                    <?php if ($error_code == 404): ?>
                                    <p>You could try searching for what you're looking for:</p>

                                    <form action="/search" id="searchform" class="" method="GET">
                                        <span class="c-composite  u-fill-width">
                                            <input type="search" class="c-composite--expand" id="search" placeholder="Search" name="q" value="" aria-label="Search">
                                            <button class="search-form__submit" type="submit">
                                                <span>Search</span>
                                            </button>
                                        </span>
                                    </form>
                                    <?php else: ?>
                                    <?php if ($display_errors): ?>
                                    <p><?php echo $this->error->getMessage(); ?></p>
                                    <p><?php echo str_replace("\n", "<br>\n", $this->error->getTraceAsString()); ?></p>
                                    <?php endif; ?>

                                    <p>Please email webmaster@npeu.ox.ac.uk</p>
                                    <?php endif; ?>
                                </div>
                                <div class="l-box  ff-width-100--40--50">

                                    <p>Or try one of these links:</p>
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


    <div class="l-box">

        <footer aria-label="Page" data-fs-text="center">
            <div class="d-border--bottom--thick">
                <div class="l-layout  l-row">
                    <div class="l-layout__inner">
                        <div class="l-box  ff-width-100--40--50" data-position="6-footer-mid-left">
                            <div class="modstyle_magic--wrapper  t-npeu  l-box  l-box--expand">
                                <div class="c-panel">
                                    <div class="u-fill-height  c-panel__module">

                                        <div class="l-layout  l-row  l-row--center  l-gutter  l-flush-edge-gutter  mod_social">
                                            <p class="l-layout__inner">

                                                <span class="l-box">
                                                    <a class="c-badge  c-badge--limit-height--6  twitter" href="https://twitter.com/npeu_oxford" rel="external noopener noreferrer" target="_blank"><img alt="Twitter" height="60" onerror="this.src='/assets/images/brand-logos/social/twitter.png'; this.onerror=null;" src="/assets/images/brand-logos/social/twitter.svg"></a>
                                                </span>
                                                <span class="l-box">
                                                    <a class="c-badge c-badge--limit-height--6 youtube" href="https://www.youtube.com/user/NPEUOxford" rel="external noopener noreferrer" target="_blank"><img alt="YouTube" height="60" onerror="this.src='/assets/images/brand-logos/social/youtube.png'; this.onerror=null;" src="/assets/images/brand-logos/social/youtube.svg"></a>
                                                </span>

                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-border--bottom--thick">
                <div class="l-layout  l-gutter  l-distribute  l-distribute--balance-top  l--basis-20">
                    <p class="l-layout__inner">
                        <span class="l-box  l-box--center">
                            <a href="https://www.npeu.ox.ac.uk/" class="c-badge  c-badge--limit-height"><img src="/assets/images/brand-logos/unit/npeu-logo.svg" onerror="this.src='/assets/images/brand-logos/unit/npeu-logo.png'; this.onerror=null;" alt="Logo: NPEU" height="80" width="183"></a>
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
            <div class="d-background--dark  page-footer">
                <div class="l-layout  l-row  l-gutter">
                    <div class="l-layout__inner">
                        <div class="l-box  l-box--center">
                            <p class="c-utilitext   l-layout  l-row  l-row--start  l-gutter--xs  no-print">
                                <span role="list" class="l-layout__inner">
                                    <span role="listitem" class="l-box">
                                        <a href="/"><span>NPEU Home</span></a>
                                    </span>

                                    <span class="l-box__separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>

                                    <span role="listitem" class="l-box">
                                        <a href="/about"><span>About the NPEU</span></a>
                                    </span>

                                    <span class="l-box__separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>

                                    <span role="listitem" class="l-box">
                                        <a href="/privacy-cookies"><span>Privacy &amp; Cookies</span></a>
                                    </span>

                                    <span class="l-box__separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>

                                    <span role="listitem" class="l-box">
                                        <a href="http://www.npeu.ox.ac.uk/accessibility"><span>Accessibility</span></a>
                                    </span>

                                    <span class="l-box__separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>

                                    <span role="listitem" class="l-box">
                                        <a href="#top"><span>Top of page</span></a>
                                    </span>
                                </span>
                            </p>
                            <p class="c-utilitext   l-layout  l-row  l-row--start  l-gutter--xs  no-print">
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
                            <p class="c-utilitext   l-layout  l-row  l-row--start  l-gutter--xs">
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
<?php
$error_output = ob_get_contents();
ob_end_clean();

require_once('setup.php');

?>