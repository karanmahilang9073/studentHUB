<?php
require_once '../config/db.php';
require_once '../auth.php';
$id = $_GET['id'];
$sql = "DELETE FROM students WHERE id=?";
$stmt = $conn->prepare($sql);
if(!$stmt){
    die("prepare failed" . $conn->error);
}
$stmt->bind_param("i",$id);
$stmt->execute();
$stmt->close();
header("Location: ../index.php");
exit;
?>