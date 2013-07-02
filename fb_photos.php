<?php
session_start();
$token = $_SESSION['token'];
$paging = isset($_GET['paging'])?urldecode($_GET['paging']):"";
if (!isset($_GET['id'])) {
	die();
}
include('functions.php');
//ini_set('display_errors',true);
echo "<a href='#' onclick='viewAlbums()'>Volver a álbumes</a>";
echo "<br />";

echo "<table align='center'>";
$album_id = $_GET['id'];
$arr_res=getURL("$album_id/photos?limit=25&access_token=".$token."&&".$paging);
$pictures=$arr_res['data'];
$paging=$arr_res['paging'];
$previous=isset($paging['previous'])?$paging['previous']:false;
$next=isset($paging['next'])?$paging['next']:false;
$i=0;
echo "<tr>";
foreach($pictures as $picture) {
		$pic_thumb=$picture['picture'];
		$pic_link=$picture['source'];

		echo "<td id='tableCell'>";             
		echo "<a onclick='selectPhoto(\"".urlencode($pic_link)."\", true)' href='#'>";
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

echo "<a class='link' " . ($previous?"onclick='paging(\"$previous\", \"album\")'":"").">ANTERIOR</a>";
echo "&nbsp;&nbsp;";
echo "<a class='link' " . ($next?"onclick='paging(\"$next\", \"album\")'":"").">SIGUIENTE</a>";

echo "</span>";
echo "</div>";
?>