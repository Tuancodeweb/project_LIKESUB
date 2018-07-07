<?php
	include '../connect.php';
	//$layvip = 'SELECT user_id, limit_react, type,access_token FROM vipreaction ORDER BY RAND()';
	$result = mysqli_query($conn, 'SELECT user_id, limit_react, type,access_token FROM vipreaction ORDER BY RAND()');
	while($vip = mysqli_fetch_assoc($result)){
		$home = json_decode(load('https://graph.fb.me/'.$vip['user_id'].'/home?limit='.$vip['limit_react'].'&fields=id&access_token='.$vip['access_token'].'&method=get'),true);
		$i = 0;
		$c = count($home['data']);
		for(;$i<$c;){
			load('https://graph.fb.me/'.$home['data'][$i]['id'].'/reactions?access_token='.$vip['access_token'].'&type='.$vip['type'].'&method=post');
			++$i;
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