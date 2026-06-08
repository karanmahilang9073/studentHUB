<?php
require_once '../config/db.php';
$id = $_GET['id'];
$sql = "DELETE FROM students WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$id);
$stmt->execute();
$stmt->close();
header("Location: ../index.php");
exit;
?>