<?php
load('http://likesub.gq/DOAN/core/Cron/Like/Like1.php');
load('http://likesub.gq/DOAN/core/Cron/Like/Like2.php');
function load($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
	return curl_exec($ch);
	curl_close($ch);
}
?>