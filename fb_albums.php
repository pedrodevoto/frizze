<?php
session_start();
$token = $_SESSION['token'];
include('functions.php');
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
	// echo "<a onclick='selectPhoto(".$album_id.");' class='link'><img src='$album_thumb' border='0'>";
	echo "<a onclick='viewAlbum(".$album_id.");' href='#'><img src='$album_thumb' border='0'>";
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
echo "<br /><span style='font-size:14px'>";

echo "<a class='link' " . ($previous?"onclick='paging(\"$previous\", \"album\")'":"").">ANTERIOR</a>";
echo "&nbsp;&nbsp;";
echo "<a class='link' " . ($next?"onclick='paging(\"$next\", \"album\")'":"").">SIGUIENTE</a>";

echo "</span>";
echo "</div>";

?>