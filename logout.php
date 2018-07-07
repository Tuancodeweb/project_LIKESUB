<?php
ob_start();
session_start();
if(isset($_COOKIE['login'])){
	setcookie('login','',time()-1);
}else if(isset($_SESSION['login'])){
	unset($_SESSION['login']);
}else{
	header('Location: index.php');
}
echo "<script>alert('Đăng xuất thành công');window.location='index.php';</script>";
?>