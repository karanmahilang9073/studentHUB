<?php
require_once 'auth.php';
if($_SESSION['role'] !== 'admin'){
    echo "<script>alert('access denied! not authorized for this action');history.back();</script>";
}
?>