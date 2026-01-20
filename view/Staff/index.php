<?php
session_start();
include '../../Config/connect.php';
include '../../root/header.php';

$sql = "SELECT staff_id, name, username,password, role, status, salary FROM staff";

$result = mysqli_query($con, $sql);
if (!$result) {
    die("Query Failed: " . mysqli_error($con));
}

$staffs = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
    <style>
        :root {
            --bs-body-bg: #f5f7fa;
            --font: AKbalthom Freehand;
        }

        body {
            margin-top: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: var(--font);
            /* background-color: var(--bs-body-bg); */
        }

        .card {
            width: 250px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            /* font-family: Arial, sans-serif; */
        }

        .card-header img {
            width: 100%;
            height: auto;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 1.25rem;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 1rem;
            margin-bottom: 15px;
        }
    </style>

    <div class="container-fluid px-4">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center my-4">
            <h4 class="fw-bold">Staff Management</h4>
            <a id="addItemBtn" href="create.php" class="btn btn-success px-4">+ Add New Employee</a>
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

                <div class="" style="display: flex; flex-wrap: wrap; gap: 20px; flex-direction: row;">

                    <!-- HEADER -->
                    <!-- <div class="row table-head d-none d-md-flex px-3 py-2 fw-semibold">
                        <div class="col-1">ID</div>
                        <div class="col-3"> Name</div>
                        <div class="col-2"> Username </div>
                        <div class="col-2"> Salary </div>
                        <div class="col-2">Role</div>
                        <div class="col-1 text-end">Status</div>
                        <div class="col-1 text-end">Action</div>
                    </div> -->

                    <!-- ROW -->
                    <?php foreach ($staffs  as $res):  ?>
                        <div class="card staff-card" data-name="<?= $res['name'] ?>">
                            <div class="card-header">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSaHfpIhAPZHSbZstaGEgFBIjZZ-Y-K533dag&s"
                                    alt="Image">
                            </div>

                            <div class="card-body">
                                <h6 class=" text-center"> <?= $res['name'] ?></h6>
                                <p class="card-text text-center"><small
                                        style="color:gray" ;> <?= $res['role'] ?></small> </p>

                                <p class="card-text">
                                    <small>Username: @<?= $res['username'] ?></small>
                                </p>

                                <p class="card-text">Salary: <?= $res['salary'] ?>$</p>
                                <p>
                                    Status:
                                    <?php if ($res['status'] === 'active'): ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Inactive</span>
                                    <?php endif; ?>
                                </p>

                                <div class="d-flex justify-content-evenly">
                                    <button class="btn btn-outline-primary btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal<?= $res['staff_id']; ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <form action="../../Action/Staff/delete.php" method="POST">
                                        <input type="hidden" name="staff_id" value="<?= $res['staff_id']; ?>">
                                        <button type="submit"
                                            class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this staff?');">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>


                                    <div class="modal fade"
                                        id="editModal<?= $res['staff_id']; ?>"
                                        tabindex="-1">

                                        <div class="modal-dialog">
                                            <form action="../../Action/Staff/update.php" method="POST" enctype="multipart/form-data">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel<?= $res['staff_id']; ?>">
                                                            Update
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <div class="modal-body p-4">
                                                        <input type="hidden" name="staff_id" value="<?= $res['staff_id']; ?>">

                                                        <div class="row">
                                                            <!-- Name -->
                                                            <div class="col-12 mb-3">
                                                                <label class="form-label">Name</label>
                                                                <input type="text" name="name" class="form-control"
                                                                    value="<?= $res['name']; ?>">
                                                            </div>

                                                            <!-- Username -->
                                                            
                                                            <div class="col-12 mb-3">
                                                                <label class="form-label">Password</label>
                                                                <input type="text" name="password" class="form-control"
                                                                    value="<?= $res['password']; ?>" >
                                                            </div>
                                                            <!-- Position -->
                                                            <div class="col-6 mb-3">
                                                                <label class="form-label">Position</label>
                                                                <select name="role" class="form-select"
                                                                    <?= ($res['role'] === 'admin') ? 'disabled' : '' ?>>
                                                                    <?php if ($res['role'] === 'admin'): ?>
                                                                        <option value="admin" selected>Admin</option>
                                                                    <?php else: ?>
                                                                        <option value="manager" <?= ($res['role'] === 'manager') ? 'selected' : '' ?>>Manager</option>
                                                                        <option value="cashier" <?= ($res['role'] === 'cashier') ? 'selected' : '' ?>>Cashier</option>
                                                                        <option value="barista" <?= ($res['role'] === 'barista') ? 'selected' : '' ?>>Baristar</option>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                            <!-- Salary -->
                                                            <div class="col-6 mb-3">
                                                                <label class="form-label">Salary</label>
                                                                <input type="number" name="salary" class="form-control"
                                                                    value="<?= $res['salary']; ?>">
                                                            </div>
                                                            <div class="col-6 mb-3">
                                                                <label class="form-label">Status</label>
                                                                <select name="action" id="" class="form-select">
                                                                    <option value="activate" <?= ($res['status'] === 'active') ? 'selected' : '' ?>>Activate</option>
                                                                    <option value="deactivate" <?= ($res['status'] === 'inactive') ? 'selected' : '' ?>>Inactive</option>
                                                                </select>
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
                        </div>



                    <?php endforeach; ?>


                </div>

            </div>




        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('menuSearch').addEventListener('input', function() {
            const q = this.value.toLowerCase().trim();

            document.querySelectorAll('.staff-card').forEach(card => {
                const name = (card.dataset.name || '').toLowerCase();
                card.style.display = name.includes(q) ? 'block' : 'none';
            });
        });
    </script>


</body>

</html>