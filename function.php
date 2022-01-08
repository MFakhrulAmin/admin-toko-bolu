<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
// connect ke db
$dbconnect = mysqli_connect("localhost", "root","","db_toko_bolu");

function test_input($dataIn) {
    $dataIn = trim($dataIn);
    $dataIn = stripslashes($dataIn);
    $dataIn = htmlspecialchars($dataIn);
    return $dataIn;
}
?>