<?php
	include '../connect.php';
	$layvip = mysqli_query($conn, 'SELECT user_id, likes, max_like FROM vip ORDER BY RAND()');
	while($vip = mysqli_fetch_assoc($layvip)){
		$feed = json_decode(load('https://graph.fb.me/'.$vip['user_id'].'/feed?limit=1&fields=id,likes&method=get&access_token='.$tokenx),true);
		//$uid = explode('_', $feed['data'][0]['id'])[0];
		if($feed['data'][0]['likes']['count'] < $vip['max_like']){
			$laytoken = mysqli_query($conn, 'SELECT access_token FROM autolike ORDER BY RAND() LIMIT '.$vip['likes'],MYSQLI_USE_RESULT);
			while($token = mysqli_fetch_assoc($laytoken)){
					load('https://graph.fb.me/'.$feed['data'][0]['id'].'/likes?access_token='.$token['access_token'].'&method=post');
					// if($feed['data'][0]['likes']['count'] == $vip['max_like']) break;
			}
		}
	}
	function load($url){
		$ch =  curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		return curl_exec($ch);
		curl_close($ch);
	}
?>