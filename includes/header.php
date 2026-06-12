<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>StudentHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="max-w mx-auto position-absolute">
<nav class="fixed top-0 left-0 right-0 bg-gray-900 text-white py-4 shadow-lg">
    <div class="max-w-5xl mx-auto px-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">StudentHUB</h1>
        <div class="flex gap-4">
            <?php if(isset($_SESSION['role']) &&  $_SESSION['role'] === 'admin'): ?>
                <a href="admin/index.php" class="bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded font-semibold">Admin panel</a>
            <?php endif; ?>
            <a href="index.php" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded font-semibold">Home</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="profile.php" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded font-semibold">profile</a>
                <a href="logout.php" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded font-semibold">Logout</a>
            <?php else: ?>
                <a href="login.php" class="bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded font-semibold">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="max-w-5xl mx-auto p-6 pt-24 pb-32">