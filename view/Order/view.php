<?php
include '../../Config/connect.php';
include '../../root/header.php';
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Invalid Order ID');
}

$order_id = (int)$_GET['id'];

$order = mysqli_query($con, "SELECT * FROM orders WHERE order_id = $order_id");
$orderData = mysqli_fetch_assoc($order);

if (!$orderData) {
    die('Order not found');
}

$items = mysqli_query($con, "
    SELECT oi.*, m.item_name
    FROM order_items oi
    JOIN menu_items m ON oi.item_id = m.item_id
    WHERE oi.order_id = $order_id
");
?>


<h5>Order #<?= $order_id ?></h5>

<table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>Item</th>
            <th class="text-center">Qty</th>
            <th class="text-end">Price</th>
            <th class="text-end">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $grandTotal = 0;
        while ($row = mysqli_fetch_assoc($items)):
            $total = $row['quantity'] * $row['price'];
            $grandTotal += $total;
        ?>
        <tr>
            <td><?= htmlspecialchars($row['item_name']) ?></td>
            <td class="text-center"><?= $row['quantity'] ?></td>
            <td class="text-end">$<?= number_format($row['price'], 2) ?></td>
            <td class="text-end">$<?= number_format($total, 2) ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3" class="text-end">Grand Total</th>
            <th class="text-end">$<?= number_format($grandTotal, 2) ?></th>
        </tr>
    </tfoot>
</table>
