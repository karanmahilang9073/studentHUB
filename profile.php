<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

require_once 'includes/header.php';
require_once 'config/db.php';

$user_id = $_SESSION['user_id'];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $sql = "UPDATE users SET email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $email, $user_id);
    if ($stmt->execute()) {
        echo '<p class="bg-green-100 text-green-700 p-3 rounded mb-4">profile updated</p>';
    }
    $stmt->close();
}

$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>

<div class="max-w-md mx-auto mt-8 bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">My Profile</h2>
    <form method="POST">
        <p class="mb-4"><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email'])?>" class="w-full p-2 border border-gray-300 rounded mb-4" required>
        <button type="submit" class="w-full bg-blue-500 text-white p-2 hover:bg-blue-600">Update Email</button>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>