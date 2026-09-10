<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/functions.php';

require_login();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$stmt = mysqli_prepare($conn, "SELECT user_id FROM announcements WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);

if (!$row) {
    die("Announcement not found.");
}

if (!is_admin() && $row['user_id'] != $_SESSION['user_id']) {
    die("You are not allowed to delete this.");
}

$del = mysqli_prepare($conn, "DELETE FROM announcements WHERE id = ?");
mysqli_stmt_bind_param($del, "i", $id);
mysqli_stmt_execute($del);

if (is_admin() && isset($_GET['from']) && $_GET['from'] === 'admin') {
    header("Location: /announcement_system/admin/announcements.php");
} else {
    header("Location: /announcement_system/announcements/my.php");
}
exit;
