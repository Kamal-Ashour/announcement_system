<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/functions.php';

require_login();

$uid = $_SESSION['user_id'];

$stmt = mysqli_prepare($conn, "SELECT * FROM announcements WHERE user_id = ? ORDER BY created_at DESC");
mysqli_stmt_bind_param($stmt, "i", $uid);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);

include __DIR__ . '/../partials/header.php';
?>

<h1>My Announcements</h1>

<?php if (mysqli_num_rows($res) == 0): ?>
    <div class="card">You don't have announcements yet.</div>
<?php else: ?>
    <table class="table">
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($res)): ?>
            <tr>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['created_at']; ?></td>
                <td>
                    <a href="/announcements/edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                    |
                    <a href="/announcements/delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this announcement?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php endif; ?>
