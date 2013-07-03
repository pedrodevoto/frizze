<?php
include("auth.php");
if (isset($_GET['pic'])) {
	$file = urldecode($_GET['pic']);
	$args = array(
		'message' => 'Frizzé Escaripelas'
	);
	$args[basename($file)] = '@' . realpath($file);
	postURL($_SESSION['data']['user_id'] . '/photos?access_token=' . $_SESSION['data']['oauth_token'], $args);
	
}