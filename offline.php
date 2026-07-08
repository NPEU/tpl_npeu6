<?php
/**
 * @package     Joomla.Site
 * @subpackage  tpl_npeu6
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;

$app = Factory::getApplication();

#ini_set('display_errors', 0);

if (!isset($this->error)) {
    #$this->error = JError::raiseWarning(404, Text::_('Joffline_ALERTNOAUTHOR'));
    $this->error = new GenericDataException(Text::_('Joffline_ALERTNOAUTHOR'), 404);
    $this->debug = false;
}
#echo "<pre>\n"; var_dump($this->error); echo "</pre>\n"; exit;
$is_offline   = true;

$offline_code = $this->error->getCode();
#echo '<pre>'; var_dump($is_offline); echo '</pre>'; #exit;
#$display_errors = preg_match('/^(1|yes|on|true)$/i', ini_get('display_errors'));

$offline_page_title   = 'Site offline';
$offline_message = false;

if ($app->get('display_offline_message', 1) == 1 && str_replace(' ', '', $app->get('offline_message')) !== '') {
    $offline_message = $app->get('offline_message');
}
elseif ($app->get('display_offline_message', 1) == 2 && str_replace(' ', '', Text::_('JOFFLINE_MESSAGE')) !== '') {
    $offline_message = Text::_('JOFFLINE_MESSAGE');
}

ob_start();
?>
<header aria-label="Page" class="page-header" data-landmark-index="0">
<div class="l-layout  l-distribute  l-gutter  page-header__brand-banner  page-header__brand-banner--no-cta  npeu">
    <p class="l-layout__inner" data-fs-block="flex  flex-row  flex-spaced">

        <span class="l-box  l-box--center  primary-logo-wrap">
            <a href="/" class="c-badge  c-badge--primary-logo"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 873.1 283.5" role="img" focusable="false" aria-labelledby="npeu--title" height="100" width="308"><title id="npeu--title">NPEU</title><path d="M0 0h873.1v283.5H0z" fill="#604776"></path><g fill="#fff"><path d="M345.7 29.8h-69.9v222.4h56.6v-58.1h16.7c63.8 0 97.2-38.8 97.5-84.1 0-49-36.2-80.2-100.9-80.2m6.1 114.4h-19.4V81h19.2c21.9 0 37.9 10.8 37.8 31.2 0 20.7-16.2 32-37.6 32M235.6 252.5H182L91.9 119.8h-.2v132.6h-54V30h54.4l89.6 130.4h.2V30h53.6v222.5zM618.6 80.5h-90.1v36.9h81.4v46h-81.4v38.9h90.1v50.4H471.9V30.3h146.7zM841 163.1c0 55.1-36.4 94.5-96 94.5-59.1 0-94.7-39.4-94.7-94.5V29.8h56.6v133.4c0 27.8 14.3 43.1 38.1 43.1 24.4 0 39.4-15.3 39.4-43.3V30H841z"></path></g><image xlink:href="" src="/assets/images/brand-logos/unit/npeu-logo.png" alt="Logo: NPEU" height="100" width="308"></image></svg></a>
        </span>


        <span class="l-box  l-box--center">
            <span class="l-layout  l-row  l-gutter  l-gutter--s  l-flush-edge-gutter">
                <span class="l-layout__inner">
                    <span class="l-box">
                        <a href="https://www.wrh.ox.ac.uk/" class="c-badge" rel="external">
                            <img src="/assets/images/brand-logos/affiliate/wrh-lockup-logo.svg" onerror="this.src='/assets/images/brand-logos/affiliate/wrh-lockup-logo.png'; this.onerror=null;" alt="Logo: Nuffield Department of Women’s and Reproductive Health" height="100" width="100">
                        </a>
                    </span>
                    <span class="l-box">
                        <a href="https://www.ox.ac.uk/" class="c-badge" rel="external">
                            <img src="/assets/images/brand-logos/affiliate/university-of-oxford-logo.svg" onerror="this.src='/assets/images/brand-logos/affiliate/university-of-oxford-logo.png'; this.onerror=null;" alt="Logo: University of Oxford" height="100" width="100">
                        </a>
                    </span>
                </span>
            </span>
        </span>
    </p>
</div>

    <div class="d-background" data-fs-block="inverted flush">
        <div class="nav-bar" data-js="cmr" data-ie-safe-parent-level="1">

            <div class="nav-bar__start" data-area="navbar-controls">
                <div class="nav-bar__item">
                    <button class="over-panel-control" hidden="" aria-controls="menu-panel" aria-label="Main menu" aria-expanded="false" data-js="overpanel__control"><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none" class="icon  icon--is-closed">
                        <use xlink:href="#icon-menu"></use>
                        </svg><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none" class="icon  icon--is-open">
                            <use xlink:href="#icon-cross"></use>
                        </svg></button>
                </div>
                <div class="nav-bar__item">
                    <button class="over-panel-control" hidden="" aria-controls="search-panel" aria-label="Search" aria-expanded="false" data-js="overpanel__control"><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none" class="icon  icon--is-closed">
                            <use xlink:href="#icon-search"></use>
                        </svg><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none" class="icon  icon--is-open">
                            <use xlink:href="#icon-cross"></use>
                        </svg></button>
                </div>
            </div>

        </div>

    </div>


</header>
<div class="l-box  l-box--expand  d-border--bottom--thick">
    <main id="main" aria-labelledby="offline_heading">
        <div class="l-layout  l-row  l-gutter--l  l-flush-edge-gutter">
            <div class="l-layout__inner">
                <div class="l-box  ff-width-100--50--60">
                    <div class="c-panel  l-box--space--inline--l">
                        <header class="c-panel__header">
                            <h1 id="offline_heading" tabindex="-1"><?php echo $offline_page_title; ?></h1>
                        </header>
                        <?php if ($offline_message) : ?>
                        <p><?php echo $offline_message; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="l-box  ff-width-100--50--40">
                    <div class="c-panel">
                        <form action="<?php echo Route::_('index.php', true); ?>" method="post" id="form-login">
                            <fieldset>
                                <div class="l-layout  l-row">
                                    <div class="l-layout__inner">
                                        <div class="l-box  l-box--space--inline-end  ff-width-100--25--25">
                                            <label id="username-lbl" for="username" class="required">Username<span class="star">&nbsp;*</span></label>
                                        </div>
                                        <div class="l-box  ff-width-100--25--75">
                                            <input type="text" name="username" id="username" value="" class="u-fill-width  form-control validate-username required" size="25" required="" autocomplete="username" autofocus="">
                                        </div>
                                    </div>
                                </div>
                                <div class="l-layout  l-row">
                                    <div class="l-layout__inner">
                                        <div class="l-box  l-box--space--inline-end  ff-width-100--25--25">
                                            <label id="password-lbl" for="password" class="required">Password<span class="star">&nbsp;*</span></label>
                                        </div>
                                        <div class="l-box  ff-width-100--25--75">
                                            <input type="password" name="password" id="password" value="" autocomplete="current-password" class="u-fill-width  required" size="25" maxlength="99" required="" data-min-length="12" data-min-integers="1" data-min-symbols="1" data-min-uppercase="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="l-layout  l-row  l-row--start">
                                    <div class="l-layout__inner">
                                        <div class="l-box  l-box--space--inline-end">
                                            <input id="remember" type="checkbox" name="remember" value="yes">
                                            <label id="remember-lbl" for="remember">Remember me</label>
                                        </div>
                                        <div class="l-box  l-box--push-end">
                                            <button type="submit">Log in</button>
                                            <input type="hidden" name="return" value="aHR0cHM6Ly93d3cubnBldS5veC5hYy51ay9tYW1h">
                                            <input type="hidden" name="f9728338900f277732fc49feb9ca0521" value="1">
                                        </div>
                                    </div>
                                </div>

                                <div class="l-layout  l-row  l-row--start">
                                    <p class="l-layout__inner">
                                        <span class="l-box  l-box--space--inline-end">
                                            <a href="/login/user-username-reminder">Forgot your username?</a>
                                        </span>
                                        <span class="l-box">
                                            <a href="/login/user-password-reset">Reset your password</a>
                                        </span>
                                    </p>
                                </div>
                                <input type="hidden" name="option" value="com_users" />
                                <input type="hidden" name="task" value="user.login" />
                                <input type="hidden" name="return" value="<?php echo base64_encode(Uri::base()); ?>" />
                                <?php echo HTMLHelper::_('form.token'); ?>
                            </fieldset>
                        </form>
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
                                                <a class="c-badge  c-badge--limit-height--6  x" href="https://x.com/npeu_oxford" rel="external noopener noreferrer" target="_blank"><img alt="X" height="60" onerror="this.src='/assets/images/brand-logos/social/x.png'; this.onerror=null;" src="/assets/images/brand-logos/social/x.svg"></a>
                                            </span>
                                            <span class="l-box">
                                                <a class="c-badge c-badge--limit-height--6 youtube" href="https://www.youtube.com/user/NPEUOxford" rel="external noopener noreferrer" target="_blank"><img alt="YouTube" height="60" onerror="this.src='/assets/images/brand-logos/social/youtube.png'; this.onerror=null;" src="/assets/images/brand-logos/social/youtube.svg"></a>
                                            </span>
                                            <span class="l-box">
                                                <a class="c-badge c-badge--limit-height--6  bluesky" href="https://bsky.app/profile/npeu-oxford.bsky.social" rel="external noopener noreferrer" target="_blank"><img alt="Bluesky" width="60" height="60" onerror="this.src='/assets/images/brand-logos/social/bluesky.png'; this.onerror=null;" src="/assets/images/brand-logos/social/bluesky.svg"></a>
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
$offline_output = ob_get_contents();
ob_end_clean();

require_once('setup.php');

?>