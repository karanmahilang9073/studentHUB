<?php
require_once '../admin_only.php';
require_once '../config/db.php';
require_once '../includes/header.php';

$result = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>

<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">Manage Users</h1>

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-3">ID</th>
                    <th class="border p-3">Name</th>
                    <th class="border p-3">Email</th>
                    <th class="border p-3">Role</th>
                    <th class="border p-3">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php while($user = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td class="border p-3"><?= $user['id']; ?></td>
                    <td class="border p-3"><?= $user['username']; ?></td>
                    <td class="border p-3"><?= $user['email']; ?></td>
                    <td class="border p-3"><?= $user['role']; ?></td>
                    <td class="border p-3">
                        <a href="edit.php?id=<?= $user['id']; ?>"
                           class="bg-yellow-500 text-white px-3 py-1 rounded">
                           Edit
                        </a>

                        <a href="delete.php?id=<?= $user['id']; ?>"
                           class="bg-red-500 text-white px-3 py-1 rounded"
                           onclick="return confirm('Delete this user?')">
                           Delete
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>