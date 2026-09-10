<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/functions.php';

require_login();
if (!is_admin()) {
    die("Admins only.");
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id == 0) {
    die("Invalid user.");
}

if ($id == $_SESSION['user_id']) {
    die("You can't delete your own account.");
}

$del = mysqli_prepare($conn, "DELETE FROM users WHERE id = ?");
mysqli_stmt_bind_param($del, "i", $id);
mysqli_stmt_execute($del);

header("Location: /announcement_system/admin/users.php");
exit;
