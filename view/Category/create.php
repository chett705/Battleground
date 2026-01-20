<?php include '../../root/header.php'; ?>
<link rel="stylesheet" href="../../Style/category.css">
<body>
    <div class="page-container">
        <div class="page-header-section">
            <h1 class="page-title-main"><i class="fas fa-plus-circle"></i> Add New Categories</h1>
            <a href="index.php" class="btn-back">
                <i class="fas fa-arrow-left"></i> Back 
            </a>
        </div>

       
        <div class="form-card">
            <div class="form-header">
                <i class="bi bi-pin-fill"></i>
                Category Details
            </div>

            <form action="../../action/Category/create.php" method="POST" id="categoryForm">
                <div class="form-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">
                                Name <span class="required-mark">*</span>
                            </label>
                            <input type="text" name="category_name" class="form-input" 
                                   value=""
                                   placeholder="Enter category name" required maxlength="100">
                            <small class="form-text">Must be unique</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Description <span class="required-mark">*</span>
                            </label>
                            <input type="text" name="description" class="form-input" 
                                  
                                   placeholder="Enter category description" required maxlength="255">
                            <small class="form-text">Must be unique</small>
                        </div>
                       <div class="form-group">
                            <label class="form-label">
                                Remark
                            </label>
                            <select name="status" id="" class="select-group">
                                <!-- <option value="" disabled selected>-- Select Remark --</option> -->
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
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