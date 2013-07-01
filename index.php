<?php
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
	}
	if (isset($data['app_data'])) {
		$app_data = $data['app_data'];
	}
	
}

?>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/master.css">
	
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	
	<style>
	 body { overflow: hidden; height: 800px }
	</style>
	<script>
		function goTo(a) {
			top.location.href='<?=$app_url?>&app_data=' + a;
		}
	</script>
	
	</head>
	<body>
		<?php
		switch ($app_data) {
			case "splash":
			default:
				?>
				
				splash
				<br />
				<a href='#' onclick='goTo("select_album")'>select_album</a>
				
				<?php
				break;
			case "select_album":
				?>
				<div id="divSelect" class="font">
					select album
					<?php
				
					echo "<br />";
					echo "<table align='center'>";
					
					$arr_res = getURL("me/albums?limit=25&access_token=".$token);
					$albums=$arr_res['data'];
					$paging=$arr_res['paging'];
					$previous=isset($paging['previous'])?$paging['previous']:false;
					$next=isset($paging['next'])?$paging['next']:false;
					
					$i=0;
					echo "<tr>";
					foreach($albums as $album) {
						$album_id = $album['id'];					
						/*
						$pic=$album['cover_photo'];
						$arr_res = getURL("$pic?access_token=".$_GET['token']);
						$album_thumb=$arr_res['picture'];
						*/
						$arr_res = getURL($album_id."/photos?access_token=".$token);		
						$album_thumb=$arr_res['data'][0]['picture'];
						
						
						echo "<td id='tableCell'>";
						echo "<a onclick='selectPhoto(".$album_id.");' class='link'><img src='$album_thumb' border='0'>";
						echo "<br /><br />";
						echo ShortenText($album['name'],20)."</a><br><br>";	
						echo "</td>";

						if ($i==2){
							echo "</tr>
							<tr>";
							$i=0;
						}else{
							$i++;
						}

					}
					if ($i<2){
					while ($i<=2){
						echo "<td></td>";
						if($i==2){
							echo "</tr>";
						}
						$i++;
					}
					}else{
						echo "<td></td><td></td><td></td>";
					}
					echo "</table>";
					echo "<div id='row' style='clear: both; padding-bottom:20px;'>";
					echo "<br /><span style='font-size:14px'><a class='link' onclick='paging(\"$previous\", \"album\")'>ANTERIOR&nbsp;&nbsp;<a class='link' onclick='paging(\"$next\", \"album\")'>SIGUIENTE</span>";
					echo "</div>";
				
					?>
				</div>
				<?php
				break;
		}
		?>
	</body>
</html>