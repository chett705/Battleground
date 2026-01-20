<?php
include '../../Config/connect.php';
include '../../root/header.php';
$sql = "SELECT * FROM orders ORDER BY created_at DESC";
$result = mysqli_query($con, $sql);
?>

<h4 class="mb-3">Order Management</h4>

<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Total</th>
      <th>Payment</th>
      <th>Status</th>
      <th>Date</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php while($o = mysqli_fetch_assoc($result)): ?>
    <tr>
      <td><?= $o['order_id'] ?></td>
      <td>$<?= number_format($o['total_price'], 2) ?></td>
      <td><?= strtoupper($o['payment_method']) ?></td>
      <td>
        <span class="badge bg-<?=
          $o['order_status']=='completed'?'success':
          ($o['order_status']=='pending'?'warning':'secondary')
        ?>">
          <?= ucfirst($o['order_status']) ?>
        </span>
      </td>
      <td><?= $o['created_at'] ?></td>
      <td>
        <a href="view.php?id=<?= $o['order_id'] ?>" class="btn btn-sm btn-primary">
          View
        </a>
      </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>
