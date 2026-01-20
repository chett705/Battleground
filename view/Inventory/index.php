<?php include '../../root/header.php';
include '../../Config/connect.php';

$sql = "SELECT * FROM inventory ORDER BY qty ASC";
$result = mysqli_query($con, $sql);

$cat= "SELECT * FROM categories ORDER BY category_name ASC";
$cat_result = mysqli_query($con, $cat);
?>
<link rel="stylesheet" href="../../Style/inventory.css">

<body>
    <nav class="navbar bg-light">
        <h3 class="px-4">inventory report<i class="bi bi-backpack2"></i></h3>
    </nav>


    <div class="container-fluid d-flex justify-content-between align-items-center my-3">
        <input id="menuSearch"
            class="form-input "
            placeholder="Search items by name, category...">
        <div>
           <select name="category" id="categorySelect" class="form-input">
                <option value="">All Categories</option>
                <?php
                $cat_sql = "SELECT * FROM categories ORDER BY category_name ASC";
                $cat_result = mysqli_query($con, $cat_sql);
                while ($cat = mysqli_fetch_assoc($cat_result)) {
                    echo "<option value=\"" . htmlspecialchars($cat['category_id']) . "\">" . htmlspecialchars($cat['category_name']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div>

        </div>
    </div>



</body>