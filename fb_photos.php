<?php
session_start();
$token = $_SESSION['data']['oauth_token'];
$paging = !empty($_GET['paging'])?urldecode($_GET['paging']):"";
if (!isset($_GET['id'])) {
	die();
}
include('functions.php');
//ini_set('display_errors',true);
echo "<a href='#' onclick='loadAlbums()'>Volver a álbumes</a>";
echo "<br />";

echo "<table align='center' style='width:440px;margin:auto;'>";
$album_id = $_GET['id'];
$arr_res=getURL("$album_id/photos?limit=15&access_token=".$token."&&".$paging);
$pictures=$arr_res['data'];
$paging=$arr_res['paging'];
$previous=isset($paging['previous'])?$paging['cursors']['before']:false;
$next=isset($paging['next'])?$paging['cursors']['after']:false;

$i=0;
echo "<tr>";
foreach($pictures as $picture) {
		$pic_thumb=$picture['picture'];
		$pic_link=$picture['source'];

		echo "<td style='margin:2px;text-align:center;background-color:#f0f0f0;padding: 4px 20px 4px 4px;color:#FFFFFF;height:144px;font-size:11px;'>";           
		echo "<a style='text-decoration:none' onclick='selectPhoto(\"".urlencode($pic_link)."\", true)' href='#'>";
		echo "<img src='$pic_thumb' border='0'>";
		echo "</a>";
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
echo "<div id='row' style='clear: both'>";
echo "<br /><span style='font-size:14px'>";

echo "<a style='cursor:pointer' " . ($previous?"onclick='viewAlbum(\"$album_id\", \"before=$previous\")'":"")."><img src='img/anterior.png' border='0' /></a>";
echo "&nbsp;&nbsp;";
echo "<a style='cursor:pointer' " . ($next?"onclick='viewAlbum(\"$album_id\", \"after=$next\")'":"")."><img src='img/siguiente.png' border='0' /></a>";

echo "</span>";
echo "</div>";
?>