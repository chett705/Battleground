<?php
require_once '../../Config/connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../view/Menu/index.php?error=Invalid request");
    exit;
}

$item_id     = (int)($_POST['item_id'] ?? 0);
$item_name   = trim($_POST['item_name'] ?? '');
$description = trim($_POST['description'] ?? '');
$category_id = (int)($_POST['category_id'] ?? 0);
$price       = (float)($_POST['price'] ?? 0);
$Qty         = (int)($_POST['Qty'] ?? 0);
$status      = $_POST['status'] ?? 'available';

if ($item_id === 0 || $item_name === '' || $category_id === 0 || $price <= 0) {
    header("Location: ../../view/Menu/index.php?error=Invalid data");
    exit;
}

// Get old image
$image_path = null;
$get = mysqli_prepare($con, "SELECT image FROM menu_items WHERE item_id = ?");
mysqli_stmt_bind_param($get, "i", $item_id);
mysqli_stmt_execute($get);
$res = mysqli_stmt_get_result($get);
if ($row = mysqli_fetch_assoc($res)) {
    $image_path = $row['image'];
}
mysqli_stmt_close($get);

// Handle new image upload
if (!empty($_FILES['image']['name'])) {

    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    $tmp  = $_FILES['image']['tmp_name'];
    $size = $_FILES['image']['size'];
    $ext  = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        header("Location: ../../view/Menu/index.php?error=Invalid image type");
        exit;
    }

    if ($size > 15 * 1024 * 1024) {
        header("Location: ../../view/Menu/index.php?error=Image too large");
        exit;
    }

    $upload_dir = '../../uploads/';
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

    $filename = uniqid('menu_', true) . '.' . $ext;
    $fullpath = $upload_dir . $filename;

    if (move_uploaded_file($tmp, $fullpath)) {
        // delete old image
        if (!empty($image_path) && file_exists('../../uploads/' . basename($image_path))) {
            unlink('../../uploads/' . basename($image_path));
        }
        $image_path = $filename;
    } else {
        header("Location: ../../view/Menu/index.php?error=Upload failed");
        exit;
    }
}

// Update query
$sql = "UPDATE menu_items SET
            category_id = ?,
            item_name   = ?,
            description = ?,
            price       = ?,
            Qty         = ?,
            image       = ?,
            status      = ?
        WHERE item_id = ?";

$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param(
    $stmt,
    "issdissi",
    $category_id,
    $item_name,
    $description,
    $price,
    $Qty,
    $image_path,
    $status,
    $item_id
);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../../view/Menu/index.php?msg=Item updated successfully");
} else {
    header("Location: ../.Z./view/Menu/index.php?error=Update failed");
}

mysqli_stmt_close($stmt);
mysqli_close($con);
exit;
