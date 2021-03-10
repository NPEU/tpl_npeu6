<?php

defined('_JEXEC') or die;
$doc = JFactory::getDocument();

$doc->addStyleSheet('/templates/npeu6/css/a11y-dialog.min.css');
$doc->addScript('/templates/npeu6/js/a11y-dialog.min.js');
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