<?php
session_start();
require_once "../../Config/connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_login'])) {

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $_SESSION['Login'] = 'Username and password are required';
        header('Location: ../../view/Login/login.php');
        exit;
    }

    // ✅ Prepared statement
    $sql = "SELECT staff_id, username, password, role 
            FROM staff 
            WHERE username = ? AND status = 'A'";

    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    // ❌ User not found
    if (!$user) {
        $_SESSION['Login'] = 'Invalid username or password';
        $_SESSION['icon'] = 'error';
        $_SESSION['title'] = 'Login Failed';
        header('Location: ../../view/Login/login.php');
        exit;
    }

    // ❌ Password incorrect
    if (!password_verify($password, $user['password'])) {
        $_SESSION['Login'] = 'Invalid username or password';
        $_SESSION['icon'] = 'error';
        $_SESSION['title'] = 'Login Failed';
        header('Location: ../../view/Login/login.php');
        exit;
    }

    // ✅ Login success
    $_SESSION['IsLogin'] = true;
    $_SESSION['user'] = [
        'id'       => $user['staff_id'],
        'username' => $user['username'],
        'role'     => $user['role']
    ];

    header('Location: ../../index.php');
    exit;

} else {
    http_response_code(405);
    echo "Invalid request";
}
