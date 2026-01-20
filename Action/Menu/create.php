    <?php
    include_once '../../Config/connect.php';
    // create
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: ../../view/Menu/create.php");
        exit();
    }

    /* ====== GET & SANITIZE ====== */
    $item_name   = trim($_POST['item_name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $category_id = (int)($_POST['category_id'] ?? 0);
    $price       = (float)($_POST['price'] ?? 0);
    $qty       = (int)($_POST['Qty'] ?? 0);
    $status      = $_POST['status'] ?? 'available';

    $image_path = null;

    /* ====== VALIDATION ====== */
    if ($item_name === '' || $category_id === 0 || $price <= 0) {
        header("Location: ../../view/Menu/create.php?error=Required fields missing");
        exit();
    }

    /* ====== DUPLICATE CHECK ====== */
    $check_sql = "SELECT item_id FROM menu_items WHERE item_name = ?";
    $check_stmt = mysqli_prepare($con, $check_sql);
    mysqli_stmt_bind_param($check_stmt, "s", $item_name);
    mysqli_stmt_execute($check_stmt);
    $result = mysqli_stmt_get_result($check_stmt);

    if (mysqli_num_rows($result) > 0) {
        mysqli_stmt_close($check_stmt);
        header("Location: ../../view/Menu/create.php?error=Item already exists");
        exit();
    }
    mysqli_stmt_close($check_stmt);

    /* ====== IMAGE UPLOAD ====== */
    if (!empty($_FILES['image']['name'])) {

        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $tmp     = $_FILES['image']['tmp_name'];
        $size    = $_FILES['image']['size'];
        $ext     = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            header("Location: ../../view/Menu/create.php?error=Invalid image type");
            exit();
        }

        if ($size > 5 * 1024 * 1024) {
            header("Location: ../../view/Menu/create.php?error=Image too large");
            exit();
        }

        $upload_dir = '../../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $filename = uniqid('menu_', true) . '.' . $ext;
        $fullpath = $upload_dir . $filename;

        if (move_uploaded_file($tmp, $fullpath)) {
            $image_path = $filename;
        } else {
            header("Location: ../../view/Menu/create.php?error=Upload failed");
            exit();
        }
    }

    /* ====== INSERT ====== */
    $sql = "
        INSERT INTO menu_items
        (category_id, item_name, description, price, Qty, image, status)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ";

    $stmt = mysqli_prepare($con, $sql);
   mysqli_stmt_bind_param(
    $stmt,
    "issdiss",
    $category_id,
    $item_name,
    $description,
    $price,
    $qty,
    $image_path,
    $status
);


    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($con);
        header("Location: ../../view/Menu/index.php?msg=Item created successfully");
    } else {
        mysqli_stmt_close($stmt);
        mysqli_close($con);
        header("Location: ../../view/Menu/create.php?error=Create failed");
    }
    exit();
