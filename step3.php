<?php
include("auth.php");
$pic = isset($_GET['pic'])?urldecode($_GET['pic']):"";
$basename = basename($pic);
list($filename, $extension) = explode('.', $basename);
$link = urlencode($app_url . "&app_data=view" . $filename);
$picture = urlencode($canvas_page.$pic);
$name = urlencode("FRIZZÉ - Escaripelas");
$caption = urlencode("Ya tengo mi propia escaripela.");
$description = urlencode("Viva la Joda!");
$redirect_uri = urlencode($canvas_page."?thankyou");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FRIZZÉ - Escaripelas</title>
<link href="css/style1.css" rel="stylesheet" type="text/css" />
<script src="jquery/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js"></script>
<script>
$(document).ready(function() {
	$("#divRecuadro").css({"background-image": "url('<?=$pic?>')", "background-repeat": "no-repeat", "background-position": "center"});
})
function share() {
	$.ajax({
		url: "publish_photo.php?pic="+encodeURIComponent('<?=$pic?>')
	}).done(function(data) {
		top.location.href = "https://www.facebook.com/dialog/feed?app_id=<?=$app_id?>&link=<?=$link?>&picture=<?=$picture?>&name=<?=$name?>&caption=<?=$caption?>&description=<?=$description?>&redirect_uri=<?=$redirect_uri?>";
	});
}
</script>
</head>

<body>
	<div id="divGeneral">
    	<div><img src="img/header.png" /></div>
    	<div id="divTituloS1">
	    	<img src="img/comparti.png" />        
        </div>
		<div id="divRecuadro" style="width:100%; height:433px;background-color:#f0f0f0;text-align:center;">
            <div style="float:left; padding:2px;"><img src="img/s3.png" /></div>
        </div>
    	<div id="divTxtBottom">
	    	<a href="step2.php"><img src="img/anterior.png" border="0" /></a>&nbsp;&nbsp;<a href="#" onclick="share()"><img src="img/compartir.png" border="0" /></a>
        </div>
    </div>
</body>
</html>
