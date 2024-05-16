<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

$doc = Factory::getDocument();

$doc->addStyleSheet('/templates/npeu6/css/slimselect.min.css');
$doc->addScript('/templates/npeu6/js/slimselect.min.js');

##$doc->addScript('/templates/npeu6/js/tmp/slimselect-core.js');
###$doc->addScript('/templates/npeu6/js/tmp/slimselect.js');


/*
$script = array();

$script[] = "";
$script[] = "";

$script[] = "function ready(fn) {";
$script[] = "    if (document.readyState != 'loading'){";
$script[] = "        fn();";
$script[] = "    } else {";
$script[] = "        document.addEventListener('DOMContentLoaded', fn);";
$script[] = "    }";
$script[] = "}";

$script[] = "";
$script[] = "";

$script[] = "ready(function(){";
$script[] = "   document.querySelectorAll('select').forEach(function(i){";
$script[] = "      console.log(i.length)";
$script[] = "      new SlimSelect({";
$script[] = "         select: i";
$script[] = "      });";
$script[] = "   });";
$script[] = "});";

$script[] = "";
$script[] = "";

$str = implode("\n", $script);
$doc->addScriptDeclaration($str);
*/
?>