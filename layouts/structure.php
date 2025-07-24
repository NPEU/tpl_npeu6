<?php
use NPEU\Template\Npeu6\Site\Helper\Npeu6Helper as TplNPEU6Helper;

$block_css_files = false;
#$block_css_files = true;
?><!doctype html>
<html lang="en-gb" class="env-<?php echo $env; ?>">
<head>
    <meta charset="utf-8">
    <title><?php echo $page_title; ?></title>
    <meta name="description" content="<?php echo $page_description; ?>">
    <?php if($page_keywords): ?>
    <meta name="keywords" content="<?php echo $page_keywords; ?>" />
    <?php endif; ?>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <?php if ($is_blog && $page_is_subroute == false): ?>

    <link href="<?php echo $uri->getPath() ?>?format=feed&type=rss" rel="alternate" type="application/rss+xml" title="RSS 2.0">
    <link href="<?php echo $uri->getPath() ?>?format=feed&type=atom" rel="alternate" type="application/atom+xml" title="Atom 1.0">
    <?php endif; ?>

    <!-- Ultra-light fallback styles for ancient browsers: -->
    <meta id="css_has_loaded">
    <style>
        /*
            The following styles provide a better visual experience in cases where linked
            stylesheets aren't loaded for any reason. It's recommended that any styles that won't
            be used by the elements on the page be removed to make this as lean as possible.
            Previously I recommended running this CSS through a minifier
            (e.g. https://cssminifier.com) to compress it as much a possible, since this is sent on
            each request and not cached. However the savings are very small and there's a chance a
            minifier may break some CSS that's been crafted specially with hacks or moderng syntax
            that's unsupported by the minfier.

            Note there's a section that uses attributes to apply styles to specific elements. This
            is so as not to pollute the class space and help authors make distinctions.
            There's a much long essay on this brewing and I'll add the link when it's done.

            Colour references for ease of search/replace:
            colour-1: darkslategrey
            colour-2: silver
        */

        /* --| Core styles |--------------------------------------------------------------------- */
        html {
            background-color: <?php echo $page_brand->primary_colour__dark; ?>;
        }

        body {
            font: 1em/1.2 sans-serif;
            padding: 2em;
            margin: 0 auto;
            max-width: 50em;
            background: #fff;
        }

        /* For older browsers:(see https://github.com/aFarkas/html5shiv) */
        dialog,
        details,
        main,
        summary {
            display: block;
        }

        @supports (list-style-type: disclosure-closed) {
            summary {
                display: list-item;
            }
        }

        mark {
            background: #FF0;
            color: #000;
        }

        template,
        [hidden] {
            display: none;
        }

        /* The "older browser" message makes use of a fieldset to add a border no matter what: */
        fieldset {
            border: 1px solid;
            border-color: currentColor;
            margin: 1em 0;
            padding: 1em;
        }

        /* More responsive images: */
        /* Note ancient image tag is actually for the SVG FalBack PNG method */
        img,
        image,
        object,
        svg {
            max-width: 100%;
            -ms-interpolation-mode: bicubic;
            vertical-align: middle;
            height: auto;
            border: 0;
        }

        /* Links and image links */
        a[href] {
            color: inherit;
        }

        a[href]:hover {
            text-decoration: none;
        }

        a[href] img {
            padding: 0.3em;
            margin: 0.2em;
        }

        /*
            Putting things like tables in figures makes sense and allows them to become scrollable
            if they're too wide.
        */
        figure {
            max-width: 100%;
            overflow-x: auto;
        }

        /*
            BUT! Opera Mini doesn't support scrolling areas so hacking it out for that browser:
        */
        _:-o-prefocus, :root figure {
            max-width: initial;
            overflow-x: visible;
        }

        hr {
            border-style: solid;
            border-width: 0 0 1px 0;
            margin: 1em 0;
            color: currentColor;
        }

        pre {
            width: 100%;
            overflow-x: scroll;
            overflow-y: auto;
        }

        video {
            max-width: 100%;
            height: auto;
        }


        /* --| Form styles |--------------------------------------------------------------------- */
        /* If you're using forms, keep this: */

        button {
            background-color: <?php echo $page_brand->primary_colour; ?>;
            color: #fff;
        }

        button,
        input,
        label,
        select,
        textarea {
            vertical-align: middle;
            vertical-align: middle;
            min-height: 2.2em;
            margin: 0.2em 0;
        }

        button,
        input[type="checkbox"],
        input[type="radio"],
        label,
        select {
            cursor: pointer;
        }

        button,
        input,
        textarea {
            padding: 0 0.5em;
            line-height: 1.5;
        }


        /* --| Table styles |-------------------------------------------------------------------- */
        /* If you're using tables, keep this: */

        table {
            width: 100%;
            border: 1px solid currentColor;
            border-collapse: collapse;
        }

        table[role="presentation"] {
            border: 0;
            table-layout: fixed;
        }

        table[role="presentation"] td {
            border: 0;
        }

        th {
            background-color: <?php echo $page_brand->primary_colour__very_light; ?>;
        }

        caption, td, th {
            padding: 0.5em;
        }

        /*
            What follows is a mix of markup patterns and attributes to help provide a more
            reasonable fallback - it's unconventional, so leave it out if you like.
        */

        /* Attributes to replicate deprecated HTML styling: */

        /* Would have been align="right": */
        [data-fs-text~="right"] {
            text-align: right;
        }

        /* Would have been align="center": */
        [data-fs-text~="center"] {
            text-align: center;
        }

        /* Would have been the 'big' element: */
        [data-fs-text~="larger"] {
            font-size: larger;
        }

        [data-fs-text~="nowrap"] {
            white-space: nowrap;
        }

        /* EXTRA: */

        a[href] img:hover,a[href] svg:hover{outline: 2px solid;}

        /* For YouTube via http://embedresponsively.com. May or may not be needed. */
        .embed-container{position:relative;padding-bottom:56.25%;height:0;overflow:hidden;max-width:100%;} .embed-container iframe, .embed-container object, .embed-container embed{position:absolute;top:0;left:0;width:100%;height:100%;}

        /* IE needs SVG icons to NOT be auto height: */
        svg[height="1.25em"] {height: 1.25em;}

        .js-map .c-map {
            height: 200px;
        }

        [data-fs-block=hidden]{display:none !important}

        /* IE 9, 10 shows svg fallback images as broken images: */
        _::selection, svg image { display:none\0; }

        /*
            IE 10's JS can break when tryignto load YouTube player, which in turn breaks the
            `details` polyfill, making `details` content invisible, so fix that:
        */
        _:-ms-lang(x), .selector { details:not([open])>:not(summary){display:block\9 !important}; }
    </style>

    <!-- From here we're cutting off IE9- to stop all kinds of JS and CSS fails. -->
    <!--[if !IE]><!-->

    <style>
        /*
            Tiny Fall-Back Styles continued ...

            What follows is a mix of markup patterns and attributes to help provide a more
            reasonable fallback - it's unconventional, so leave it out if you like.
        */

        /* --| Block styles |-------------------------------------------------------------------- */
        [data-fs-block] {
            display: block;
            margin-left: 0;
            margin-right: 0;
        }

        [data-fs-block~="fill-width"] {
            width: 100%;
        }

        [data-fs-block~="inline"] {
            display: inline-block;
        }

        [data-fs-block~="background"] {
            background-color: <?php echo $page_brand->primary_colour__light; ?>;
            padding: 1em;
        }

        [data-fs-block~="inverted"] {
            background-color: <?php echo $page_brand->primary_colour; ?>;
            padding: 1em;
        }

        [data-fs-block~="inverted"] * {
            color: #fff;
        }

        [data-fs-block~="inverted"] img {
            background: #fff;
            padding: 0.5em;
            border: 0;
            max-width: -webkit-calc(100% - 1em);
            max-width: -moz-calc(100% - 1em);
            max-width: calc(100% - 1em);
        }

        [data-fs-block~="border"] {
            border: 1px solid <?php echo $page_brand->primary_colour; ?>;
            margin: 1em 0;
            padding: 1em;
        }

        [data-fs-block~="rounded"] {
            border-radius: 1em;
        }

        [data-fs-block~="padding"] {
            padding: 1em;
        }

        [data-fs-block~="margin"] {
            margin: 1em;
        }


        [data-fs-block~="flush"]{
            margin-left: -2em;
            margin-right: -2em;
        }

        [data-fs-block~="flush"]:last-child{
            margin-bottom: -2em;
        }

        /* --| Table Layout |-------------------------------------------------------------------- */
        /*
            Useful when you have a very small amount of items you want to display side-by-side.
            Like, maybe 2, on the left and right. It doesn't wrap so the items should be small.
            There's reasonable support. Better support would be:
            `<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation">`
            But we're not supposed to use deprecated 'presentational' elements and attributes.
        */
        [data-fs-block~="table"] {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        [data-fs-block~="table"] > * {
            display: table-cell;
            padding: 0.5em;
        }


        /* --| Flex Layout |--------------------------------------------------------------------- */
        /*
            More responsive and has wrapping, but less well supported than the table layout.
        */
        @supports (flex-wrap: wrap) {
            [data-fs-block~="flex"] {
                display: flex;
            }

            [data-fs-block~="flex-row"] {
                flex-wrap: wrap;
            }

            [data-fs-block~="flex-spaced"] {
                justify-content: space-around;
            }

            [data-fs-block~="flex-column"] {
                flex-direction: column;
            }

            [data-fs-block~="flex"] > * {
                flex: 1 1 auto;
                margin: 1em;

                display: flex;
            }

            [data-fs-block~="inline"] {
                align-self: center;
            }


            [data-fs-block~="flex-spaced"] > * {
                flex-grow: 0;
            }


            [data-fs-block~="flex"] * {
                max-width: 100%;
            }

            [data-fs-block~="flex"] > * > [data-fs-block] {
                margin: 0;
            }

            [data-fs-block~="flex-first"] {
                order: -1;
            }

            [data-fs-block~="gutter"] {
                padding: 0.5em;
            }

            [data-fs-block~="gutter"] > * {
                padding: 0.5em;
            }

            [data-fs-block~="flush-gutter"] {
                margin: -1em;
            }


            [data-fs-block~="flex-30"] > * {
                flex-basis: calc(30% - 6em);
            }

            [data-fs-block~="flex-50"] > * {
                flex-basis: calc(50% - 4em);
            }

            [data-fs-block~="min-15"] > * {
                min-width: 15em;
            }
        }
        /* --| Other stuff |--------------------------------------------------------------------- */

        /* Responsive embeds (e.g. YouTube, maps) via http://embedresponsively.com. */
        [data-fs-block="video"] {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            max-width: 100%;
        }

        [data-fs-block="video"] iframe,
        [data-fs-block="video"] object,
        [data-fs-block="video"] embed {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }


        /* Horizontal rules: */
        [data-fs-hr="larger"] {
            border-top-width: 10px;
        }
    </style>

    <?php if (!$block_css_files) : ?>
    <!--
        Accessible font loading. FOUT is a lesser evil than FOIT.
        (https://keithclark.co.uk/articles/loading-css-without-blocking-render/)
    -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet" media="none" onload="if(media!='all')media='all'">

    <?php /*
    <!--
        Print, Edge 12? - 18
        Edge 79+, Chrome 58+, Opera 45+, Safari 10+, iOS 10+, Android Webview/Chrome 58+, Samsung Internet
        FF 47+
    -->
    <link rel="stylesheet" href="<?php echo TplNPEU6Helper::stamp_filename('/templates/npeu6/css/theme-' . $page_brand->alias . '.min.css'); ?>" media="
        only print, screen and (min-width: 1vm),
        only all and (color-gamut: srgb), only all and (color-gamut: p3), only all and (color-gamut: rec2020),
        only all and (min--moz-device-pixel-ratio:0) and (display-mode:browser), (min--moz-device-pixel-ratio:0) and (display-mode:fullscreen)
    ">*/?>

    <!--
        Print (Edge doesn't apply to print otherwise)
        Edge 79+, Chrome 74+, Firefox 63+, Opera 64+, Safari 10.1+, iOS 10.3+, Android 81+
    -->
    <link rel="stylesheet" href="<?php echo TplNPEU6Helper::stamp_filename('/templates/npeu6/css/style.min.css'); ?>?sub=1" media="
        only print,
        only all and (prefers-reduced-motion: no-preference), only all and (prefers-reduced-motion: reduce)
    ">
    <!-- Load styles for IE11, UC -->
    <script>
    /*if (
        (!!window.MSInputMethodContext && !!document.documentMode)
     || (navigator.userAgent.indexOf('UCBrowser') > -1)
    ) {
        var link  = document.createElement('link');
        link.rel  = 'stylesheet';
        link.href = '<?php echo TplNPEU6Helper::stamp_filename("/templates/npeu6/css/style.min.css"); ?>';
        document.getElementsByTagName('head')[0].appendChild(link);
    }*/
    </script>
    <!-- Load IE11 fixes -->
    <script>
    /*if (
        (!!window.MSInputMethodContext && !!document.documentMode)
    ) {
        var script  = document.createElement('script');
        script.type  = 'text/javascript';
        script.src = '<?php echo TplNPEU6Helper::stamp_filename("/templates/npeu6/js/ie11.min.js"); ?>';
        document.getElementsByTagName('head')[0].appendChild(script);
    }*/
    </script>

    <?php foreach($page_stylesheets as $stylesheet => $options): ?>
    <!--
        Print, Edge 12? - 18
        Edge 79+, Chrome 58+, Opera 45+, Safari 10+, iOS 10+, Android Webview/Chrome 58+, Samsung Internet
        FF 47+
    -->
    <link rel="stylesheet" href="<?php echo TplNPEU6Helper::stamp_filename($stylesheet); ?>" media="
        only print,
        only all and (prefers-reduced-motion: no-preference), only all and (prefers-reduced-motion: reduce)
    ">
    <!-- Load styles for IE11, UC -->
    <script>
    /*if (
        (!!window.MSInputMethodContext && !!document.documentMode)
    ) {
        var link  = document.createElement('link');
        link.rel  = 'stylesheet';
        link.href = '<?php echo TplNPEU6Helper::stamp_filename($stylesheet); ?>';
        document.getElementsByTagName('head')[0].appendChild(link);
    }*/
    </script>
    <?php endforeach; ?>

    <?php if (!empty($doc->joomla_stylesheets)): ?>
    <?php foreach($doc->joomla_stylesheets as $stylesheet => $options): ?>
    <!--
        Print, Edge 12? - 18
        Edge 79+, Chrome 58+, Opera 45+, Safari 10+, iOS 10+, Android Webview/Chrome 58+, Samsung Internet
        FF 47+
    -->
    <link rel="stylesheet" href="<?php echo TplNPEU6Helper::stamp_filename($stylesheet); ?>" media="
        only print,
        only all and (prefers-reduced-motion: no-preference), only all and (prefers-reduced-motion: reduce)
    ">
    <!-- Load styles for IE11, UC -->
    <script>
    /*if (
        (!!window.MSInputMethodContext && !!document.documentMode)
     || (navigator.userAgent.indexOf('UCBrowser') > -1)
    ) {
        var link  = document.createElement('link');
        link.rel  = 'stylesheet';
        link.href = '<?php echo TplNPEU6Helper::stamp_filename($stylesheet); ?>';
        document.getElementsByTagName('head')[0].appendChild(link);
    }*/
    </script>
    <?php endforeach; ?>
    <?php endif; ?>

    <?php endif; ?>

    <!-- Template scripts -->
    <script src="<?php echo TplNPEU6Helper::stamp_filename('/templates/npeu6/js/script.min.js'); ?>"></script>

    <?php if (!empty($doc->include_joomla_scripts) && !empty($doc->joomla_scripts)): ?>
    <!-- CMS scripts -->
    <?php foreach($doc->joomla_scripts as $script => $options): ?>
    <script src="<?php echo $script; ?>"></script>
    <?php endforeach; ?>
    <?php endif; ?>

    <!-- Other scripts -->
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

    <?php if ($env != 'production') : ?>
    <style>

    .env_container {
        position: sticky;
        top: 0;
        z-index: 99999;
        background: #cc6289;
        color: #fff;
        box-shadow: 0 0 2px 2px rgba(0,0,0,0.3);
    }

    .env-testing .env_container,
    .env-sandbox .env_container,
    .env-next .env_container {
        background: #ffc77c;
        color: #222;
    }

    .env_container > div {
        position: relative;
        padding: 1.2rem 0.6rem;
        text-align: center;
    }


    .env_container * {
        margin: 0;
        padding: 0;
        border: 0;
    }


    .env_container button {
        position: absolute;
        right: 1.2rem;
        top: 1rem;
        background-color: rgba(0,0,0,0.1);
        padding: 0 0.6rem;
        color: inherit;
    }

    .env_container button:hover,
    .env_container button:active,
    .env_container button:focus {
        background-color: rgba(0,0,0,0.3);
    }
    </style>

    <?php endif; ?>

    <!--<![endif]-->

    <link rel="apple-touch-icon" sizes="180x180" href="/templates/npeu6/favicon/<?php echo $page_brand_folder; ?>apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/templates/npeu6/favicon/<?php echo $page_brand_folder; ?>favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/templates/npeu6/favicon/<?php echo $page_brand_folder; ?>favicon-16x16.png">
    <link rel="manifest" href="/templates/npeu6/favicon/<?php echo $page_brand_folder; ?>site.webmanifest">
    <link rel="mask-icon" href="/templates/npeu6/favicon/<?php echo $page_brand_folder; ?>safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/templates/npeu6/favicon/<?php echo $page_brand_folder; ?>favicon.ico">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-config" content="/templates/npeu6/favicon/<?php echo $page_brand_folder; ?>browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <?php if ($env == 'production') : ?>
    <!-- Matamo -->
    <script type="text/javascript">
        var user_font_size = window.getComputedStyle(document.documentElement).fontSize;

        var _paq = _paq || [];
        // tracker methods like "setCustomDimension" should be called before "trackPageView"

        _paq.push(['setCustomVariable',
            // Index, the number from 1 to 5 where this custom variable name is stored
            3,
            // Name, the name of the variable, for example: Gender, VisitorType
            "user-font-size",
            // Value, for example: "Male", "Female" or "new", "engaged", "customer"
            user_font_size,
            // Scope of the custom variable, "visit" means the custom variable applies to the current visit
            "visit"
        ]);


        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u="https://<?php echo $_SERVER['SERVER_NAME']; ?>/administrator/components/com_piwik/piwik/";
            _paq.push(['setTrackerUrl', u+'piwik.php']);
            _paq.push(['setSiteId', '1']);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
            g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>
    <?php $piwik_url = '?url=' . base64_encode($_SERVER['REQUEST_URI']) . '&title=' . base64_encode($page_title); ?>

    <!-- End Matamo Code -->
    <?php endif;?>

    <!-- Social Media -->
    <?php if (!empty($x)): ?>
    <?php foreach ($x as $name => $value): ?>

    <meta name="x:<?php echo $name; ?>" content="<?php echo $value; ?>">
    <?php endforeach; ?>
    <?php endif;?>

    <!-- End Social Media -->

    <style>
        :root {

            --t-primary-color: <?php echo $page_brand->primary_colour; ?>;
            --t-primary-color-h: <?php echo $page_brand->primary_colour_hsl['H']; ?>;
            --t-primary-color-s: <?php echo $page_brand->primary_colour_hsl['S']; ?>;
            --t-primary-color-l: <?php echo $page_brand->primary_colour_hsl['L']; ?>;
            --t-primary-color-l-copy: <?php echo $page_brand->primary_colour_hsl['L']; ?>;

            --t-secondary-color: <?php echo $page_brand->secondary_colour; ?>;
            --t-secondary-color-h: <?php echo $page_brand->secondary_colour_hsl['H']; ?>;
            --t-secondary-color-s: <?php echo $page_brand->secondary_colour_hsl['S']; ?>;
            --t-secondary-color-l: <?php echo $page_brand->secondary_colour_hsl['L']; ?>;
            --t-secondary-color-l-copy: <?php echo $page_brand->secondary_colour_hsl['L']; ?>;

            --t-primary-color-l--very-light: <?php echo $page_brand->primary_colour_l['very-light']; ?>;
            --t-primary-color-l--light: <?php echo $page_brand->primary_colour_l['light']; ?>;
            --t-primary-color-l--dark: <?php echo $page_brand->primary_colour_l['dark']; ?>;
            --t-primary-color-l--very-dark: <?php echo $page_brand->primary_colour_l['very-dark']; ?>;
            --t-primary-fore-text-color: var(--t-text-color-inverse);

            --t-secondary-color-l--very-light: <?php echo $page_brand->secondary_colour_l['very-light']; ?>;
            --t-secondary-color-l--light: <?php echo $page_brand->secondary_colour_l['light']; ?>;
            --t-secondary-color-l--dark: <?php echo $page_brand->secondary_colour_l['dark']; ?>;
            --t-secondary-color-l--very-dark: <?php echo $page_brand->secondary_colour_l['very-dark']; ?>;
            --t-secondary-fore-text-color: var(--t-text-color-inverse);

        }
    </style>
</head>
<body  id="top" role="document" class="" data-layout="default"><?php /*<body role="document" class="{{ project_data.theme_class }}" data-layout="{{ page.layout_name }}"> */ ?>

    <?php if ($env == 'production') : ?>
    <!-- Matamo no-js tracking: -->
    <noscript>
        <img src="/templates/npeu6/endpoints/matamo-no-js.php<?php echo $piwik_url; ?>" style="display:none;" alt="" />
    </noscript>
    <!-- Matamo print tracking: -->
    <style>
    @media print {
        html::after {
            content: url("/templates/npeu6/endpoints/matamo-print.php<?php echo $piwik_url; ?>");
        }
    }
    </style>
    <!-- End Matamo Code -->
    <?php endif;?>

    <?php echo $page_svg_icons; ?>
    <div data-hidden="if-css" data-fs-text="center">
        <fieldset role="presentation">
            <p>
                <strong>Notice:</strong> You are viewing a basic version of this page. Are you using a very old browser? If so, <a href="https://browsehappy.com/?locale=en">please consider upgrading</a>
            </p>
        </fieldset>
    </div>

    <?php require_once(__DIR__ . '/' . $inner_structure . '.php'); ?>

    <?php /*

    {% if page.load_highlighter != false %}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.6/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    {% endif %}

    */ ?>

    <?php if (!empty($page_script)): ?>
    <script>
        <?php echo $page_script; ?>
    </script>
    <?php endif; ?>

    <script>
        var need_x = !!document.querySelectorAll('.x-share-button').length > 0;
        if (need_x) {
            window.twttr=function(t,e,r){var n,i=t.getElementsByTagName(e)[0],w=window.twttr||{};return t.getElementById(r)?w:((n=t.createElement(e)).id=r,n.src="https://platform.x.com/widgets.js",i.parentNode.insertBefore(n,i),w._e=[],w.ready=function(t){w._e.push(t)},w)}(document,"script","x-wjs");
        }
    </script>
</body>
</html>