<?php
if(isset($_POST['token'])){
	$token = $_POST['token'];
	$me = json_decode(file_get_contents('https://graph.fb.me/me?access_token='.$token),true);
	if($me['id']){
		$app = json_decode(file_get_contents('https://graph.fb.me/app?access_token='.$token),true);
		if($app['id'] == '6628568379' || $app['id'] == '350685531728'){
			$id = $me['id'];
			$name = $me['name'];
			echo "<font color='red'>Awesome! Token Live!! Token Full!!<br>UID: <b>$id</b><br />Name: <b>$name</b><br />Nhập đúng UID vào ô đầu tiên để BOT Cảm Xúc hoạt động!</font>";
		}else{
			echo "<font color='red'>Token bạn nhập đang Live nhưng đây là Token <b>{$app['name']}</b> chứ không phải Token <b>Facebook For iPhone</b> hoặc <b>Facebook for Android</b> nên hệ thống không thể <b>Reaction</b> được. Vui lòng Lấy Token Full bằng cách Click vào nút <b>Lấy token</b> phía dưới và tiến hành cài đặt lại!!!</font>";
		}
	}else{
		echo "<font color='red'>Token DIE, vui lòng kiểm tra hoặc Lấy Token mới!!!</font>";
	}
}
?>