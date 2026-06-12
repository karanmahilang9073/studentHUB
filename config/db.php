<?php
require_once 'config.php';
$conn = mysqli_connect(
    DB_HOST,
    DB_USER,
    DB_PASS,
    DB_NAME,
);
if(!$conn){
    die('connection failed:'. mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");
?>