<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/functions.php';
include __DIR__ . '/partials/header.php';


$user_id = $_SESSION['user_id'];


$sql = "SELECT a.*, u.first_name, u.last_name
        FROM announcements a
        JOIN users u ON a.user_id = u.id
        WHERE a.user_id = ?
        ORDER BY a.created_at DESC";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id); 
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

?>


<h1>Latest Announcements</h1>

<?php if (!$result || mysqli_num_rows($result) == 0): ?>
    <div class="card">No announcements yet.</div>
<?php else: ?>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div class="card">
            <h3><?php echo $row['title']; ?></h3>
            <p><?php echo nl2br($row['content']); ?></p>
            <div class="meta">
                By <?php echo $row['first_name'] . ' ' . $row['last_name']; ?>
                • <?php echo $row['created_at']; ?>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
