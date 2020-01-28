<?php

if (empty($_GET['url']) || empty($_GET['title'])) {
	trigger_error('Missing one or more of \'url\', \'title\' in query string.', E_USER_WARNING);
	exit;
}

if (!$pg_url = base64_decode($_GET['url'])) {
	trigger_error('Could not decode \'url\' in query string.', E_USER_WARNING);
	exit;
}

if (!$pg_title = base64_decode($_GET['title'])) {
	trigger_error('Could not decode \'title\' in query string.', E_USER_WARNING);
	exit;
}
#echo '<pre>'; var_dump($_SERVER); echo '</pre>'; exit;

$piwik_url = 'https://' . $_SERVER['HTTP_HOST'] . '/administrator/components/com_piwik/piwik/';

require_once '../administrator/components/com_piwik/PiwikTracker.php';

PiwikTracker::$URL = $piwik_url;

$pg_url = 'https://' . $_SERVER['HTTP_HOST'] . $pg_url;

$piwikTracker = new PiwikTracker(1);
$piwikTracker->disableCookieSupport();
$piwikTracker->setUrl($pg_url);
$piwikTracker->setCustomVariable(1, 'no-js', 'true');
$piwikTracker->doTrackPageView($pg_title);

echo 'No-JS page view logged';
exit;
?>