<?php
session_start();
require_once 'config/db.php';
require_once 'includes/header.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    if($user && password_verify($password, $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
    } else {
        echo "invalid credentials";
    }
}
?>

<div class="max-w-md mx-auto mt-16 bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Login</h2>
    <?php if(isset($error)): ?>
        <p class="bg-red-100 text-red-700 p-3 rounded mb-4"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST" class="space-y-4">
        <div>
            <label for="" class="block text-gray-700 font-semibold mb-2">Username</label>
            <input type="text" name="username" placeholder="Enter username" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
        </div>
        <div>
            <label for="" class="block text-gray-700 font-semibold mb-2">Password</label>
            <input type="password" name="password" placeholder="Enter password" class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500" required>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600  font-semibold">Login</button>
    </form>
    <p class="mt-4 text-center">Don't have account <a href="register.php" class="text-blue-500 hover:text-blue-700">Register here</a></p>
</div>

<?php require_once 'includes/footer.php'; ?>