<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/functions.php';

require_login();
if (!is_admin()) {
    die("Admins only.");
}

$res = mysqli_query($conn, "SELECT id, first_name, last_name, email, role FROM users ORDER BY id DESC");

include __DIR__ . '/../partials/header.php';
?>

<h1>Users</h1>

<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Action</th>
    </tr>
<?php #mysqli_fetch_assoc = #لجلب صف واحد من نتيجة استعلام SELECT ?>
    <?php while ($u = mysqli_fetch_assoc($res)): ?>
        <tr>
            <td><?php echo $u['id']; ?></td>
            <td><?php echo $u['first_name'] . ' ' . $u['last_name']; ?></td>
            <td><?php echo $u['email']; ?></td>
            <td><?php echo $u['role']; ?></td>
            <td>
                <?php if ($u['id'] == $_SESSION['user_id']): ?>
                    (You)
                <?php else: ?>
                    <a href="/announcement_system/admin/delete_user.php?id= <?php echo $u['id']; ?> " onclick="return confirm('Delete this user?');">Delete</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<div class="card">
    <div class="meta">
        Note: to make any user admin, you can change role in database to 'admin'.
    </div>
</div>
