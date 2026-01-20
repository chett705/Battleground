<?php
include '../../Config/connect.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($con, trim($_POST['name']));
    $username = mysqli_real_escape_string($con, trim($_POST['username']));
    $password = mysqli_real_escape_string($con, trim($_POST['password']));
    $role = mysqli_real_escape_string($con, trim($_POST['role']));
    $salary = mysqli_real_escape_string($con, trim($_POST['salary']));
    $status = mysqli_real_escape_string($con, trim($_POST['status']));

    // Validate that name and username are not empty
    if(empty($name) || empty($username)) {
        header("Location: ../../view/Staff/create.php?error=Name and Username are required");
        exit();
    }

    // Insert into database
    $sql = "INSERT INTO staff (name, username, password, role, status, salary) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);

    // Correct: 6 strings -> "ssssss"
    mysqli_stmt_bind_param($stmt, "ssssdis", $name, $username, $password, $role, $status, $salary);
    if(mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($con);
        header("Location: ../../view/Staff/index.php?msg=Staff created successfully");
    } else {
        mysqli_stmt_close($stmt);
        mysqli_close($con);
        header("Location: ../../view/Staff/create.php?error=Failed to create staff");
    }
    exit();
} else {
    header("Location: ../../view/Staff/create.php");
    exit();
}
?>
