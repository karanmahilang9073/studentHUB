        <?php
        require_once '../config/db.php';
        require_once '../admin_only.php' ;
        require_once '../includes/header.php';

        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $student = $result->fetch_assoc();
        $stmt->close();

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $sql = "UPDATE users SET username=?, email=?, role=?  WHERE id = ?";
            $stmt = $conn->prepare($sql);
            if(!$stmt){
                die("prepare failed" . $conn->error);
            }
            $stmt->bind_param("sssi", $username, $email, $role, $id);
            if($stmt->execute()){
                header("Location: users.php");
                exit;
            }
            $stmt->close();
        }
        ?>

        <h2 class="text-2xl font-bold mb-4">Edit user</h2>

        <form method="POST">
            <div class="mb-4">
                <input type="text" name="username" value="<?= htmlspecialchars($student['username']) ?>" class="border p-2 rounded w-full" required>
            </div>
            <div class="mb-4">
                <input type="email" name="email" value="<?= htmlspecialchars($student['email']) ?>" class="border p-2 rounded w-full" required>
            </div>
            <div class="mb-4">
                <select name="role" class="border p-2 rounded w-full">
                    <option value="admin" <?= $student['role']== 'admin' ? 'selected' : ''?>>Admin</option>
                    <option value="student" <?= $student['role']== 'student' ? 'selected' : ''?>>student</option>
                </select>
            </div>
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Update user</button>
        </form>

        <?php require_once '../includes/footer.php'; ?>