<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  tpl_npeu6
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;
?>
<!doctype html>
<html lang="en-gb">
<head>
    <meta charset="utf-8">
    <title>{{TITLE}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{DESCRIPTION}}">
    <meta name="author" content="{{AUTHOR}}">

    <!-- Chrome 29+, Opera 16+, Safari 6.1+, iOS 7+, Android ~4.4+, IE 10+ (including Edge) -->
    <!-- FF 29+ -->
    <link rel="stylesheet" href="http://j3.gridlight-design.co.uk/templates/tpl_npeu6/css/style.min.css"
        media="only screen and (-webkit-min-device-pixel-ratio:0) and (min-color-index:0), (-ms-high-contrast: none),only all and (min--moz-device-pixel-ratio:0) and (min-resolution: 3e1dpcm)"
    >

    <!-- Piwik: no-js -->
    <!--<noscript>
        <link rel="stylesheet" href="/piwik/piwik.php?idsite=1&amp;rec=1&amp;_cvar=%7B%225%22%3A%5B%22no-js%22%2C%22true%22%5D%7D" />
    </noscript>-->
    <!-- End Piwik Code -->
</head>
<body role="document">

    <svg xmlns="http://www.w3.org/2000/svg" display="none">
        <symbol id="icon-triangle-down" viewBox="0 0 12 16">
            <path d="M1,6h10l-5,5L1,6z"></path>
        </symbol>
        <symbol id="icon-cross" viewBox="0 0 16 16">
            <path d="M15.5,2L14,0.5l-6,6l-6-6L0.5,2l6,6l-6,6L2,15.5l6-6l6,6l1.5-1.5l-6-6L15.5,2z"></path>
        </symbol>
        <symbol id="icon-menu" viewBox="0 0 16 16">
            <rect x="0" width="16" height="3"/>
            <rect x="0" y="6" width="16" height="3"/>
            <rect y="12" width="16" height="3"/>
        </symbol>
        <!-- Other <symbol>s? -->
    </svg>
    
    <div class="no-style-notice  no-css-only">
        <hr />
        <p>
            <b>Notice:</b> You are viewing an <em>unstyled</em> version of this page. Are you using a very old browser? If so, <a href="http://browsehappy.com/">please consider upgrading</a>.
        </p>
        <hr />
    </div>

    <div class="sticky-footer-wrap">           
        <header class="header">
        
            <div class="over-panel  over-panel--slide" id="nav">
                <a href="#" tabindex="-1" class="over-panel__overlay  js-no-history"></a>

                <div class="nav-bar">
                    <div class="nav-bar__title-section">

                        <div class="nav-bar__title-text"><a href="/" class="nav-bar__link">Andy Kirk</a></div>
                        
                        <a href="#nav" class="over-panel__open  js-no-history" hidden><svg display="none" class="icon" aria-label="Open menu"><use xlink:href="#icon-menu"></use></svg></a>

                    </div>
                    <div class="over-panel__wrap">
                        <a href="#" class="over-panel__close  js-no-history" hidden><svg display="none" class="icon" aria-label="Close menu"><use xlink:href="#icon-cross"></use></svg></a>

                        <nav class="nav-bar__inner">
                            <h2 class="visually-hidden" hidden aria-hidden="false">Navigation</h2>
                            <!--<form action="/search" id="searchform" class="search-form  search-form--right" method="GET">
                                <input type="search" class="search-form__field" id="search" placeholder="Search" name="s" value="" aria-label="Search" />
                                <button class="search-form__submit" type="submit">
                                    <span>
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20">
                                            <path fill="#333333" d="M12.917 11.667h-0.662l-0.229-0.229c0.817-0.946 1.308-2.175 1.308-3.521 0-2.992-2.425-5.417-5.417-5.417s-5.417 2.425-5.417 5.417 2.425 5.417 5.417 5.417c1.346 0 2.575-0.492 3.521-1.304l0.229 0.229v0.658l4.167 4.158 1.242-1.242-4.158-4.167zM7.917 11.667c-2.071 0-3.75-1.679-3.75-3.75s1.679-3.75 3.75-3.75 3.75 1.679 3.75 3.75-1.679 3.75-3.75 3.75z"></path>
                                            <text y="-1">Search</text>
                                        </svg>
                                    </span>
                                </button>
                                <a href="#" tabindex="-1" class="search-form__cancel  icon-wrap  js-no-history"><svg display="none" class="icon"><use xlink:href="#icon-cross"></use></svg></a>-->
                                <ul class="search-form__collapse  nav-bar__items">
                                    <li class="nav-bar__item"><a href="/blog" class="nav-bar__link">Blog</a></li>
                                    <li class="nav-bar__item"><a href="/knowledge-base" class="nav-bar__link">Knowledge Base</a></li>
                                    <!--<li class="nav-bar__item  has-subnav">
                                        <span class="subnav__heading">Patterns:</span>
                                        <a href="#patterns-submenu" data-content="Patterns:" class="nav-bar__link  subnav__open  js-no-history" aria-label="Patterns Submenu" hidden> <svg display="none" class="icon  icon--narrow"><use xlink:href="#icon-triangle-down"></use></svg></a>
                                        <ul class="subnav" id="patterns-submenu">
                                            <li class="subnav__item"><a href="https://github.com/Fall-Back/Nav-Bar" class="subnav__link">Nav Bar</a></li>
                                            <li class="subnav__item"><a href="https://github.com/Fall-Back/Search-Form" class="subnav__link">Search Form</a></li>
                                            <li class="subnav__item"><a href="https://github.com/Fall-Back/Off-Canvas" class="subnav__link">Off Canvas</a></li>
                                            <li class="subnav__item"><a href="https://github.com/Fall-Back/Over-Panel" class="subnav__link">Over Panel</a></li>
                                        </ul>
                                        <a href="#" class="subnav__link  subnav__cancel  js-no-history" hidden><svg display="none" class="icon" aria-label="Close submenu"><use xlink:href="#icon-cross"></use></svg></a>
                                    </li>-->
                                </ul>
                            <!--</form>-->
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        
        <div class="sticky-footer-expand">
            <main role="main" class="main-container">
                <jdoc:include type="message" />
                <jdoc:include type="component" />
            </main>
        </div>
        
        <footer class="sticky-footer" role="contentinfo">
            <p class="page-footer">
                <a href="#">Top</a> | <a href="https://github.com/andykirk/andykirk.github.io">Github</a> | &copy; Andy Kirk 2016
            </p>
        </footer>
    </div>


    <script src="/js/script.min.js"></script>
    
