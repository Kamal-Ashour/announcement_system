<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/functions.php';

require_login();
if (!is_admin()) {
    die("Admins only.");
}

$sql = "SELECT a.id, a.title, a.created_at, u.first_name, u.last_name
        FROM announcements a
        JOIN users u ON a.user_id = u.id
        ORDER BY a.created_at DESC";
$res = mysqli_query($conn, $sql);

include __DIR__ . '/../partials/header.php';
?>

<h1>All Announcements</h1>

<table class="table">
    <tr>
        <th>Title</th>
        <th>User</th>
        <th>Date</th>
        <th>Actions</th>
    </tr>
    <?php while($a = mysqli_fetch_assoc($res)): ?>
        <tr>
            <td><?php echo ($a['title']); ?></td>
            <td><?php echo ($a['first_name'] . ' ' . $a['last_name']); ?></td>
            <td><?php echo ($a['created_at']); ?></td>
            <td>
                <a href="/announcement_system/announcements/edit.php?id=<?php echo $a['id']; ?>">Edit</a>
                |
                <a href="/announcement_system/announcements/delete.php?id=<?php echo $a['id']; ?>&from=admin" onclick="return confirm('Delete this announcement?');">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>


