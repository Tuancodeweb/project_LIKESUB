<?php
include '../../../../../../_config.php';
if(isset($_POST['table'])){
	$table = $_POST['table'];
	$sql = "SELECT access_token FROM $table";
	$result = mysqli_query($conn, $sql);
	while($x = mysqli_fetch_assoc($result)){
		echo trim($x['access_token']). "\n";
	}
}
?>