</body>
</html>
<?php
return;

#ini_set('display_errors', 1);
#ini_set('display_startup_errors', 1);
#error_reporting(E_ALL);

// Some useful debugging stuff:
#phpinfo();exit;
#echo '<pre>'; var_dump(apache_get_modules()); echo '</pre>';exit;
#$c = get_defined_constants(true); echo '<pre>'; var_dump($c['user']); echo '</pre>';exit;
#echo '<pre>'; var_dump($_SERVER); echo '</pre>';exit;

// Ideally project-specifc vars should be set in .htaccess via SetEnv to make
// sure that .htaccess id the ONLY non-portable file for boilerplate set up.
// However, it's not always available so vars need to be set here instead.

// Environment settings:
#$application_env = 'production';
#$application_env = 'development';
#$application_env = in_array($_SERVER['SERVER_NAME'], array('dev.npeu.ox.ac.uk')) ? 'development' : 'production';
$application_env = $_SERVER['SERVER_NAME'] == 'dev.npeu.ox.ac.uk' ? 'development' : ($_SERVER['SERVER_NAME'] == 'test.npeu.ox.ac.uk' ? 'testing' : 'production');
#echo '<pre>'; var_dump($application_env); echo '</pre>';exit;
$project_name    = 'NPEU';
$rel_base_path   = '/../../'; // Can't be auto-detect so set relative to THIS file
$project_type    = 'joomla';
$encoding        = 'utf-8';
$language        = "en-gb";
// Common paths (relative to BASE_PATH - set below):
$startup_file    = 'templates' . DIRECTORY_SEPARATOR . 'npeu5' . DIRECTORY_SEPARATOR . 'startup.php';
$libraries_dir   = 'libs';

