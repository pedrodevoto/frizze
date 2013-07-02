<?php
session_start();
include('functions.php');

// APP VARIABLES
$app_url = "http://www.facebook.com/okdevtest?v=app_482185265209828";
// $app_url = "http://www.facebook.com/OKDeveloperTest/app_461268303962969";
$app_id = "482185265209828";
// $app_id = "461268303962969";
$canvas_page = "http://localhost/frizze/?authenticated";
// $canvas_page = "http://www.poncebuenosaires.com/hosting/frizze/escaripelas/?authenticated";

$auth_url = "https://www.facebook.com/dialog/oauth?client_id=" . $app_id . "&redirect_uri=" . urlencode($canvas_page);
$auth_url .= "&scope=user_photos,friends_photos,publish_stream";

if (isset($_GET['authenticated'])) {
	session_destroy();
	echo("<script> top.location.href='" . $app_url . "'</script>");
}
	
if (isset($_REQUEST['signed_request'])) {
	$signed_request = $_REQUEST['signed_request'];
	list($encoded_sig, $payload) = explode('.', $signed_request, 2); 
	$data = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);
	$_SESSION = array();
	$_SESSION['data'] = $data;
	
}
if (empty($_SESSION['data']['user_id'])) {
	echo("<script> top.location.href='" . $auth_url . "'</script>");
} 
?>