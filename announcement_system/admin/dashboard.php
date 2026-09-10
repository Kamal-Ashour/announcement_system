<?php
require_once __DIR__ . '/../config/functions.php';

require_login();
if (!is_admin()) {
    die("Admins only.");
}

include __DIR__ . '/../partials/header.php';
?>

<h1>Admin Dashboard</h1>

<div class="card">
    <p><a href="/announcement_system/admin/users.php">Manage Users</a></p>
    <p><a href="/announcement_system/admin/announcements.php">Manage Announcements</a></p>
</div>


