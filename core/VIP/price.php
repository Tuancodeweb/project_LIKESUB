<?php
if(isset($_POST['han'], $_POST['goi'])){
    $price = $_POST['han'] * $_POST['goi'];
    echo number_format($price).' VNĐ';
}
?>