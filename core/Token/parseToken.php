<?php
	$acc = file('acc.txt');
	$list = array();
	for($i = 0; $i<count($acc);$i++){
		$list[] = explode("|", $acc[$i]);
	}
	for($i = 0; $i<count($list); $i++){
		echo $list[$i][2].'<br />';
	}
?>