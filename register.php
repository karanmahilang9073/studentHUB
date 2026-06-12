<?php require_once 'includes/header.php'; ?>

<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Register</h2>
    <?php require_once 'config/db.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = $_POST['email'];
        $role = 'student';
        
        $sql = "INSERT INTO users(username, password, email, role) VALUES(?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $password, $email, $role);
        
        if($stmt->execute()){
            echo '<p class="bg-green-100 text-green-700 p-3 rounded mb-4">registered successfullly!</p>';
            header("Location: index.php");
        }else {
            echo '<p class="bg-red-100 text-red-700 p-3 rounded mb-4">Error: ' . $stmt->error.'</p>';
        }
    }
    ?>

    <form method="POST" class="space-y-4">
        <input type="text" name="username" placeholder="username" class="w-full p-2 border border-gray-300 rounded" required>
        <input type="email" name="email" placeholder="email" class="w-full p-2 border border-gray-300 rounded" required>
        <input type="password" name="password" placeholder="password" class="w-full p-2 border border-gray-300 rounded" required>
        <button type="submit" class="w-full bg-green-500 text-white p-2 rounded hover:bg-green-600">Register</button>
    </form>
    <p class="mt-4">Already have account? <a href="login.php" class="text-blue-500">Login</a></p>
</div>

<?php require_once 'includes/footer.php' ?>