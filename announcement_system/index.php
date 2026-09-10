<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/functions.php';
include __DIR__ . '/partials/header.php';

$sql = "SELECT a.*, u.first_name, u.last_name
        FROM announcements a
        JOIN users u ON a.user_id = u.id
        ORDER BY a.created_at DESC
        LIMIT 10";
$result = mysqli_query($conn, $sql);
?>

<h1>Latest Announcements</h1>

<?php if (!$result || mysqli_num_rows($result) == 0): ?>
        <div class="card">No announcements yet.</div>
<?php else : ?>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div class="card">
            <h3><?php echo $row['title']; ?></h3>
            <p><?php echo nl2br($row['content']); ?></p>
            <div class="meta">
                By <?php echo $row['first_name'] . ' ' . $row['last_name']; ?>
                --- <?php echo $row['created_at']; ?> ---
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
