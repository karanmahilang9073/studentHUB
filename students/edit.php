<?php require_once '../includes/header.php'; ?>

<?php
require_once '../config/db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM students WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();
$stmt->close();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];
    $sql = "UPDATE students SET full_name=?, email=?, phone=?, course=? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if(!$stmt){
        die("prepare failed" . $conn->error);
    }
    $stmt->bind_param("ssssi", $full_name, $email, $phone, $course, $id);
    if($stmt->execute()){
        header("Location: ../index.php");
        exit;
    }
    $stmt->close();
}
?>

<h2 class="text-2xl font-bold mb-4">Edit Student</h2>

<form method="POST">
    <div class="mb-4">
        <input type="text" name="full_name" value="<?= htmlspecialchars($student['full_name']) ?>" class="border p-2 rounded w-full" required>
    </div>
    <div class="mb-4">
        <input type="email" name="email" value="<?= htmlspecialchars($student['email']) ?>" class="border p-2 rounded w-full" required>
    </div>
    <div class="mb-4">
        <input type="text" name="phone" value="<?= htmlspecialchars($student['phone']) ?>" class="border p-2 rounded w-full" required>
    </div>
    <div class="mb-4">
        <input type="text" name="course" value="<?= htmlspecialchars($student['course']) ?>" class="border p-2 rounded w-full" required>
    </div>
    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Update Student</button>
</form>

<?php require_once '../includes/footer.php'; ?>