// Default page settings:
$page_data = array(
    'page_id'          => 'home',
    'description'      => 'Home page',
    'title'            => 'Home',
    'author'           => 'NPEU',
    'keywords'         => '',
    'content'          => '<p>Main content...</p>',
    'link_tags'        => false,
    'meta_tags'        => false,
    'inline_style'     => false,
    'head_script_tags' => false,
    'head_script'      => false,
    'foot_script_tags' => false,
    'foot_script'      => false,
    'stylesheets'      => false
);

// Should not need to edit below here.
$base_path = realpath(dirname(__FILE__) . $rel_base_path);

// Start constants:
defined('_CORE') || define('_CORE', true);
define('BASE_PATH', $base_path . DIRECTORY_SEPARATOR);

// Include environment setup:
require_once BASE_PATH .  DIRECTORY_SEPARATOR . $libraries_dir . DIRECTORY_SEPARATOR . 'env_setup.php';
#echo '<pre>'; var_dump($_SERVER); echo '</pre>'; exit;
#$const = get_defined_constants(true); echo '<pre>'; var_dump($const['user']); echo '</pre>'; exit;
require_once 'templates/npeu5/helpers.php';

$modern_styles = stamp_filename('css/modern.css', PUBLIC_PROJECT_PATH, PROJECT_SEG_URL);

if ($startup_file) {
    require_once realpath(BASE_PATH . $startup_file);
}
#echo '<pre>'; var_dump($page_data); echo '</pre>'; exit;
extract($page_data);
// Temp - fix these properly rather than just emptying:
#echo '<pre>'; var_dump($meta_tags); echo '</pre>'; exit;
$meta_tags   = array();
$link_tags   = array();
#$stylesheets = array();
#echo '<pre>'; var_dump($foot_script_tags); echo '</pre>'; exit;
if ($project->name != $title && $project->name != 'NPEU') {
    $title .= ' | ' . $project->name;
}
$title .= ' | NPEU';
$title = escape_text($title);
/**/
$html_class = $application_env != 'production' ? $application_env . ' ' : '';
ob_start();
?><!doctype html>
<html class="<?php echo $html_class; ?>no-js" lang="<?php echo $language; ?>">
<head>
<meta charset="<?php echo $encoding; ?>" />
<title><?php echo $title; ?></title>

<meta name="description" content="<?php echo $description; ?>" />
<meta name="author" content="<?php echo $author; ?>" />
<?php if (!empty($keywords)): ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php endif; ?>
<meta name="viewport" id="viewport" content="width=device-width" />
<?php if ($meta_tags): ?>
<?php foreach ($meta_tags as $meta_tag): ?>
<meta <?php echo tag_attribs($meta_tag); ?> />
<?php endforeach; ?>
<?php endif; ?>
<?php if ($link_tags): ?>
<?php foreach ($link_tags as $link_tag): ?>
<link <?php echo tag_attribs($link_tag); ?> >
<?php endforeach; ?>
<?php endif; ?>
<?php if ($stylesheets): ?>
<?php foreach ($stylesheets as $stylesheet): ?>
<link <?php echo tag_attribs($stylesheet); ?> rel="stylesheet">
<?php endforeach; ?>
<?php endif; ?>

<!-- Main style -->
<link rel="stylesheet" href="<?php echo stamp_filename('css/style.min.css', PUBLIC_PROJECT_PATH, PROJECT_SEG_URL); ?>" media="only screen and (min-resolution: 0.1dpcm)">
<link rel="stylesheet" href="<?php echo stamp_filename('css/style.min.css', PUBLIC_PROJECT_PATH, PROJECT_SEG_URL); ?>" media="only screen and (-webkit-min-device-pixel-ratio:0) and (min-color-index:0)">
<link rel="stylesheet" href="<?php echo stamp_filename('css/style.min.css', PUBLIC_PROJECT_PATH, PROJECT_SEG_URL); ?>" media="only screen and (-webkit-min-device-pixel-ratio:1.1)">

