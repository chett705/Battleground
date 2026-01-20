<?php
include_once '../../Config/connect.php';

if (!isset($_GET['id'])) {
    header("Location: ../../view/Menu/index.php");
    exit();
}

$item_id = (int)$_GET['id'];

/* ===== GET IMAGE FIRST ===== */
$select_sql = "SELECT image FROM menu_items WHERE item_id = ?";
$select_stmt = mysqli_prepare($con, $select_sql);
mysqli_stmt_bind_param($select_stmt, "i", $item_id);
mysqli_stmt_execute($select_stmt);
$result = mysqli_stmt_get_result($select_stmt);
$item = mysqli_fetch_assoc($result);
mysqli_stmt_close($select_stmt);

/* ===== DELETE ROW ===== */
$delete_sql = "DELETE FROM menu_items WHERE item_id = ?";
$delete_stmt = mysqli_prepare($con, $delete_sql);
mysqli_stmt_bind_param($delete_stmt, "i", $item_id);

if (mysqli_stmt_execute($delete_stmt)) {

    /* delete image file if exists */
    if (!empty($item['image'])) {
        $imgPath = '../../uploads/' . $item['image'];
        if (file_exists($imgPath)) {
            unlink($imgPath);
        }
    }

    header("Location: ../../view/Menu/index.php?success=Item deleted successfully");
} else {
    header("Location: ../../view/Menu/index.php?error=Delete failed");
}

mysqli_stmt_close($delete_stmt);
mysqli_close($con);
exit();
