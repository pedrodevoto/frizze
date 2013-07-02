<?php
session_start();
$token = $_SESSION['data']['oauth_token'];
include('functions.php');
echo "<table align='center' style='width:440px;margin:auto;'>";

$arr_res = getURL("me/albums?limit=9&access_token=".$token);
$albums=$arr_res['data'];
$paging=$arr_res['paging'];
$previous=isset($paging['previous'])?$paging['previous']:false;
$next=isset($paging['next'])?$paging['next']:false;

$i=0;
echo "<tr>";
foreach($albums as $album) {
	$album_id = $album['id'];					

	$arr_res = getURL($album_id."/photos?access_token=".$token);		
	$album_thumb=$arr_res['data'][0]['picture'];
	
	
	echo "<td style='margin:2px;text-align:center;background-color:#f0f0f0;padding: 4px 20px 4px 4px;color:#FFFFFF;height:144px;font-size:11px;'>";
	echo "<a style='text-decoration:none' onclick='viewAlbum(".$album_id.");' href='#'>";
	echo "<img src='$album_thumb' border='0'>";
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

echo "<a style='cursor:pointer' " . ($previous?"onclick='paging(\"$previous\", \"album\")'":"")."><img src='img/anterior.png' border='0' /></a>";
echo "&nbsp;&nbsp;";
echo "<a style='cursor:pointer' " . ($next?"onclick='paging(\"$next\", \"album\")'":"")."><img src='img/siguiente.png' border='0' /></a>";

echo "</span>";
echo "</div>";

?>