<!--[if IE 8]>
<link rel="stylesheet" href="<?php echo stamp_filename('css/style.min.css', PUBLIC_PROJECT_PATH, PROJECT_SEG_URL); ?>">
<![endif]-->

<script>
    if (navigator.userAgent.indexOf('UCBrowser') > -1) {
      var link  = document.createElement('link');
      link.rel  = 'stylesheet';
      link.href = '<?php echo stamp_filename('css/style.min.css', PUBLIC_PROJECT_PATH, PROJECT_SEG_URL); ?>';
      document.getElementsByTagName('head')[0].appendChild(link);
    }
</script>

<?php if($inline_style): ?>

<!-- Inline style -->
<style>
<?php echo $inline_style; ?>
</style>
<?php endif; ?>

<!-- Common JS -->
<script src="/<?php echo PROJECT_SEG_URL; ?>js/vendor/modernizr-2.6.2-custom.min.js"></script>
<script>
if(Modernizr.mq("only screen and (max-width: 767px)")) {
   document.getElementById("viewport").setAttribute("content", "width=device-width, user-scalable=no");
}
// Some useful common js vars:
var root         = '/<?php echo PROJECT_SEG_URL; ?>';
var modernStyles = '<?php echo $modern_styles; ?>';
</script>

<?php if ($head_script_tags): ?>
<!-- Dynamic head JS tags -->
<?php foreach ($head_script_tags as $script_tag): ?>
<script <?php echo tag_attribs($script_tag); ?>></script>
<?php endforeach; ?>
<?php endif; ?>

<?php if($head_script): ?>
<!-- Dynamic head JS -->
<script>
<?php echo $head_script; ?>
</script>
<?php endif; ?>

<!-- IE8 support -->
<!--[if IE 8]>
<script src="/<?php echo PROJECT_SEG_URL; ?>js/load-style.js"></script>
<script src="/<?php echo PROJECT_SEG_URL; ?>js/vendor/respond.min.js"></script>
<![endif]-->

<!-- Old IE fallback style -->
<!--[if lte IE 7]>
<link rel="stylesheet" href="/<?php echo PROJECT_SEG_URL; ?>css/ufs.css" media="screen, projection">
<![endif]-->

<noscript>
    <!-- Make Piwik no-script call: -->
    <!-- Note: rel="prefetch" may be more semantic here, but doesn't work in IE -->
    <link rel="stylesheet" href="/utils/piwik-no-js.php?url=<?php echo base64_encode($_SERVER['REQUEST_URI']); ?>&amp;title=<?php echo base64_encode($title); ?>" />
</noscript>

