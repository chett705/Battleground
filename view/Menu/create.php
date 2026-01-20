<?php include '../../root/header.php';
include '../../Config/connect.php';
$sql = "SELECT * FROM categories WHERE status='active'";
$result = mysqli_query($con, $sql);





?>

<div class="p-3">
  <h5 class="mb-3">Add New Menu Item</h5>

  <form id="createForm"
    action="../../action/Menu/create.php"
    method="POST"
    enctype="multipart/form-data">

    <div class="w-50 mx-auto">
      <div class="card p-4 text-start">

        <!-- IMAGE PREVIEW -->
        <img id="previewImage"
          class="img-fluid mb-3 "
          src="https://via.placeholder.com/240" style="width:20%;object-fit:cover;">

        <!-- IMAGE INPUT -->
        <input type="file"
          name="image"
          class="form-control mb-3"
          accept="image/*"
          onchange="preview(this)">

        <!-- NAME -->
        <label class="form-label small">Name</label>
        <input class="form-control mb-2"
          name="item_name"
          required>

        <!-- DESCRIPTION -->
        <label class="form-label small">Description</label>
        <textarea class="form-control mb-3"
          name="description"></textarea>

        <div class="row">
          <!-- CATEGORY -->
          <div class="col-6">
            <label class="form-label small">Category</label>
            <select id="editCategory" name="category_id" class="form-select">
              <?php foreach ($result as $cat): ?>
                <option value="<?= $cat['category_id']; ?>"
                  <?= ($cat['category_id'])  ?>>
                  <?= htmlspecialchars($cat['category_name']); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- PRICE -->
          <div class="col-6">
            <label class="form-label small">Price ($)</label>
            <input type="number"
             
              name="price"
              class="form-control"
              required>
          </div>
          <div class="col-4">
            <label class="form-label small">Qty</label>
            <input type="number"

              name="Qty"
              class="form-control"
              required>
          </div>
        </div>

        <!-- STATUS -->
        <div class="col-6 mt-3">
          <label class="form-label small">Status</label>
          <select name="status" class="form-select">
            <option value="available">Available</option>
            <option value="sold_out">Sold Out</option>
          </select>
        </div>

        <!-- ACTIONS -->
        <div class="d-flex gap-2 mt-4">
          <a href="index.php" class="btn btn-secondary">Cancel</a>
          <button type="submit" class="btn btn-success">Add</button>
        </div>

      </div>
    </div>
  </form>
</div>

<script>
  function preview(input) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = e => {
        document.getElementById('previewImage').src = e.target.result;
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
</script>