<?php
function getURL($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/$url");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$res = curl_exec($ch);
	$err=0;
	$err=curl_errno($ch);
	curl_close($ch);
	if ($err!=0) {
		return "error ".$err;
	}
	$arr_res = json_decode($res, true);	
	return $arr_res;
}
function postURL($url, $fields) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_VERBOSE, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/$url");
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	$res = curl_exec($ch);
	$err=0;
	$err=curl_errno($ch);
	curl_close($ch);
	if ($err!=0) {
		return "error ".$err;
	}
	$arr_res = json_decode($res, true);
	return $arr_res;
}

function ShortenText($text, $chars) { 
	// Change to the number of characters you want to display 
	if (strlen($text)>$chars) {
		$text = $text." "; 
		$text = substr($text,0,$chars); 
		$text = substr($text,0,strrpos($text,' ')); 			
		$text = $text."..."; 
	}		
	return $text; 
} 
?>