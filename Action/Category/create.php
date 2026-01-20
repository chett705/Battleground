<?php
include '../../Config/connect.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $code = mysqli_real_escape_string($con, trim($_POST['category_name']));
    $desc = mysqli_real_escape_string($con, trim($_POST['description']));
    $remark = mysqli_real_escape_string($con, trim($_POST['status']));

    // Validate that code and description are not empty
    if(empty($code) || empty($desc)) {
        header("Location: ../../view/Category/create.php?error=Code and Description are required");
        exit();
    }

    

    // Insert into database
    $sql = "INSERT INTO categories (category_name, `description`, status) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $code, $desc, $remark);
    
    if(mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($con);
        header("Location: ../../view/Category/index.php?msg=Category created successfully");
    } else {
        mysqli_stmt_close($stmt);
        mysqli_close($con);
        header("Location: ../../view/Category/create.php?error=Failed to create category");
    }
    exit();
} else {
    header("Location: ../../view/Category/create.php");
    exit();
}
?>