<!-- Favicons: (generated by http://realfavicongenerator.net/) -->
<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192">
<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="/manifest.json">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="apple-mobile-web-app-title" content="NPEU">
<meta name="application-name" content="NPEU">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="msapplication-TileImage" content="/mstile-144x144.png">
<meta name="theme-color" content="#ffffff">

</head>
<!--
body id prefixed "p-" to help separate from articles with same id (where article
IS the page) and article titles that may begin with a number.
-->
<?php /*<body id="p-<?php echo $page_id; ?>" class="p-<?php echo $page_id; ?>  <?php echo $layout_name; ?>-page<?php echo $is_project_class; ?><?php echo $project_class; ?>" role="document">*/ ?>
<body id="p-<?php echo $page_id; ?>" role="document">
<!--[if lt IE 8]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
<h1 class="visuallyhidden  print-doc-title" data-qr-url="https://chart.googleapis.com/chart?cht=qr&amp;chs=150x150&amp;chl=<?php echo urlencode('https://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]); ?>&amp;choe=UTF-8" ><?php echo $title; ?></h1>
<header id="top" class="top">
    <div class="top-bar  cf">
        <ul id="skiplinks" class="skiplinks  no-print">
            <li class="skip-primary-content"><a href="#primary-content" class="skip-content"><span>Skip to content</span></a></li>
            <li class="skip-main-nav"><a href="#main-nav" class="skip-nav"><span>Skip to navigation</span></a></li>
            <li class="skip-site-footer"><a href="#site-footer" class="skip-links"><span>Skip to footer</span></a></li>
        </ul>
        <p id="user-controls" class="user-controls">
        <?php if(!$user->get('guest')): ?>
            <a href="/user-profile">Logged in as <?php echo $user->username; ?> (view profile)</a> | <a href="/logout?<?php echo JSession::getFormToken(); ?>=1&amp;return=<?php echo base64_encode('/login?logged-out'); ?>">Logout</a><?php if(!$user->get('staff')): ?> | <a href="/administrator">Admin</a><?php endif; ?>
        <?php else: ?>
        <a href="/login">NPEU Login</a>
        <?php endif; ?>
        | <a href="https://intranet.npeu.ox.ac.uk">Staff Area</a>
        </p>
    </div>

    <div id="" role="banner" class="gw  banner  ufs-clearfix"><!--
     --><div class="g  palm-one-half  lap-two-fifths  desk-one-third  ufs-pull-left">
            <div class="banner-left">
                <div class="svg  svg--fixed-height  svg--fixed-height--npeu-logo" itemscope itemtype="http://schema.org/Organization">
                    <a href="https://<?php echo $_SERVER['SERVER_NAME']; ?>" class="svg__link" itemprop="url">
                        <object type="image/svg+xml" data="/img/banner-logos/npeu-logo.svg" height="110" class="svg__image" aria-hidden="true" tabindex="-1">
                            <svg display="none">
                                <image src="/img/banner-logos/npeu-logo.png" height="110" alt="National Perinatal Epidemiology Unit (NPEU)" class="svg__fallback-image" />
                            </svg>
                            <span class="svg__fallback-text-alpha" data-content="National Perinatal Epidemiology Unit (NPEU)"></span>
                        </object>
                        <div><i class="svg__fallback-text-beta" itemprop="name">National Perinatal Epidemiology Unit (NPEU)</i></div>
                    </a>
                    <link itemprop="sameAs" href="https://twitter.com/npeu_oxford" />
                    <link itemprop="logo" href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/img/banner-logos/npeu-logo.svg" />
                </div>
                <div class="svg  svg--fixed-height  svg--fixed-height--as-logo">
                    <a href="/athena-swan" class="svg__link">
                        <object type="image/svg+xml" data="/img/awards/athena-swan-silver-award-proud.svg" height="70" class="svg__image" aria-hidden="true" tabindex="-1">
                            <svg display="none">
                                <image src="/img/awards/athena-swan-silver-award-proud.png" height="70" alt="The NPEU is proud to hold an Athena Swan Silver Award" class="svg__fallback-image" />
                            </svg>
                            <span class="svg__fallback-text-alpha" data-content="The NPEU is proud to hold an Athena Swan Silver Award"></span>
                        </object>
                       <div><i class="svg__fallback-text-beta">The NPEU is proud to hold an Athena Swan Silver Award</i></div>
                    </a>
                </div>
            </div>
        </div><!--
     --><div class="g  palm-one-half  lap-three-fifths  desk-two-thirds  ufs-pull-right">
            <div class="banner-right">
                <div class="gw">
                    <div class="g  palm-one-whole  lap-and-up-one-half  push--lap-and-up-one-half  parent-org-logos">
                        <div class="gw">
                            <div class="g  palm-one-whole  banner-tweak-one-half  lap-and-up-one-whole  parent-org-logo--ndph">
                                <div class="svg  svg--fixed-height  svg--fixed-height--parent-logo">
                                    <a href="http://www.ndph.ox.ac.uk/" class="svg__link  ndph" rel="external" target="_blank">
                                        <object type="image/svg+xml" data="/img/banner-logos/ndph-logo.svg" height="50" class="svg__image" aria-hidden="true" tabindex="-1">
                                            <svg display="none">
                                                <image src="/img/banner-logos/ndph-logo.png" height="50" alt="Nuffield Department of Population Health website (external)" class="svg__fallback-image" />
                                            </svg>
                                            <span class="svg__fallback-text-alpha" data-content="Nuffield Department of Population Health website (external)"></span>
                                        </object>
                                       <div><i class="svg__fallback-text-beta">Nuffield Department of Population Health website (external)</i></div>
                                    </a>
                                </div>
                            </div>
                            <div class="g  palm-one-whole  banner-tweak-one-half  lap-and-up-one-whole  parent-org-logo--ou">
                                <div class="svg  svg--fixed-height  svg--fixed-height--parent-logo">
                                    <a href="http://www.ox.ac.uk/" class="svg__link  ou" rel="external" target="_blank">
                                        <object type="image/svg+xml" data="/img/banner-logos/ou-logo-rect.svg" height="50" class="svg__image" aria-hidden="true" tabindex="-1">
                                            <svg display="none">
                                                <image src="/img/banner-logos/ou-logo-rect.png" height="50" alt="University of Oxford website (external)" class="svg__fallback-image" />
                                            </svg>
                                            <span class="svg__fallback-text-alpha" data-content="University of Oxford website (external)"></span>
                                        </object>
                                       <div><i class="svg__fallback-text-beta">University of Oxford website (external)</i></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="g  palm-one-whole  lap-and-up-one-half  pull--lap-and-up-one-half  text--center">
                        <div class="services  no-print">
                            <div class="service  service--randomisation  ufs-box">
                                <a href="https://rct.npeu.ox.ac.uk">Randomisation</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /#banner -->
    <div id="main-nav" class="main-nav  navbar  palm-sticky  no-print  ufs-box">
        <nav class="navbar__inner" role="navigation">
            <h2 class="visuallyhidden">Navigation</h2>
            <a href="#" class="close  lap-and-up-hidden  ufs-visuallyhidden" title="Close navigation">×</a>
            <ol class="navbar__items  navbar__search">
                <li class="navbar__item"><a href="/about" tabindex="0" class="icon  icon-info">About Us</a><a href="#" tabindex="0" class="subnavbar-trigger"><i>▼</i><span class="visuallyhidden  ufs-visuallyhidden">Sub menu follows</span></a>
                    <ol class="subnavbar" id="subnav-about">
                        <li class="subnavbar__item"><a href="/contact" tabindex="0">Contact us</a></li>
                        <li class="subnavbar__item"><a href="/jobs" tabindex="0">Jobs</a></li>
                        <li class="subnavbar__item"><a href="/postgrad" tabindex="0">Postgraduate Studies</a></li>
                        <li class="subnavbar__item"><a href="/seminars" tabindex="0">Seminars</a></li>
                        <li class="subnavbar__item"><a href="/athena-swan" tabindex="0">Athena Swan</a></li>
                        <li class="subnavbar__item"><a href="/working-in-npeu" tabindex="0">Working in the NPEU</a></li>
                        <li class="subnavbar__item"><a href="/involvement" tabindex="0">Getting Involved</a></li>
                    </ol>
                </li>
                <li class="navbar__item"><a href="/news" class="icon  icon-newspaper">News</a></li>
                <li class="navbar__item"><a href="/research" tabindex="0" class="icon  icon-lightbulb">Research</a><a href="#" tabindex="0" class="subnavbar-trigger"><i>▼</i><span class="visuallyhidden  ufs-visuallyhidden">Sub menu follows</span></a>
                    <ol class="subnavbar" id="subnav-research">
                        <li class="subnavbar__item"><a href="/prumhc" tabindex="0">PRU-MHC</a></li>
                        <li class="subnavbar__item"><a href="/epi-hsr" tabindex="0">Epi &amp; HSR</a></li>
                        <li class="subnavbar__item"><a href="/trials" tabindex="0">Trials</a></li>
                        <li class="subnavbar__item"><a href="/mbrrace-uk" tabindex="0">MBRRACE-UK</a></li>
                        <li class="subnavbar__item"><a href="/ukoss" tabindex="0">UKOSS</a></li>
                        <li class="subnavbar__item"><a href="/research#research-themes" tabindex="0">Research Themes</a></li>
                    </ol>
                </li>
                <li class="navbar__item"><a href="/people" class="icon  icon-people">People</a></li>
                <li class="navbar__item"><a href="/publications" class="icon  icon-book">Publications</a></li>
                <li class="navbar__item  width--max" itemscope itemtype="http://schema.org/WebSite">
                    <meta itemprop="url" content="https://<?php echo $_SERVER['SERVER_NAME']; ?>"/>
                    <form id="nav_search_form" class="searchform" action="/search" role="search" method="get" itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction">
                        <meta itemprop="target" content="https://<?php echo $_SERVER['SERVER_NAME']; ?>/search?q={q}"/>
                        <fieldset class="inline-fieldset  max-input  composite">
                            <span class="width--max"><input itemprop="query-input" name="q" class="text-input" type="search" id="search_q" placeholder="Enter search..." required /></span>
                            <span><button class="btn  btn--last  search-icon" type="submit" title="Search">Search</button></span>
                        </fieldset>
                    </form>
                </li>
            </ol>
        </nav>
    </div><!-- /#main-nav -->
    <?php /*KEEP FOR REFERENCE: if ($cookieflash):
    <p id="cookieflash" class="alert  fade  in  no-print  msgflash">
        <a href="/utils/setcookie.php?name=dismiss_cookie_notice&amp;value=1&amp;redirect=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" class="close" title="Dismiss" data-dismiss="alert">×</a>
        <strong>Please note this site makes essential use of cookies. Please view the <a href="/privacy-cookies">NPEU cookie page</a> for more information.</strong>
    </p>
    endif; */ ?>
</header>
<?php if(has_announcements($doc) && !$is_error ): ?>
<jdoc:include type="modules" name="announcements" wrapper="section" wrapperid="announcements" wrapperclass="no-print" headerclass="visuallyhidden" style="basic" />
<?php endif; ?>
<?php if (has_breadcrumbs($doc) && !$is_error ): ?>
<jdoc:include type="modules" name="breadcrumbs" wrapper="nav" wrapperclass="breadcrumbs  no-print" headerclass="visuallyhidden" style="basic" />
<?php endif ; ?>
<?php echo get_messages(); ?>
<!-- Start page-specific content: -->
<main role="main" class="<?php echo $page_class; ?>-page  print--this">
<?php if (!$is_error): ?>
<?php if (file_exists($layout_file)): ?>
<?php require_once($layout_file); ?>
<?php else: ?>
<jdoc:include type="component" format="raw" />
<?php endif; ?>
<?php else: ?>
<?php echo $error_content; ?>
<?php endif; ?>
</main>
<!-- End page-specific content -->
<div class="ufs-box">
    <ul id="page-tools" class="nav  no-print"><!--
    <?php /*    <li><a href="http://api.qrserver.com/v1/create-qr-code/?data=https://qr.npeu.ox.ac.uk/<?php echo $menu_id; ?>">QR code (png)</a></li>*/ ?>
    <?php if ((isset($user->groups[$project->admin_group_id]) || isset($user->groups['11'])) && $content_id != false): ?>--><li><a href="/administrator/index.php?option=com_content&amp;task=article.edit&amp;id=<?php echo $content_id; ?>" class="icon  icon-external" target="_blank">Edit main content</a></li><!--<?php endif; ?>
    <?php if (isset($user->groups['15'])): ?>--><li><a href="http://api.qrserver.com/v1/create-qr-code/?data=http://qr.npeu.ox.ac.uk/<?php echo $menu_id; ?>&amp;format=eps" class="icon  icon-qrcode">QR code (eps)</a></li><!--<?php endif; ?>
        --><li><a href="#top" class="icon  icon-arrow-up  toplink">Top<span class="visuallyhidden"> of page</span></a></li><!--
    --></ul>
</div>
<footer id="site-footer" class="no-print  ufs-box">
<div class="gw" id="useful-links" >

    <div class="g  palm-one-whole  one-quarter">
        <ul class="nav  nav--stacked  divider-right">
            <li><a href="/">Home</a></li>
            <li><a href="/contact">Contact Us</a></li>
            <li><a href="/findus">Find Us</a></li>
            <li><a href="/jobs">Jobs</a></li>
            <li><a href="/postgrad" >Postgraduate Studies</a></li>
        </ul>
    </div>
    <div class="g  palm-one-whole  one-quarter">
        <ul class="nav  nav--stacked  divider-right">
            <li><a href="/news" >News</a></li>
            <li><a href="/seminars" >Seminars</a></li>
            <li><a href="/athena-swan" >Athena Swan</a></li>
            <li><a href="/working-in-npeu" >Working in the NPEU</a></li>
            <li><a href="/involvement" >Getting Involved</a></li>
        </ul>
    </div>
    <div class="g  palm-one-whole  one-quarter">
        <ul class="nav  nav--stacked  divider-right">
            <li><a href="/sitemap">Site map</a></li>
            <li><a href="/links">Links</a></li>
            <li><a href="/accessibility-help">Accessibility &amp; Help</a></li>
            <li><a href="/privacy-cookies">Privacy &amp; Cookies</a></li>
            <li><a href="/webmaster">Contact the webmaster</a></li>
        </ul>
    </div>
    <div class="g  one-quarter  palm-one-whole">
        <p class="text--center"><?php /*<!--
            <a href="/athena-swan" class="footer-logo">
                <img src="/img/awards/athena-swan-silver-award.png?s=100" alt="Athena Swan Silver Award" />
            </a>
        </p>
        <p class="text--center  divider-above">-->*/ ?>
            <a class="icon  icon-twitter" href="https://twitter.com/npeu_oxford">Follow us on Twitter</a>
        </p>
        <p class="text--center  divider-above">
            <a class="icon  icon-youtube" href="https://www.youtube.com/user/NPEUOxford">NPEU YouTube Channel</a>
        </p>
    </div>
</div>
<p class="vcard  divider-above" role="contentinfo">
    <span class="adr">
    <span class="fn  org">National Perinatal Epidemiology Unit (<abbr>NPEU</abbr>)</span>,&nbsp;
    <span>Nuffield Department of Population Health</span><br />
    <span class="street-address">University of Oxford, Old Road Campus, Headington</span>,&nbsp;
    <span class="locality">Oxford</span>,&nbsp;
    <span class="postal-code">OX3 7LF</span></span><br />
    Tel: <span class="tel"><span class="value">+44</span> (0)<span class="value">1865 289700</span></span>
</p>
</footer>
<!-- JavaScript at the bottom for fast page loading -->
<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
<?php /*
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="/<?php echo PROJECT_SEG_URL; ?>js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
*/
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="/<?php echo PROJECT_SEG_URL; ?>js/vendor/jquery-1.10.2.min.js"><\/script>')</script>

<script src="<?php echo stamp_filename('js/script.min.js', PUBLIC_PROJECT_PATH, PROJECT_SEG_URL); ?>"></script>

<?php if ($foot_script_tags): ?>
<!-- Dynamic foot JS tags -->
<?php foreach ($foot_script_tags as $script_tag): ?>
<?php #if (!preg_match('#^/js|//.*#', $script_tag['src'])) {continue;} ?>
<script <?php echo tag_attribs($script_tag); ?>></script>
<?php endforeach; ?>
<?php endif; ?>

<?php if($foot_script): ?>
<!-- Dynamic foot JS -->
<script>
<?php echo $foot_script; ?>
</script>
<?php endif; ?>

<?php if (count_modules($this, 'cookie-control') && !$is_error ): ?>
<jdoc:include type="modules" name="cookie-control" style="none" />
<?php endif ; ?>
</body>
</html>
<?php
$output = ob_get_contents();
ob_end_clean();
/*$output = $saon->onPostProcess($output);
   $replace = array(
   '#(<(?:a|input|img).*(?:href|src)="/)#' => '$1xxx/'
   );
   echo replace_html5_tags($output, $replace, 8);*/
// Piwik Stuff:
/*
   require_once JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_piwik' . DS . 'PiwikTracker.php';
   PiwikTracker::$URL = 'http://jandev.local/administrator/components/com_piwik/piwik/';

   $piwikTracker = new PiwikTracker( $idSite = 1 );
   $piwikTracker->doTrackPageView($title);
*/
echo $output;
?>