<!doctype html>
<html lang="en-gb" class="wireframeX  d-background--very-dark  t-neutral">
<head>
    <meta charset="utf-8">
    <title><?php echo $page_title; ?></title>
    <meta name="description" content="<?php echo $page_description; ?>">
    <?php if($page_keywords): ?>
    <meta name="keywords" content="<?php echo $page_keywords; ?>" />
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        /* Tiny fallback styles */
        /* (https://github.com/Fall-Back/Base/edit/master/tiny-fallback-styles.css) */
        body{padding:1em;margin:0 auto;max-width: 50em;}
        img{max-width:100%;-ms-interpolation-mode: bicubic;}
        [hidden]{display:none;}
        main{display:block;}

        /* For YouTube via http://embedresponsively.com. May or may not be needed. */
        .embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }
    </style>

   <!--
        Accessible font loading. FOUT is a lesser evil than FOIT.
        (https://keithclark.co.uk/articles/loading-css-without-blocking-render/)
    -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,700,900&display=swap" rel="stylesheet" media="none" onload="if(media!='all')media='all'">

    <!--
        Print (Edge doesn't apply to print otherwise)
        IE 10, 11
        Edge, Chrome 39+, Opera 26+, Safari 9+, iOS 9+, Android ~5+, Android UCBrowser 11.8+
        FF 47+
    -->
    <link rel="stylesheet" href="/templates/npeu6/css/style.min.css" media="
        only print, screen and (min-width: 1vm),
        only all and (-ms-high-contrast: none), only all and (-ms-high-contrast: active),
        only all and (pointer: fine), only all and (pointer: coarse), only all and (pointer: none),
        only all and (min--moz-device-pixel-ratio:0) and (display-mode:browser), (min--moz-device-pixel-ratio:0) and (display-mode:fullscreen)
    ">

    <?php if($page_brand->alias != 'npeu'): ?>

    <link rel="stylesheet" href="/templates/npeu6/css/theme-<?php echo $page_brand->alias; ?>.min.css" media="
        only print, screen and (min-width: 1vm),
        only all and (-ms-high-contrast: none), only all and (-ms-high-contrast: active),
        only all and (pointer: fine), only all and (pointer: coarse), only all and (pointer: none),
        only all and (min--moz-device-pixel-ratio:0) and (display-mode:browser), (min--moz-device-pixel-ratio:0) and (display-mode:fullscreen)
    ">
    <?php endif; ?>

    <?php foreach($page_stylesheets as $stylesheet => $options): ?>
    <link rel="stylesheet" href="<?php echo $stylesheet; ?>" media="
        only print, screen and (min-width: 1vm),
        only all and (-ms-high-contrast: none), only all and (-ms-high-contrast: active),
        only all and (pointer: fine), only all and (pointer: coarse), only all and (pointer: none),
        only all and (min--moz-device-pixel-ratio:0) and (display-mode:browser), (min--moz-device-pixel-ratio:0) and (display-mode:fullscreen)
    ">
    <?php endforeach; ?>

    <script src="/templates/npeu6/js/script.min.js"></script>

    <?php /*

    {% if page.load_highlighter != false %}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.6/styles/default.min.css">
    <style>
        /* Override hljs styles to reset to StartCSS: * /
        .hljs {
            display: inline-block;
            overflow-x: auto;
            padding: 1.2rem;
            background: transparent;
        }
    </style>
    {% endif %}

    {% if page.has_map %}
        <link href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" rel="stylesheet" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
        <link href="/css/vendor/leaflet-fullscreen.css" rel="stylesheet" />
        <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
        <script src="/js/map.min.js"></script>
    {% endif %}

    {% if page.has_highcharts %}
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    {% endif %}


    */ ?>

    <?php foreach($page_scripts as $script => $options): ?>
    <script src="<?php echo $script; ?>"></script>
    <?php endforeach; ?>

    <?php if (!empty($page_style)): ?>
    <style>
    <?php foreach($page_style as $style): ?>
    <?php echo $style . "\n\n"; ?>
    <?php endforeach; ?>
    </style>
    <?php endif; ?>

    <?php if (!empty($page_script)): ?>
    <script>
    <?php echo $page_script; ?>
    </script>
    <?php endif; ?>

    <link rel="apple-touch-icon" sizes="180x180" href="/templates/npeu6/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/templates/npeu6/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/templates/npeu6/favicon/favicon-16x16.png">
    <link rel="manifest" href="/templates/npeu6/favicon/site.webmanifest">
    <link rel="mask-icon" href="/templates/npeu6/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/templates/npeu6/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-config" content="/templates/npeu6/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <!-- Piwik -->
    <script type="text/javascript">
        var _paq = _paq || [];
        // tracker methods like "setCustomDimension" should be called before "trackPageView"
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u="//<?php echo $_SERVER['SERVER_NAME']; ?>/administrator/components/com_piwik/piwik/";
            _paq.push(['setTrackerUrl', u+'piwik.php']);
            _paq.push(['setSiteId', '1']);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
            g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>
    <?php $piwik_url = '?url=' . base64_encode($_SERVER['REQUEST_URI']) . '&title=' . base64_encode($page_title); ?>
    <!-- End Piwik Code -->

</head>
<body role="document"><?php /*<body role="document" class="{{ project_data.theme_class }}" data-layout="{{ page.layout_name }}"> */ ?>

    <?php echo $page_svg_icons; ?>

    <div class="no-style-notice  no-css-only">
        <hr />
        <p>
            <b>Notice:</b> You are viewing an unstyled version of this page. Are you using a very old browser? If so, <a href="https://browsehappy.com/?locale=en">please consider upgrading</a>.
        </p>
        <hr />
    </div>

    <?php require_once(__DIR__ . '/' . $inner_structure . '.php'); ?>
    
    <?php /*
    
    {% if page.load_highlighter != false %}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.6/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    {% endif %}
    
    */ ?>

</body>
</html>