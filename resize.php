<?php
require_once("auth.php");

$xhr = (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') || isset($_GET['webcam']); 
if (isset($_GET['pic'])) {
	$pic = urldecode($_GET['pic']);
}
if (!isset($pic)) {
	echo "no pic";
	exit;
}
$extension = strtolower(strrchr($pic, '.'));

// $filename = 'upload_tmp' . strrchr($pic, '/');
// if (!file_exists($filename)) {
	// $filename = 'upload_tmp/' . $_SESSION['data']['user_id'] . time() . $extension;
	// copy($pic, $filename);
	// $pic = $filename;
// }
$filename = $pic;
$extension = strtolower(strrchr($pic, '.'));

switch($extension)
{
	case '.jpg':
	case '.jpeg':
		$img = @imagecreatefromjpeg($filename);
		break;
	case '.gif':
		$img = @imagecreatefromgif($filename);
		break;
	case '.png':
		$img = @imagecreatefrompng($filename);
		break;
	default:
		$img = false;
		break;
}
if (!$img) {
	echo ("no img");
	exit;
}
$width = imagesx($img);
$height = imagesy($img);

$new_width = min($width, 780);
$new_height = $new_width * $height / $width;

$new_height = min($height, 433);
$new_width = $new_height * $width / $height;

$resized_image = imagecreatetruecolor($new_width, $new_height);

imagecopyresampled($resized_image, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
$filename = "upload/" . $_SESSION['data']['user_id'] . mt_rand(100, 999) . ".png";
if (imagepng($resized_image, $filename, 0)) {
	if ($xhr) {
		echo '{"filename":"'.$filename.'","width":'.$new_width.', "height":'.$new_height.'}';
	}
	else {
		Header("Location: step1.php?pic=".urlencode($filename)."&width=".$width."&height=".$height);
	}
}
else {
	echo "could not save";
}
?>