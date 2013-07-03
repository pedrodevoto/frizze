<?php
include("auth.php");
$showpic = false;
if (isset($_SESSION['data']['app_data']) and substr($_SESSION['data']['app_data'], 0, 4) == "view") {
	$showpic = true;
	$pic = 'pics/'.urldecode(substr($_SESSION['data']['app_data'], 4)).'.png';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FRIZZÉ - Escaripelas</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="jquery/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js"></script>
<script>
<?php
if ($showpic) {
?>
$(document).ready(function() {
	$("#divRecuadro").css({"background-image": "url('<?=$pic?>')", "background-repeat": "no-repeat", "background-position": "center"});
})
<?php
}
?>
</script>
</head>

<body>
	<div id="divGeneral">
	<?php
	if ($showpic) {
	?>
	    	<div><img src="img/header.png" /></div>
    	<div id="divTituloS1">
	    	<!--<img src="img/comparti.png" />-->
        </div>
		<div id="divRecuadro">
            <!--<div style="float:left; padding:2px;"><img src="img/s3.png" /></div>-->
        </div>
    	<div id="divTxtBottom">
	    	<a href="step1.php">
	    		<img src="img/btn-ingresar.png" border="0" />
            </a>
        </div>
	<?php
	}
	else {
	?>
    	<div><img src="img/frizze.png" /></div>
    	<div id="divLogoInicio">
		<img src="img/logo-inicio.png" />
		</div>
    	<div id="divBtnIngresar">
        	<a href="step1.php">
	    		<img src="img/btn-ingresar.png" border="0" />
            </a>
        </div>
	<?php 
	}
	?>

    </div>
</body>
</html>