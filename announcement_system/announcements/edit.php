<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/functions.php';

require_login();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$msg = "";


$stmt = mysqli_prepare($conn, "SELECT * FROM announcements WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$ann = mysqli_fetch_assoc($res);

if (!$ann) {
    die("Announcement not found.");
}


if (!is_admin() && $ann['user_id'] != $_SESSION['user_id']) {
    die("You are not allowed to edit this.");
}

if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if ($title == "" || $content == "") {
        $msg = "Please fill all fields.";
    } else {
        $up = mysqli_prepare($conn, "UPDATE announcements SET title=?, content=? WHERE id=?");
        mysqli_stmt_bind_param($up, "ssi", $title, $content, $id);
        mysqli_stmt_execute($up);
        $msg = "Announcement updated.";

        
        $stmt = mysqli_prepare($conn, "SELECT * FROM announcements WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $ann = mysqli_fetch_assoc($res);
    }
}

include __DIR__ . '/../partials/header.php';
?>

<h1>Edit Announcement</h1>

<?php if ($msg): ?>
    <div class="alert"><?php echo $msg; ?></div>
<?php endif; ?>

<form class="form" method="POST">
    <label>Title</label>
    <input type="text" name="title" value="<?php echo $ann['title']; ?>" />

    <label>Text</label>
    <textarea name="content" rows="6"><?php echo $ann['content']; ?></textarea>

    <button class="btn" type="submit" name="save">Save</button>
</form>
