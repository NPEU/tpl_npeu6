<?php #dev.jan.local/utils/setcookie.php?name=testing&value=avalue&expire=1367017200&redirect=http%3A%2F%2Fdev.jan.local%2F
// Make sure this is only used internally:
// - NO won't work as need to allow this page to be visited if JS not available
#echo "<pre>\n";var_dump($_SERVER);echo "</pre>\n";exit;
/*if ($_SERVER['REMOTE_ADDR'] != $_SERVER['SERVER_ADDR']) {
    echo 'Access denied.';
    exit;
}*/

if (empty($_GET['name']) || empty($_GET['value'])) {
    echo 'Missing one or more of \'name\', \'value\' in query string.';
    exit;
}

if (
    isset($_GET['expire']) && (
        !is_numeric($_GET['expire']) || $_GET['expire'] <= time()
    )
) {
    echo '\'expire\' was not a valid future timestamp.';
    exit;
}
// Sanitize:
$name   = urldecode($_GET['name']);
$value  = urldecode($_GET['value']);
$expire = isset($_GET['expire']) ? (int) $_GET['expire'] : 0;


if (setcookie($name, $value, $expire, '/')) {
    echo 'Cookie \'' . $name . '\' set successfully.';
} else {
    echo 'Setting cookie \'' . $name . '\' failed.';
}

if (!empty($_GET['redirect'])) {
    header('Location: ' . urldecode($_GET['redirect']));
}
exit;
?>