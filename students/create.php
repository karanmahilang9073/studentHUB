<?php require_once '../admin_only.php' ; ?>
<?php require_once '../includes/header.php'; ?>
<h2 class="text-2xl font-bold mb-4">Add Student</h2>

<?php
require_once '../config/db.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];
    $sql = "INSERT INTO students(full_name, email, phone, course) VALUES(?,?,?,?)";
    $stmt = $conn->prepare($sql);
    if(!$stmt){
        die('prepare failed:' . $conn->error);
    }
    $stmt->bind_param("ssss", $full_name, $email, $phone, $course);
    if ($stmt->execute()) {
        echo "<p class='text-green-600 mb-4'>student added successfully</p>";
    }else {
        echo "<p class='text-red-600 mb-4'>Error". $stmt->error . "</p>";
    }
    $stmt->close();
}
?>

<form method="POST" class="bg-white p-8 rounded-lg shadow-md">
    <div class="mb-5">
        <label class="block text-gray-700 font-semibold mb-2">Full name</label>
        <input type="text" name="full_name" class="w-full py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required placeholder="enter full name">
    </div>
    <div class="mb-5">
        <label class="block text-gray-700 font-semibold mb-2">Email</label>
        <input type="email" name="email" class="w-full py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="enter email" required>
    </div>
    <div class="mb-5">
        <label class="block text-gray-700 font-semibold mb-2">Phone</label>
        <input type="text" name="phone" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Enter phone number">
    </div>
    <div class="mb-6">
        <label class="block text-gray-700 font-semibold mb-2">Course</label>
        <input type="text" name="course" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" placeholder="Enter course" required>
    </div>
    
    <div class="flex gap-3">
        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-2 rounded-lg">Add Student</button>
        <a href="../index.php" class="bg-gray-500 hover:bg-gray-600 text-white font-bold px-6 py-2 rounded-lg">Cancel</a>
    </div>
</form>


<?php require_once '../includes/footer.php'; ?>
