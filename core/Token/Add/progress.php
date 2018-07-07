<?php
include '../_config.php';
if(isset($_GET['id'], $_GET['name'], $_GET['token'])){
	$id = trim($_GET['id']);
	$name = trim($_GET['name']);
	$token = trim($_GET['token']);
	$sql = "INSERT INTO autolike(user_id, name, access_token) VALUES('$id','$name','$token')";
	if(mysqli_query($conn, $sql)){
		echo 'Thành công!!';
	}else{
		echo 'Thành công. Phát hiện token trùng lặp đã có trong data!!';
	}
}else{
	header('Location: index.php');
}
?>