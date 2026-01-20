<?php
require_once '../../Config/connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../view/Category/index.php?error=Invalid request");
    exit;
}

$id       = (int)($_POST['staff_id'] ?? 0);
$name     = trim($_POST['name'] ?? '');
$username = trim($_POST['username'] ?? '');
 $password = password_hash($_POST['Password'],PASSWORD_DEFAULT);
$role     = trim($_POST['role'] ?? '');
$salary   = trim($_POST['salary'] ?? '');
$status   = $_POST['status'] ?? 'active';

if ($id === 0 || $name === '') {
    header("Location: ../../view/Staff/index.php?error=Invalid data");
    exit;
}

/* ✅ FIXED TABLE NAME */
$sql = "UPDATE staff SET
            name = ?,
            username = ?,
            password = ?,
            role = ?,
            salary = ?,
            status = ?
        WHERE staff_id = ?";

$stmt = mysqli_prepare($con, $sql);

/* ✅ FIXED bind_param */
mysqli_stmt_bind_param(
    $stmt,
    "ssssdsi",   // 5 strings + 1 integer
    $name,
    $username,
    $password,
    $role,
    $salary,
    $status,
    $id
);


if (mysqli_stmt_execute($stmt)) {
    header("Location: ../../view/Staff/index.php?msg=Staff updated successfully");
} else {
    header("Location: ../../view/Staff/index.php?error=Update failed");
}

mysqli_stmt_close($stmt);
mysqli_close($con);     
exit;
?>
