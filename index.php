<?php
include("auth.php");
switch ($app_data) {
	case "splash":
	default:
		include("splash.php");
		break;
	case "step1":
		include("step1.php");
		break;
	case "step2":
		include("step2.php");
		break;
}
?>

