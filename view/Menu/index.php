<?php include '../../root/header.php';
include '../../Config/connect.php';
$sql = "SELECT * FROM categories WHERE status='active'";
$result = mysqli_query($con, $sql);

$menu = "
    SELECT m.*, c.category_name
    FROM menu_items m
    JOIN categories c ON m.category_id = c.category_id
    ORDER BY m.description DESC
";
$menu_result = mysqli_query($con, $menu);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Menu Management</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your CSS -->
    <link rel="stylesheet" href="../../Style/menu.css">
</head>

<body>

    <div class="container-fluid px-4">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center my-4">
            <h4 class="fw-bold">Menu Management</h4>
            <a id="addItemBtn" href="create.php" class="btn btn-success px-4">+ Add New Item</a>
        </div>

        <!-- Create modal (loads content from create.php) -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-body p-0" id="createModalBody">
                        a
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">

            <!-- LEFT: MENU LIST -->
            <div class="col-lg-8">
                <div>
                    <input id="menuSearch"
                        class="form-control mb-3"
                        placeholder="Search items by name, category...">
                    <ul class="nav nav-pills category-tabs mb-3 ">

                        <li class="nav-item">
                            <a class="nav-link active" href="#" data-category="all">All</a>
                        </li>

                        <?php foreach ($result as $cat): ?>
                            <li class="nav-item">
                                <a class="nav-link "
                                    href="#"
                                    data-category="<?= $cat['category_id'] ?>">
                                    <?= $cat['category_name'] ?>
                                </a>
                            </li>
                        <?php endforeach; ?>


                    </ul>
                </div>


                <div>

                </div>

                <div class="menu-table">

                    <!-- HEADER -->
                    <div class="row table-head d-none d-md-flex px-3 py-2 fw-semibold">
                        <div class="col-2">Image</div>
                        <div class="col-3">Item Name</div>
                        <div class="col-2">Category</div>
                        <div class="col-2 text-end">Price</div>
                        <div class="col-1 text-end">Qty</div>
                        <div class="col-1 text-center">Status</div>
                        <div class="col-1 text-end">Action</div>
                    </div>

                    <!-- ROW -->
                    <?php foreach ($menu_result as $mu):  ?>


                        <div class="row menu-row align-items-center p-3 product-item"
                            data-name="<?php echo $mu["item_name"]; ?>"
                            data-category="<?php echo $mu["category_id"]  ?>">

                            <div class="col-2">
                                <img src="<?= !empty($mu['image'])
                                                ? '../../uploads/' . htmlspecialchars($mu['image'])
                                                : 'https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png' ?>"
                                    style="width:70px;height:70px;object-fit:cover;"
                                    alt="">
                            </div>


                            <div class="col-3">
                                <strong><?php echo $mu["item_name"]; ?></strong>

                                <div class="small text-muted"><?= $mu["description"]  ?></div>
                            </div>

                            <div class="col-2">
                                <span class="badge bg-primary">
                                    <?= $mu['category_name'] ?>
                                </span>
                            </div>


                            <div class="col-2 text-end fw-semibold"><?= $mu["price"] ?>$</div>

                            <div class="col-1 text-end fw-semibold">
                                <?= (int)$mu['Qty']; ?>
                            </div>

                            <div class="col-1 text-center">
                                <?php if ($mu['status'] === 'available'): ?>
                                    <span class="status-dot bg-success"></span>
                                <?php else: ?>
                                    <span class="status-dot bg-danger"></span>
                                <?php endif; ?>
                            </div>



                            <div class="col-1 text-end">
                                <button class="badge bg-success border-0"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal<?= $mu['item_id']; ?>">
                                    Edit
                                </button>
                                <a class="badge bg-danger " href="../../action/Menu/delete.php?id=<?= $mu['item_id'] ?>" style=" text-decoration: none; "  onclick="return confirm('Delete this item?')">Delete</a>
                                <!-- Button trigger modal -->


                                <!-- Modal -->
                                <div class="modal fade"
                                    id="editModal<?= $mu['item_id']; ?>"
                                    tabindex="-1">

                                    <div class="modal-dialog">
                                        <form action="../../Action/Menu/update.php" method="POST" enctype="multipart/form-data">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel<?= $mu['item_id']; ?>">Edit</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="w-full">
                                                        <div class="card edit-pane p-4 text-start">
                                                            <input type="hidden" name="item_id" value="<?= $mu['item_id']; ?>">



                                                            <img id="previewImage"
                                                                class="img-fluid mb-3"
                                                                src="<?= !empty($mu['image']) ? '../../uploads/' . htmlspecialchars($mu['image']) : 'https://via.placeholder.com/240' ?>">

                                                            <!-- IMAGE INPUT -->
                                                            <input type="file"
                                                                name="image"
                                                                class="form-control mb-3"
                                                                accept="image/*"
                                                                onchange="preview(this)">

                                                            <label class="form-label small">Name</label>
                                                            <input id="editName" class="form-control mb-2" name="item_name" value="<?= htmlspecialchars($mu['item_name']); ?>  ">

                                                            <label class="form-label small">Description</label>
                                                            <input id="editDesc" value="<?= htmlspecialchars($mu["description"]) ?> " class="form-control mb-3" name="description">

                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <label class="form-label small">Category</label>
                                                                    <select id="editCategory" name="category_id" class="form-select">
                                                                        <?php foreach ($result as $cat): ?>
                                                                            <option value="<?= $cat['category_id']; ?>"
                                                                                <?= ($cat['category_id'] == $mu['category_id']) ? 'selected' : ''; ?>>
                                                                                <?= htmlspecialchars($cat['category_name']); ?>
                                                                            </option>
                                                                        <?php endforeach; ?>
                                                                    </select>

                                                                </div>
                                                                <div class="col-6">
                                                                    <label class="form-label small" name="price">Price ($)</label>
                                                                    <input id="editPrice" name="price" type="number" step="0.01" min="0" class="form-control" value="<?= htmlspecialchars($mu['price']); ?>">
                                                                </div>

                                                            </div>

                                                            <div class="row mt-2">
                                                                <div class="col-4">
                                                                    <label class="form-label small">Qty</label>
                                                                    <input type="number" name="Qty" min="0" class="form-control" value="<?= (int)$mu['Qty']; ?>">
                                                                </div>
                                                            </div>

                                                            <div class="col-4 text-center mt-2">
                                                                <select name="status" id="" class="form-select">
                                                                    <option value="available" <?= ($mu['status'] === 'available') ? 'selected' : '' ?>>Available</option>
                                                                    <option value="sold_out" <?= ($mu['status'] === 'sold_out') ? 'selected' : '' ?>>Sold Out</option>
                                                                </select>
                                                            </div>



                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>


                </div>

            </div>




        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        (function() {
            const menuSearch = document.getElementById('menuSearch');
            const container = document.querySelector('.menu-table');
            if (!container) return;

            // search filtering
            menuSearch?.addEventListener('input', function() {
                const q = this.value.trim().toLowerCase();
                container.querySelectorAll('.menu-row').forEach(r => {
                    const name = r.querySelector('strong') ? r.querySelector('strong').innerText.toLowerCase() : '';
                    const cat = r.dataset.category ? String(r.dataset.category).toLowerCase() : (r.querySelector('.badge.category') ? r.querySelector('.badge.category').innerText.toLowerCase() : '');
                    const desc = r.querySelector('.small.text-muted') ? r.querySelector('.small.text-muted').innerText.toLowerCase() : '';
                    const ok = !q || name.includes(q) || cat.includes(q) || desc.includes(q);
                    r.style.display = ok ? 'flex' : 'none';
                });
                const first = Array.from(container.querySelectorAll('.menu-row')).find(r => getComputedStyle(r).display !== 'none');
                if (first) first.click();
            });

            // category tabs
            document.querySelectorAll('.category-tabs .nav-link').forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelectorAll('.category-tabs .nav-link').forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    const cat = this.dataset.category;
                    container.querySelectorAll('.menu-row').forEach(r => {
                        const productCat = r.dataset.category || (r.querySelector('.badge.category') ? r.querySelector('.badge.category').innerText : '');
                        r.style.display = (cat === 'all' || String(productCat) === String(cat)) ? 'flex' : 'none';
                    });

                    const first = Array.from(container.querySelectorAll('.menu-row')).find(r => getComputedStyle(r).display !== 'none');
                    if (first) first.click();
                });
            });



        })();
    </script>
</body>

</html>