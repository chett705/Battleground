<?php
include '../../Config/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name     = trim($_POST['name'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $role     = trim($_POST['role'] ?? '');
    $salary   = (float)($_POST['salary'] ?? 0);
    $status   = trim($_POST['status'] ?? 'active');

    // Validation
    if ($name === '' || $username === '' || $password === '') {
        header("Location: ../../view/Staff/create.php?error=Name, Username and Password are required");
        exit();
    }

    // Hash password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL
    $sql = "INSERT INTO staff (name, username, password, role, status, salary)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($con, $sql);

    if (!$stmt) {
        header("Location: ../../view/Staff/create.php?error=Prepare failed");
        exit();
    }

    // ✅ Correct binding
    mysqli_stmt_bind_param(
        $stmt,
        "sssssd",
        $name,
        $username,
        $passwordHash,
        $role,
        $status,
        $salary
    );

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../../view/Staff/index.php?msg=Staff created successfully");
    } else {
        header("Location: ../../view/Staff/create.php?error=Failed to create staff");
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
    exit();
}

header("Location: ../../view/Staff/create.php");
exit();
?>
