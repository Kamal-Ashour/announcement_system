<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/functions.php';

$msg = "";

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $pass  = $_POST['password'];

    if ($email == "" || $pass == "") {
        $msg = "Please enter email and password.";
    } else {
        $stmt = mysqli_prepare($conn, "SELECT id, password, role FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($res);

        if ($user && password_verify($pass, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            header("Location: /index.php");
            exit;
        } else {
            $msg = "Wrong email or password.";
        }
    }
}

include __DIR__ . '/../partials/header.php';
?>

<h1>Login</h1>

<?php if ($msg): ?>
    <div class="alert"><?php echo e($msg); ?></div>
<?php endif; ?>

<form class="form" method="POST">
    <label>Email</label>
    <input type="email" name="email" />

    <label>Password</label>
    <input type="password" name="password" />

    <button class="btn" type="submit" name="login">Login</button>
    <div class="smalllink">
        Don't have an account? <a href="/auth/register.php">Register</a>
    </div>
</form>


