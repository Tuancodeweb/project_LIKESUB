<?php 
// thực hiện quá trình kết nối vs CSDL
$abs=mysqli_connect('localhost','u880927531_data1','0973542136','u880927531_data1');
// kiểm tra xem quá trình diễn ra chưa
if(!$abs)
{
	echo "bạn đẫ kết nối thất bại";
}
else
{
	mysqli_set_charset($abs,'utf8');
}
?>
