<?php
include("auth.php");
$xhr = (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') || isset($_GET['webcam']); 

$data = json_decode(urldecode($_GET['datos']), true);
$imagen_nombre = "pics/" . $_SESSION['data']['user_id'] . time() . ".png";

$pic=$data[0]['img'];
$dest = imagecreatefrompng($pic);
$dest_data = getimagesize($data[0]['img']);
$ok_dest = imagecreatetruecolor($data[0]['img_w'], $data[0]['img_h']); 
imagecopyresampled($ok_dest, $dest, 0, 0, 0, 0, $data[0]['img_w'], $data[0]['img_h'], $dest_data[0], $dest_data[1]); 

// Create image instances
$length=sizeof($data);

for($i=1; $i<$length; $i++){
	$src = imagecreatefrompng($data[$i]['escarapela']);
	$ok_imagedata = getimagesize($data[$i]['escarapela']);
	$ok_destination_handle = imagecreatetruecolor($data[$i]['width'], $data[$i]['height']); 
	imagefill($ok_destination_handle,0,0,0x7fff0000);
	imagecopyresampled($ok_destination_handle, $src, 0, 0, 0, 0, $data[$i]['width'], $data[$i]['height'], $ok_imagedata[0], $ok_imagedata[1]); 
		
	// Copy and merge
	imagecopy($ok_dest, $ok_destination_handle, ($data[$i]['left']), ($data[$i]['top']), 0, 0, $data[$i]['width'], $data[$i]['height']);
}

$src = imagecreatefrompng($data[0]['escarapela']);
$ok_imagedata = getimagesize($data[0]['escarapela']);
$ok_destination_handle = imagecreatetruecolor($data[0]['width'], $data[0]['height']); 
imagefill($ok_destination_handle,0,0,0x7fff0000);
imagecopyresampled($ok_destination_handle, $src, 0, 0, 0, 0, $data[0]['width'], $data[0]['height'], $ok_imagedata[0], $ok_imagedata[1]); 
	
// Copy and merge
imagecopy($ok_dest, $ok_destination_handle, ($data[0]['left']), ($data[0]['top']), 0, 0, $data[0]['width'], $data[0]['height']);


// Output and free from memory
imagejpeg($ok_dest, $imagen_nombre);

imagedestroy($dest);
imagedestroy($src);

//$img = $_POST['imgBase64'];
//$img = str_replace('data:image/png;base64,', '', $img);
//$img = str_replace(' ', '+', $img);
//$data = base64_decode($img);
//$file = "pics/" . $_SESSION['data']['user_id'] . time() . ".png";
//$success = file_put_contents($file, $data);
if ($xhr) {
	echo $imagen_nombre;
}
else {
	Header("Location: step3.php?pic=".urlencode($imagen_nombre));
}
	
?>