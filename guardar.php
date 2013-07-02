<?php
$img = $_POST['imgBase64'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = "pics/image_name.png";
$success = file_put_contents($file, $data);
return $success;
?>