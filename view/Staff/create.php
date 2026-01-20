<?php
session_start();
include '../../Config/connect.php';
include '../../root/header.php';

$sql = "SELECT staff_id, name, username, role, status, salary FROM staff";

$result = mysqli_query($con, $sql);
if (!$result) {
    die("Query Failed: " . mysqli_error($con));
}

$staffs = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<link rel="stylesheet" href="../../Style/category.css">

<body>
    <div class="page-container">
        <div class="page-header-section">
            <h1 class="page-title-main"><i class="fas fa-plus-circle"></i> Add New Staff Position</h1>
            <a href="index.php" class="btn-back">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>


        <div class="form-card">
            <div class="form-header">
                <i class="bi bi-pin-fill"></i>
                Staff Details
            </div>

            <form action="../../action/Staff/create.php" method="POST" id="staffForm">
                <div class="form-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">
                                Name <span class="required-mark">*</span>
                            </label>
                            <input type="text" name="name" class="form-input"
                                value=""
                                placeholder="Enter your name" required maxlength="100">
                            <small class="form-text">Must be unique</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Username <span class="required-mark">*</span>
                            </label>
                            <input type="text" name="username" class="form-input"

                                placeholder="Enter staff your username" required maxlength="255">
                            <small class="form-text">Must be unique</small>
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                Password <span class="required-mark">*</span>
                            </label>
                            <input type="text" name="password" class="form-input"

                                placeholder="Enter staff your password" required maxlength="255">
                            <small class="form-text">Must be unique</small>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Position</label>
                            <select name="role" class="form-select"
                                <?= ($res['role'] === 'admin') ? 'disabled' : '' ?>>
                                <?php if ($res['role'] === 'admin'): ?>
                                    <option value="admin" selected>Admin</option>
                                <?php else: ?>
                                    <option value="manager">Manager</option>
                                    <option value="cashier">Casier</option>
                                    <option value="barista">Baristar</option>
                                <?php endif; ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Salary</label>
                            <input type="number" name="salary" class="form-input"
                                placeholder="Enter staff salary" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">
                                Remark
                            </label>
                            <select name="remark" id="" class="select-group">
                                <!-- <option value="" disabled selected>-- Select Remark --</option> -->
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>

                        </div>
                    </div>


                </div>

                <div class="form-footer">
                    <button type="submit" class="btn-save">
                        <i class="bi bi-bookmarks-fill"></i>Save
                    </button>
                    <a href="index.php" class="btn-cancel">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>