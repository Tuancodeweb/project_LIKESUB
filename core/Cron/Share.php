<?php
	include '../connect.php';
	$table = array('token_share0','token_share1','token_share2','token_share3','token_share4');
	//$layvip = 'SELECT user_id, shares, max_share FROM vipshare ORDER BY RAND()';
	$result = mysqli_query($conn, 'SELECT user_id, shares, max_share FROM vipshare ORDER BY RAND()');
	while($vip = mysqli_fetch_assoc($result)){
		$feed = json_decode(load('https://graph.fb.me/'.$vip['user_id'].'/feed?limit=1&method=get&fields=id,shares&access_token='.$tokenx),true);
		// echo $vip['user_id'].' -  Shares/ Cron: '. $vip['shares']. 'Current: '.$feed['data'][0]['shares']['count'].' - Max: '.$vip['max_share'].'<br />';
		if($feed['data'][0]['shares']['count'] < $vip['max_share']){
			$tb = $table[array_rand($table)];
			$result1 = mysqli_query($conn, "SELECT access_token FROM $tb ORDER BY RAND() LIMIT {$vip['shares']}", MYSQLI_USE_RESULT);
			while($token = mysqli_fetch_assoc($result1)){
				load('https://graph.fb.me/'.$feed['data'][0]['id'].'/sharedposts?access_token='.$token['access_token'].'&method=post');
				//if($feed['data'][0]['shares']['count'] == $vip['max_share']) break;
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