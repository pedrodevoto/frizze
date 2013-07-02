<?php
include("auth.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FRIZZÉ - Escaripelas</title>
<link href="css/style1.css" rel="stylesheet" type="text/css" />
<script src="jquery/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
<script src="js/jquery.form.js"></script>
<script src="colorbox/jquery.colorbox-min.js"></script>
<link rel="stylesheet" type="text/css" href="colorbox/colorbox.css">
<script>
function selectPhoto(photo, enc) {
	$.colorbox.close();
	if (photo) {
		var pic = enc?decodeURIComponent(photo.replace(/\+/g, ' ')):photo;
		$('<img />').prop('src', pic).load(function() {

			var width, height;
			
			width = Math.min(this.width, 780);
			height = width * this.height / this.width;
			
			height = Math.min(height, 433);
			width = height * this.width / this.height;
			
			$("#submit").prop("href", "step2.php?pic=" + encodeURIComponent(this.src) + "&width=" + width + "&height=" + height);
			
			$("#divRecuadro").css("background-size", width + "px " + height + "px");
		});
		$("#divRecuadro").css({"background-image": "url('"+pic+"')", "background-repeat": "no-repeat", "background-position": "center"});
		$("#cameraImage").hide();
	}
	else {
		$("#submit").prop("href", "#");
	}
}
function viewAlbums() {
	$.colorbox({
		href: "fb_box.php",
		height:400,
		width:600
	});
}
function uploadPhoto() {
	$.colorbox({
		inline: true,
		href: "#photoUpload",
		width: 440,
		height: 280
	});	
}
$(document).ready(function() {
	$("#photoUploadForm").ajaxForm({
		complete: function(xhr) {
			$.colorbox.close();
			selectPhoto(xhr.responseText, false);
		}
	});
})
</script>
</head>

<body>
	<div id="divGeneral">
    	<div><img src="img/header.png" /></div>
    	<div id="divTituloS1">
	    	<img src="img/titulo-s1.png" />        
        </div>
		<div id="divRecuadro">
            <div style="float:left; padding:2px;"><img src="img/s1.png" /></div>
            <div style="float:right; padding:0px; margin-top:45px;">
				<!--<a href="#" id="viewAlbums">-->
					<img src="img/menu.png" usemap="#menumap" />
				<!--</a>-->
					<map name="menumap">
						<area shape="rect" coords="0,0,221,35" href="#" onclick="uploadPhoto()" />
						<area shape="rect" coords="0,45,221,75" href="#" onclick="viewAlbums()" />
						<area shape="rect" coords="0,85,221,116" href="#" onclick="alert('webcam')" />
                    </map>
			</div><br />
            <div style="width:100%; text-align:center; margin-top:164px;">
	            <img id="cameraImage" src="img/camara.png" />
            </div>
        </div>
    	<div id="divTxtBottom">
	    	<a href="index.php"><img src="img/anterior.png" border="0" /></a>&nbsp;&nbsp;<a id="submit" href="#"><img src="img/siguiente.png" border="0" /></a>
        </div>
    </div>
	<div style="display:none; background-color:#65d5e9">
		<div id="photoUpload" style="background-color:#65d5e9; padding:5px">
			<form id="photoUploadForm" action="upload_photo.php" method="post" enctype="multipart/form-data">
				<div style="width:100%; text-align:center; margin-bottom:20px; margin-top:5px">
                	<p><img src="img/header-small.png" /></p>
                	<p style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF">Elegí una foto de tu computadora</p>
                </div>
                <div style="width:100%; text-align:center"><input name="photo" id="photoUploadFile" type="file" /></div>
				<div style="width:100%; text-align:center; margin-top:20px; padding-bottom:20px;">
	                <input type="image" src="img/subir.png" alt="Submit Form" onclick="document.photoUploadForm.submit();" />
                </div>
			</form>
		</div>
	</div>
</body>
</html>
