<?php include '../../root/header.php';
include '../../Config/connect.php';
$sql = "SELECT * FROM categories ";
$result = mysqli_query($con, $sql);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Category Management</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your CSS -->
    <link rel="stylesheet" href="../../Style/menu.css">
</head>

<body>

    <div class="container-fluid px-4">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center my-4">
            <h4 class="fw-bold">Category Management</h4>
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

                </div>


                <div>

                </div>

                <div class="menu-table">

                    <!-- HEADER -->
                    <div class="row table-head d-none d-md-flex px-3 py-2 fw-semibold">
                        <div class="col-1">ID</div>
                        <div class="col-5"> Name</div>
                        <div class="col-4"> Description </div>
                        <div class="col-1">Status</div>
                        <div class="col-1 text-end">Action</div>
                    </div>

                    <!-- ROW -->
                    <?php foreach ($result as $res):  ?>


                        <div class="row menu-row align-items-center p-3 product-item"
                            data-name="<?php echo $res["category_name"]; ?>"
                            data-category="<?php echo $res["category_name"]  ?>">
                            <div class="col-1">

                                <p><?= $res['category_id'] ?></p>

                            </div>
                            <div class="col-5">

                                <p><?= $res['category_name'] ?></p>

                            </div>
                            <div class="col-4">

                                <p><?= $res['description'] ?></p>

                            </div>

                            <div class="col-1 text-center">
                                <?php if ($res['status'] === 'active'): ?>
                                    <span class="status-dot bg-success"></span>
                                <?php else: ?>
                                    <span class="status-dot bg-danger"></span>
                                <?php endif; ?>
                            </div>



                            <div class="col-1 ">
                                <button class="badge bg-success border-0"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal<?= $res['category_id']; ?>">
                                    Edit
                                </button>
                                <span class="badge bg-danger">Delete</span>
                                <!-- Button trigger modal -->


                                <!-- Modal -->
                                <div class="modal fade"
                                    id="editModal<?= $res['category_id']; ?>"
                                    tabindex="-1">

                                    <div class="modal-dialog">
                                        <form action="../../Action/Category/update.php" method="POST" enctype="multipart/form-data">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel<?= $res['category_id']; ?>">Update</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                </div>

                                                <div class="modal-body">
                                                    <div class="header">
                                                        <input type="hidden" name="category_id" value="<?= $res['category_id']; ?>">


                                                    </div>
                                                    <div class="w-full">
                                                        <div class="col-6">
                                                            <label for="" class="form-label">Name</label>
                                                            <input type="text" name="category_name" class="form-control" value="<?= $res["category_name"] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="w-full">
                                                        <div class="col-6 mt-2">
                                                            <label for="" class="form-label">Description</label>
                                                            <input type="text" name="description" class="form-control" value="<?= $res["description"] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-4 mt-2">
                                                        <label for="" class="form-label">Status</label>
                                                        <select name="status" id="" class="form-select">
                                                            <option value="active" <?= ($res['status'] === 'active') ? 'selected' : '' ?>>Active</option>
                                                            <option value="inactive" <?= ($res['status'] === 'inactive') ? 'selected' : '' ?>>Inactive</option>
                                                        </select>
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






        })();
    </script>
</body>

</html>