<?php
session_start();
require_once 'config/db.php';

if (isset($_GET['search']) && $_GET['search'] != '') {
    $search = "%" . $_GET['search'] . "%";
    $sql = "SELECT * FROM students WHERE full_name LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = mysqli_query($conn, "SELECT * FROM students");
}
?>

<?php require_once 'includes/header.php'; ?>

<?php if(isset($_SESSION['username'])): ?>
    <p class="mb-4 text-gray-600 text-3xl">Welcome, <strong><?= htmlspecialchars($_SESSION['username'])?></strong></p>
<?php endif;?>

<h1 class="text-3xl font-bold mb-4">Student Management System</h1>


<a href="students/create.php" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded font-semibold">Add Student</a>
<br><br>

<form method="GET">
    <input type="text" name="search" placeholder="Search by name" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" class="p-2 border-2 border-gray-300 rounded bg-white text-black">
    <button class="bg-blue-500 text-white px-4 py-2 rounded">Search</button>
</form>
<br>

<?php
$countResult = mysqli_query($conn, "SELECT COUNT(*) as total FROM students");
$count = mysqli_fetch_assoc($countResult);
?>

<p>Total Students: <?= $count['total'] ?></p>

<table class="w-full border border-gray-300 mt-4">
    <tr>
        <th class="border p-2 bg-gray-100">ID</th>
        <th class="border p-2 bg-gray-100">Name</th>
        <th class="border p-2 bg-gray-100">Email</th>
        <th class="border p-2 bg-gray-100">Phone</th>
        <th class="border p-2 bg-gray-100">Course</th>
        <th class="border p-2 bg-gray-100">Actions</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td class="border p-2"><?= $row['id'] ?></td>
            <td class="border p-2"><?= $row['full_name'] ?></td>
            <td class="border p-2"><?= $row['email'] ?></td>
            <td class="border p-2"><?= $row['phone'] ?></td>
            <td class="border p-2"><?= $row['course'] ?></td>
            <td class="border p-2">
                <a href="students/edit.php?id=<?= $row['id'] ?>">Edit</a>
                <a href="students/delete.php?id=<?= $row['id'] ?>"
                    onclick="return confirm('Are you sure?')">
                    Delete
                </a>
            </td>
        </tr>
    <?php } ?>
</table>


<?php require_once 'includes/footer.php'; ?>