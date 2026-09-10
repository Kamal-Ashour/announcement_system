<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/functions.php';

require_login();

$msg = "";

if (isset($_POST['add'])) {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $uid = $_SESSION['user_id'];

    if ($title == "" || $content == "") {
        $msg = "Please fill all fields.";
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO announcements (title, content, user_id) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssi", $title, $content, $uid);
        mysqli_stmt_execute($stmt);
        header("Location: /announcement_system/announcements/my.php");
        exit;
    }
}

include __DIR__ . '/../partials/header.php';
?>

<h1>Add Announcement</h1>

<?php if ($msg): ?>
    <div class="alert"><?php echo e($msg); ?></div>
<?php endif; ?>

<form class="form" method="POST">
    <label>Title</label>
    <input type="text" name="title" />

    <label>Text</label>
    <textarea name="content" rows="6"></textarea>

    <button class="btn" type="submit" name="add">Add</button>
</form>


