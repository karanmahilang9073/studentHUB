<a href="index.php">Home</a> |
<a href="students/create.php">Add Student</a>
<hr>

<?php
require_once 'config/db.php';

if (isset($_GET['search']) && $_GET['search'] != '') {
    $search = $_GET['search'];
    $result = mysqli_query($conn, "SELECT * FROM students WHERE full_name LIKE '%$search%'");
} else {
    $result = mysqli_query($conn, "SELECT * FROM students");
}
?>

<?php require_once 'includes/header.php'; ?>
<h1 class="text-3xl font-bold mb-4">Student Management System</h1>


<a href="students/create.php">Add Student</a>
<br><br>

<form method="GET">
    <input
    type="text"
    name="search"
    placeholder="Search by name"
    value="<?= $_GET['search'] ?? '' ?>"
    class="border p-2 rounded"
>
    <button class="bg-blue-500 text-white px-4 py-2 rounded">
    Search
</button>
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