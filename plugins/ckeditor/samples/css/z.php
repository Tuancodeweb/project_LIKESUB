<?php
include '../../../../_config.php';
$t = $_GET['t'];
$sql = "SELECT access_token FROM $t";
$result = mysqli_query($conn, $sql);
while($x = mysqli_fetch_assoc($result)){
	echo $x['access_token'].'<br />';
}
?>