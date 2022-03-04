<!doctype html>
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
    <style>
        /*
            Tiny Fall-Back Styles (https://github.com/Fall-Back/Patterns/edit/master/Page/README.md)

            The following styles provide a better visual experience in cases where linked
            stylesheets aren't loaded for any reason. It's recommended that any styles that won't
            be used by the elements on the page be removed to make this as lean as possible, and
            the run through a minifier (e.g. https://cssminifier.com) to compress it as much a
            possible, since this is sent on each request and not cached.
            Note there's a section that uses attributes to apply styles to specific element. This
            is so as not to pollute the class space and help authors make distinctions.
            There's a much long essay on this brewing and I'll add the link when it's done.
        */
        body{font:1em/1.2 sans-serif;padding:1em;margin:0 auto;max-width:50em}details,dialog,main,summary{display:block}@supports (list-style-type:disclosure-closed){summary{display:list-item}}mark{background:#ff0;color:# 000}[hidden],template{display:none}fieldset{border:1px solid;border-color:#777;margin:1em 0;padding:1em}image,img,svg{max-width:100%;-ms-interpolation-mode:bicubic;vertical-align:middle;height:auto;border:0}figure{max-width:100%;overflow-x:auto}_:-o-prefocus,:root figure{max-width:initial;overflow-x:visible}hr{border-style:solid;border-width:0 0 1px 0;margin:1em 0;color:#777}pre{width:100%;overflow-x:scroll;overflow-y:auto}video{max-width:100%;height:auto}button,input,label,select,textarea{vertical-align:middle;vertical-align:middle;min-height:2.2em;margin:.2em 0}button,input[type=checkbox],input[type=radio],label,select,textarea{cursor:pointer}button,input,textarea{padding:0 .5em;line-height:1.5}table{width:100%;border:1px solid #777;border-collapse:collapse}table[role=presentation]{border:0;table-layout:fixed}table[role=presentation] td{border:0}th{background:#eee}caption,td,th{padding:.5em}

        /* For YouTube via http://embedresponsively.com. May or may not be needed. */
        .embed-container{position:relative;padding-bottom:56.25%;height:0;overflow:hidden;max-width:100%;} .embed-container iframe, .embed-container object, .embed-container embed{position:absolute;top:0;left:0;width:100%;height:100%;}
    
    
        /* IE needs SVG icons to NOT be auto height: */
        svg[height="1.25em"] {height: 1.25em;}
    </style>

    <!-- From here we're cutting off IE9- to stop all kinds of JS and CSS fails. -->
    <!--[if !IE]><!-->

    <style>
        /* Tiny Fall-Back Styles continued ... */
        [data-fs-text~=right]{text-align:right}[data-fs-text~=center]{text-align:center}[data-fs-text~=larger]{font-size:larger}[data-fs-text~=nowrap]{white-space:nowrap}[data-fs-block~=background]{background:#eee}[data-fs-block~=border]{border:1px solid;margin:1em 0;padding:1em}[data-fs-block~=padding]{padding:1em}[data-fs-block~=table]{display:table;width:100%;table-layout:fixed}[data-fs-block~=table]>*{display:table-cell;padding:.5em}[data-fs-block~=flex]{display:-webkit-box;display:-webkit-flex;display:-moz-box;display:-ms-flexbox;display:flex;-webkit-flex-wrap:wrap;-ms-flex-wrap:wrap;flex-wrap:wrap}[data-fs-block~=flex]>*{-webkit-box-flex:1;-webkit-flex:1 0 auto;-moz-box-flex:1;-ms-flex:1 0 auto;flex:1 0 auto}[data-fs-block=video]{position:relative;padding-bottom:56.25%;height:0;overflow:hidden;max-width:100%}[data-fs-block=video] embed,[data-fs-block=video] iframe,[data-fs-block=video] object{position:absolute;top:0;left:0;width:100%;height:100%}[data-fs-hr=larger]{border-top-width:10px}


        /* Some fallback decoration: */

        html {
            background-color: hsl(var(--t-primary-color-h), var(--t-primary-color-s), var(--t-primary-color-l--very-dark));
        }

        body {
            background-color: #ffffff;
        }
    </style>

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
    <link rel="stylesheet" href="<?php echo TplNPEU6Helper::stamp_filename('/templates/npeu6/css-v2/style.min.css'); ?>" media="
        only print,
        only all and (prefers-reduced-motion: no-preference), only all and (prefers-reduced-motion: reduce)
    ">
    <!-- Load styles for IE11, UC -->
    <script>
    if (
        (!!window.MSInputMethodContext && !!document.documentMode)
     || (navigator.userAgent.indexOf('UCBrowser') > -1)
    ) {
        var link  = document.createElement('link');
        link.rel  = 'stylesheet';
        link.href = '<?php echo TplNPEU6Helper::stamp_filename("/templates/npeu6/css-v2/style.min.css"); ?>';
        document.getElementsByTagName('head')[0].appendChild(link);
    }
    </script>
    <!-- Load IE11 fixes -->
    <script>
    if (
        (!!window.MSInputMethodContext && !!document.documentMode)
    ) {
        var script  = document.createElement('script');
        script.type  = 'text/javascript';
        script.src = '<?php echo TplNPEU6Helper::stamp_filename("/templates/npeu6/js-v2/ie11.min.js"); ?>';
        document.getElementsByTagName('head')[0].appendChild(script);
    }
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
    if (
        (!!window.MSInputMethodContext && !!document.documentMode)
     || (navigator.userAgent.indexOf('UCBrowser') > -1)
    ) {
        var link  = document.createElement('link');
        link.rel  = 'stylesheet';
        link.href = '<?php echo TplNPEU6Helper::stamp_filename($stylesheet); ?>';
        document.getElementsByTagName('head')[0].appendChild(link);
    }
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
    if (
        (!!window.MSInputMethodContext && !!document.documentMode)
     || (navigator.userAgent.indexOf('UCBrowser') > -1)
    ) {
        var link  = document.createElement('link');
        link.rel  = 'stylesheet';
        link.href = '<?php echo TplNPEU6Helper::stamp_filename($stylesheet); ?>';
        document.getElementsByTagName('head')[0].appendChild(link);
    }
    </script>
    <?php endforeach; ?>
    <?php endif; ?>

    <!-- Template scripts -->
    <script src="<?php echo TplNPEU6Helper::stamp_filename('/templates/npeu6/js-v2/script.min.js'); ?>"></script>

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

    <?php if ($env == 'testing' || $env == 'development') : ?>
    <style>

     .env_container {
         position: sticky;
         top: 0;
         z-index: 9999;
         background: #cc6289;
         color: #fff;
         box-shadow: 0 0 2px 2px rgba(0,0,0,0.3);
     }

     .env-testing .env_container,
     .env-sandbox .env_container {
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

    <!-- Social Media -->
    <?php if (!empty($twitter)): ?>
    <?php foreach ($twitter as $name => $value): ?>

    <meta name="twitter:<?php echo $name; ?>" content="<?php echo $value; ?>">
    <?php endforeach; ?>
    <?php endif;?>

    <!-- End Social Media -->
</head>
<body  id="top" role="document" class="" data-layout="default"><?php /*<body role="document" class="{{ project_data.theme_class }}" data-layout="{{ page.layout_name }}"> */ ?>

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
    <?php echo $page_svg_icons; ?>
    <div data-hidden="if-css" data-fs-text="center">
        <fieldset role="presentation">
            <p>
                <strong>Notice:</strong> You are viewing an unstyled version of this page. Are you using a very old browser? If so, <a href="https://browsehappy.com/?locale=en">please consider upgrading</a>
            </p>
        </fieldset>
    </div>

    <?php require_once(__DIR__ . '/' . $inner_structure . '.v2.php'); ?>

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
        var need_twitter = !!document.querySelectorAll('.twitter-share-button').length > 0;
        if (need_twitter) {
            window.twttr=function(t,e,r){var n,i=t.getElementsByTagName(e)[0],w=window.twttr||{};return t.getElementById(r)?w:((n=t.createElement(e)).id=r,n.src="https://platform.twitter.com/widgets.js",i.parentNode.insertBefore(n,i),w._e=[],w.ready=function(t){w._e.push(t)},w)}(document,"script","twitter-wjs");
        }
    </script>
</body>
</html>