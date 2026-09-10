<?php
require_once __DIR__ . '/../config/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Announcement Board</title>
    <link rel="stylesheet" href="/style.css" />
</head>
<body>
<div class="container">
    <div class="topbar">
        <a class="logo" href="/index.php">Announcement Board</a>
        <div class="nav">
            <a href="/index.php">Home</a>
            <?php if (is_logged_in()): ?>
                <a href="/announcements/my.php">My Announcements</a>
                <a href="/announcements/add.php">Add</a>
                <a href="/profile.php">Profile</a>
                <?php if (is_admin()): ?>
                    <a href="/admin/dashboard.php">Admin</a>
                <?php endif; ?>
                <a href="/auth/logout.php">Logout</a>
            <?php else: ?>
                <a href="/auth/register.php">Register</a>
                <a href="/auth/login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>

