<?php
session_start();
if(!isset($_SESSION['user_id'])){
    echo "<script>alert('Login first'); location='../login.php';</script>";
    exit;
}
?>