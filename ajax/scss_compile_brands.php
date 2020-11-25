<?php
//init Joomla Framework
define('_JEXEC', 1);
require_once '_auth.php';
// Note: $app and $user vars created.
// Allowed - continue:

exit;

require dirname(__DIR__) . '/_build/vendor/autoload.php';

use ScssPhp\ScssPhp\Compiler;
use ScssPhp\ScssPhp\OutputStyle;
use ScssPhp\Server\Server;


$directory1 = '../_build/_styles';
$directory2 = '../css';

$output_file = $directory1 . '/theme-npeu.css';
// Capture the last mod time of the CSS file for comparison later:
if (file_exists($output_file)) {
    $output_file_mod = filemtime($output_file);
}


$compiler = new Compiler();
$compiler->setImportPaths($directory1);


$compiler->setOutputStyle(OutputStyle::EXPANDED);

$server1 = new Server($directory1, null, $compiler);
$server1->compileFile($directory1 . '/theme-npeu.scss', $directory1 . '/theme-npeu.css');
echo 'JSubMenuHelper error appears here. THe SCSS doesn\'t work either :-('; exit;

$compiler->setOutputStyle(OutputStyle::COMPRESSED);

$server2 = new Server($directory1, null, $compiler);
$server2->compileFile($directory1 . '/theme-npeu.scss', $directory2 . '/theme-npeu.min.css');

// Compare the last mod time of the CSS file to verify it's been updated:
if (file_exists($output_file) && (filemtime($output_file) > $output_file_mod)) {
    $message      = 'Success';
    $message_type = 'success';
    $result       = true;
} else {
    $message      = 'Fail';
    $message_type = 'error';
    $result       = false;
}

#echo '<pre>'; var_dump($messages); echo '</pre>';#
$data = array();
$app->enqueueMessage($message, $message_type);
echo new JResponseJson($data, $message, $result);
$app->close();
exit;