<?php require_once '../includes/header.php'; ?>

<?php

require_once '../config/db.php';

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM students WHERE id = $id");

$student = mysqli_fetch_assoc($result);
?>

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = $_POST['full_name'];

    mysqli_query(
        $conn,
        "UPDATE students SET full_name='$full_name' WHERE id=$id"
    );

    echo '<p class="bg-green-100 text-green-700 p-3 rounded mb-4">
        Student Updated Successfully!
      </p>';
}
<div class="mb-4">
    <input
        type="text"
        name="full_name"
        value="<?= $student['full_name'] ?>"
        class="border p-2 rounded w-full"
    >
</div>

<button
    type="submit"
    class="bg-yellow-500 text-white px-4 py-2 rounded"
>
    Update Student
</button>

<?php require_once '../includes/footer.php'; ?>