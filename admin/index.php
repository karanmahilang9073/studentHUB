<?php
require_once '../admin_only.php';
include '../config/db.php';

$students = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM students"));
$users = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));

?>

<?php require_once '../includes/header.php' ?>

<h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
    <div class="bg-blue-500 text-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold">Total students</h3>
        <p class="text-3xl font-bold mt-2"><?php echo $students;?></p>
    </div>
    <div class="bg-green-500 text-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold">Total users</h3>
        <p class="text-3xl font-bold mt-2"><?php echo $users;?></p>
    </div>
</div>

