<?php
require_once __DIR__ . '/../config/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Announcement Board</title>
    <link rel="stylesheet" href="/announcement_system/style.css" />
</head>
<body>
<div class="container">
    <div class="topbar">
        <a class="logo" href="/announcement_system/index.php">Announcement Board</a>
        <div class="nav">
            <a href="/announcement_system/index.php">Home</a>
            <?php if (is_logged_in()): ?>
                <a href="/announcement_system/announcements/my.php">My Announcements</a>
                <a href="/announcement_system/announcements/add.php">Add</a>
                <a href="/announcement_system/profile.php">Profile</a>
                <?php if (is_admin()): ?>
                    <a href="/announcement_system/admin/dashboard.php">Admin</a>
                <?php endif; ?>
                <a href="/announcement_system/auth/logout.php">Logout</a>
            <?php else: ?>
                <a href="/announcement_system/auth/register.php">Register</a>
                <a href="/announcement_system/auth/login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>

