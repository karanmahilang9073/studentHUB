<?php
$conn = mysqli_connect(
    "localhost",
    "root",
    "km907316",
    "studenthub"
);
if(!$conn){
    die('connection failed:'. mysqli_connect_error());
}
?>