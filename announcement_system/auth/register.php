<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/functions.php';


$msg = "";
if (isset($_POST['register'])) {
    $first = $_POST['first_name'];
    $last  = $_POST['last_name'];
    $email = $_POST['email'];
    $pass  = $_POST['password'];

    if ($first == "" || $last == "" || $email == "" || $pass == "") {
        $msg = "Please fill all fields.";
    } else {
        $password_hash = password_hash($pass, PASSWORD_DEFAULT);

        // تحقق  هل الايميل موجود
        $check = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ?");
        mysqli_stmt_bind_param($check, "s", $email);
        mysqli_stmt_execute($check);
        mysqli_stmt_store_result($check);

        if (mysqli_stmt_num_rows($check) > 0) {
            $msg = "This email is already used.";
        } else {
            $stmt = mysqli_prepare($conn, "INSERT INTO users (first_name, last_name, email, password, role) VALUES (?, ?, ?, ?, 'user')");
            mysqli_stmt_bind_param($stmt, "ssss", $first, $last, $email, $password_hash);
            mysqli_stmt_execute($stmt);

            header("Location: /auth/login.php");
            exit;
        }
    }
}

include __DIR__ . '/../partials/header.php';
?>

<h1>Register</h1>

<?php if ($msg): ?>
    <div class="alert"><?php echo e($msg); ?></div>
<?php endif; ?>

<form class="form" method="POST">
    <label>First Name</label>
    <input type="text" name="first_name" />

    <label>Last Name</label>
    <input type="text" name="last_name" />

    <label>Email</label>
    <input type="email" name="email" />

    <label>Password</label>
    <input type="password" name="password" />

    <button class="btn" type="submit" name="register">Create Account</button>
    <div class="smalllink">
        Already have an account? <a href="/auth/login.php">Login</a>
    </div>
</form>
