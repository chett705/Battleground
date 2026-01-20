<?php
require_once '../../Config/connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../view/Category/index.php?error=Invalid request");
    exit;
}

$category_id   = (int)($_POST['category_id'] ?? 0);
$category_name = trim($_POST['category_name'] ?? '');
$description   = trim($_POST['description'] ?? '');
$status        = $_POST['status'] ?? 'active';

if ($category_id === 0 || $category_name === '') {
    header("Location: ../../view/Category/index.php?error=Invalid data");
    exit;
}

/* ✅ FIXED TABLE NAME */
$sql = "UPDATE categories SET
            category_name = ?,
            description   = ?,
            status        = ?
        WHERE category_id = ?";

$stmt = mysqli_prepare($con, $sql);

/* ✅ FIXED bind_param */
mysqli_stmt_bind_param(
    $stmt,
    "sssi",          // s = string, i = integer
    $category_name,
    $description,
    $status,
    $category_id
);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../../view/Category/index.php?msg=Category updated successfully");
} else {
    header("Location: ../../view/Category/index.php?error=Update failed");
}

mysqli_stmt_close($stmt);
mysqli_close($con);
exit;
