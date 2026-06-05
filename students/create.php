<?php require_once '../includes/header.php'; ?>
<h2 class="text-2xl font-bold mb-4">Add Student</h2>

<?php
require_once '../config/db.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];
    $sql = "INSERT INTO students(full_name, email, phone, course) VALUES('$full_name', '$email','$phone','$course')";
    if (mysqli_query($conn, $sql)) {
        echo 'student  added successfully';
    }else {
        echo mysqli_error($conn);
    }
}
?>

<form method="POST">
    <div class="mb-4">
        <input type="text" name="full_name" class="border p-2 rounded w-full" placeholder="full name">
    </div>
    <br><br>
    <div class="mb-4">
        <input type="text" name="email" class="border p-2 rounded w-full" placeholder="email">
    </div>
    <br><br>
    <div class="mb-4">
        <input type="text" name="phone" class="border p-2 rounded w-full" placeholder="phone">
    </div>
    <br><br>
    <div class="mb-4">
        <input type="text" name="course" class="border p-2 rounded w-full" placeholder="course">
    </div>
    <br><br>
    <button
    type="submit"
    class="bg-green-500 text-white px-4 py-2 rounded mt-4"
>
    Add Student
</button>
</form>


<?php require_once '../includes/footer.php'; ?>
