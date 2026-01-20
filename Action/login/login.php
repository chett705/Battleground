
<?php
session_start();
require_once "../../Config/connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_login'])) {

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $_SESSION['Login'] = 'Username and password are required';
        $_SESSION['icon']  = 'warning';
        $_SESSION['title'] = 'Login Failed';
        header('Location: ../../view/login/login.php');
        exit;
    }

    // ✅ PREPARED STATEMENT
    $sql = "SELECT staff_id, username, password, role
            FROM staff
            WHERE username = ?
            LIMIT 1";

    $stmt = mysqli_prepare($con, $sql);
    if (!$stmt) {
        $_SESSION['Login'] = 'System error';
        header('Location: ../../view/login/login.php');
        exit;
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        $_SESSION['Login'] = 'Invalid username or password';
        $_SESSION['icon']  = 'error';
        $_SESSION['title'] = 'Login Failed';
        header('Location: ../../view/login/login.php');
        exit;
    }

    if (!password_verify($password, $user['password'])) {
        $_SESSION['Login'] = 'Invalid username or password';
        $_SESSION['icon']  = 'error';
        $_SESSION['title'] = 'Login Failed';
        header('Location: ../../view/login/login.php');
        exit;
    }

    // ✅ LOGIN SUCCESS
    session_regenerate_id(true);

    $_SESSION['IsLogin']  = true;
    $_SESSION['staff_id'] = $user['staff_id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role']     = $user['role'];

    // ✅ ROLE REDIRECT
    if ($user['role'] === 'admin') {
        header('Location: ../../view/Dashboard/index.php');
    } else {
        header('Location: ../../view/Staff/index.php');
    }
    exit;
}

// ❌ Direct access
header('Location: ../../view/login/login.php');
exit;