<?php
//init Joomla Framework
define('_JEXEC', 1);
require_once '_auth.php';
// Note: $app and $user vars created.
// Allowed - continue:

require dirname(__DIR__) . '/_build/vendor/autoload.php';

use Leafo\ScssPhp\Compiler;
use Leafo\ScssPhp\Server;

$directory1 = '../_build/_styles';
$directory2 = '../css';
$format1    = 'Expanded';
$format2    = 'Compressed';

$output_file = $directory1 . '/style.css';
// Capture the last mod time of the CSS file for comparison later:
if (file_exists($output_file)) {
    $output_file_mod = filemtime($output_file);
}

#Server::serveFrom($directory1);

$compiler = new Compiler();
$compiler->setImportPaths($directory1);


$compiler->setFormatter('Leafo\ScssPhp\Formatter\\' . $format1);

$server1 = new Server($directory1, null, $compiler);
$server1->compileFile($directory1 . '/style.scss', $directory1 . '/style.css');


$compiler->setFormatter('Leafo\ScssPhp\Formatter\\' . $format2);

$server2 = new Server($directory1, null, $compiler);
$server2->compileFile($directory1 . '/style.scss', $directory2 . '/style.min.css');

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