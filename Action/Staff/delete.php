<?php
require_once '../../Config/connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../view/Staff/index.php?error=Invalid request");
    exit;
}

// Get staff_id from POST and make sure it’s an integer
$id = (int)($_POST['staff_id'] ?? 0);

if ($id <= 0) {
    header("Location: ../../view/Staff/index.php?error=Invalid staff ID");
    exit;
}

// Prepare DELETE query
$sql = "DELETE FROM staff WHERE staff_id = ?";
$stmt = mysqli_prepare($con, $sql);

if (!$stmt) {
    header("Location: ../../view/Staff/index.php?error=Failed to prepare statement");
    exit;
}

// Bind parameter (i = integer)
mysqli_stmt_bind_param($stmt, "i", $id);

// Execute statement
if (mysqli_stmt_execute($stmt)) {
    header("Location: ../../view/Staff/index.php?msg=Staff deleted successfully");
} else {
    header("Location: ../../view/Staff/index.php?error=Failed to delete staff");
}

// Close
mysqli_stmt_close($stmt);
mysqli_close($con);
exit;
?>
