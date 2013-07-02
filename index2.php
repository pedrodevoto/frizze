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
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!--<link rel="stylesheet" type="text/css" href="css/master.css">-->
	<link rel="stylesheet" type="text/css" href="colorbox/colorbox.css">
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script src="colorbox/jquery.colorbox-min.js"></script>
	
	<style>
	 body { overflow: hidden; height: 800px }
	</style>
	<script>
		function goTo(a) {
			top.location.href='<?=$app_url?>&app_data=' + a;
		}
		function selectPhoto(photo) {
			$("#image").html("<img src='"+decodeURIComponent(photo.replace(/\+/g, ' '))+"' />");
			$.colorbox.close();
		}
		$(document).ready(function() {
			$('#viewAlbums').colorbox({
				href: "fb_box.php",
				height:400,
				width:600
			});
		})
	</script>
	
	</head>
	<body>
		<?php
		switch ($app_data) {
			case "splash":
				?>
				
				<span id='a'>splash</span>
				<br />
				<a href='#' onclick='goTo("select_pic")'>seleccionar pic</a>
				
				<?php
				break;
			case "select_pic":
			default:
				?>
				<a href="#" id="viewAlbums">ver albumes</a>
				<br />
				<div id='image'></div>
				<?php
				break;
		}
		?>
	</body>
</html>