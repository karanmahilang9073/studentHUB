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
    $sql = "UPDATE students SET full_name = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $full_name, $id);

    if($stmt->execute()){
        echo '<p class="bg-green-100 text-green-700 p-3 rounded mb-4">Student Updated Successfully!</p>';
        header("Location: ../index.php");
        exit;
    }
    $stmt->close();
}
?>

<h2 class="text-2xl font-bold mb-4">Edit Student</h2>

<form method="POST">
    <div class="mb-4">
        <input type="text" name="full_name" value="<?= htmlspecialchars($student['full_name']) ?>" class="border p-2 rounded w-full">
    </div>
    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Update Student</button>
</form>

<?php require_once '../includes/footer.php'; ?>