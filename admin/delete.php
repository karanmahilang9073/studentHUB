<?php
require_once '../config/db.php';
require_once '../admin_only.php';

$id = $_GET['id'];

$sql = "DELETE FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if($stmt->execute()){
    header("Location: users.php");
    exit;
}

$stmt->close();
?>