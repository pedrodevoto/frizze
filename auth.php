<?php
session_start();
include('functions.php');
$app_url = "http://www.facebook.com/okdevtest?v=app_482185265209828";
$app_data = '';
if (isset($_GET['authenticated'])) {
	echo("<script> top.location.href='" . $app_url . "&app_data=splash" . "'</script>");
}
if (isset($_REQUEST['signed_request'])) {
	$app_id = "482185265209828";
	$canvas_page = "http://localhost/frizze/?authenticated";

	$auth_url = "https://www.facebook.com/dialog/oauth?client_id=" . $app_id . "&redirect_uri=" . urlencode($canvas_page);
	$auth_url .= "&scope=user_photos,friends_photos,publish_stream";
	
	$signed_request = $_REQUEST['signed_request'];
	list($encoded_sig, $payload) = explode('.', $signed_request, 2); 
	$data = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);
	
	if (empty($data["user_id"])) {
		echo("<script> top.location.href='" . $auth_url . "'</script>");
	} else {
		$_SESSION['user_id'] = $data['user_id'];
		//echo ("Welcome User: " . $data["user_id"]);
	}
	if (isset($data['oauth_token'])) {
		$token = $data['oauth_token'];
		$_SESSION['token'] = $token;
	}
	if (isset($data['app_data'])) {
		$app_data = $data['app_data'];
	}
	
}

?>