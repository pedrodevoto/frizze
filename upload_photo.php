<?php
session_start();                 
$xhr = $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'; 
if ($xhr and isset($_SESSION['data']['user_id'])) {
	if ($_FILES["photo"]["error"] == 0 and $_FILES["photo"]["size"]<2097152){
		$extension = substr($_FILES["photo"]["name"], strrpos($_FILES["photo"]["name"], '.') + 1);
		$filename = "upload/" . $_SESSION['data']['user_id'] . time() . "." . $extension;
		if (move_uploaded_file($_FILES["photo"]["tmp_name"], $filename )) {
			echo $filename;
		}
	}
}