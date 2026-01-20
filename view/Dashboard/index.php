<?php
include '../../Config/connect.php';

/* ===== DASHBOARD COUNTS ===== */

// Orders count
$orderCount = mysqli_fetch_assoc(
    mysqli_query($con, "SELECT COUNT(*) AS total FROM orders")
)['total'] ?? 0;

// Revenue sum
$revenue = mysqli_fetch_assoc(
    mysqli_query($con, "SELECT SUM(total_price) AS total FROM orders ")
)['total'] ?? 0;

// Menu items count
$menuCount = mysqli_fetch_assoc(
    mysqli_query($con, "SELECT COUNT(*) AS total FROM menu_items")
)['total'] ?? 0;

// Employees count
$staff = mysqli_fetch_assoc(
  mysqli_query($con, "SELECT COUNT(*) total FROM staff WHERE status='active'")
)['total'];
  

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../root/Style/sidemenu.css">
  <link rel="stylesheet" href="dashboard.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.umd.min.js"></script>
</head>
<body class="p-4 bg-white">
  <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3 class="mb-0">Dashboard</h3>
      <div>
        <button class="btn btn-outline-secondary btn-sm me-2">Export</button>
        <button class="btn btn-primary btn-sm">New Report</button>
      </div>
    </div>

    <div class="row g-3">
      <div class="col-md-3">
        <div class="card summary-card p-3">
          <div class="d-flex align-items-center">
            <div class="summary-icon bg-primary text-white me-3"><i class="fa fa-shopping-cart"></i></div>
            <div>
              <div class="small text-muted">Orders</div>
              <div class="h5 mb-0"><?= number_format($orderCount) ?></div>

            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card summary-card p-3">
          <div class="d-flex align-items-center">
            <div class="summary-icon bg-success text-white me-3"><i class="fa fa-dollar-sign"></i></div>
            <div>
              <div class="small text-muted">Revenue</div>
              <div class="h5 mb-0">$<?= number_format($revenue, 2) ?></div>

            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card summary-card p-3">
          <div class="d-flex align-items-center">
            <div class="summary-icon bg-warning text-white me-3"><i class="fa fa-boxes"></i></div>
            <div>
              <div class="small text-muted">Menu Items</div>
              <div class="h5 mb-0"><?= $menuCount ?></div>

            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card summary-card p-3">
          <div class="d-flex align-items-center">
            <div class="summary-icon bg-info text-white me-3"><i class="fa fa-users"></i></div>
            <div>
              <div class="small text-muted">Employees</div>
             <div class="h5 mb-0"><?= $staff  ?></div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-4 g-3">
      <div class="col-lg-8">
        <div class="card p-3">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <strong>Sales (Last 7 days)</strong>
            <div class="small text-muted">Overview</div>
          </div>
          <canvas id="salesChart" height="120"></canvas>
        </div>

        <div class="card p-3 mt-3">
          <strong>Recent Orders</strong>
          <div class="table-responsive mt-2">
            <table class="table table-borderless table-hover align-middle">
              <thead>
                <tr class="text-muted small">
                  <th>Order</th>
                  <th>Customer</th>
                  <th>Status</th>
                  <th class="text-end">Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>#1023</td>
                  <td>Jane Doe</td>
                  <td><span class="badge bg-success">Completed</span></td>
                  <td class="text-end">$8.50</td>
                </tr>
                <tr>
                  <td>#1022</td>
                  <td>John Smith</td>
                  <td><span class="badge bg-warning text-dark">Preparing</span></td>
                  <td class="text-end">$5.00</td>
                </tr>
                <tr>
                  <td>#1021</td>
                  <td>Claire</td>
                  <td><span class="badge bg-danger">Cancelled</span></td>
                  <td class="text-end">$0.00</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card p-3">
          <strong>Top Items</strong>
          <ul class="list-unstyled mt-2">
            <li class="d-flex justify-content-between align-items-center py-2 border-bottom">
              <div>Iced Latte</div>
              <div class="text-muted small">120</div>
            </li>
            <li class="d-flex justify-content-between align-items-center py-2 border-bottom">
              <div>Butter Croissant</div>
              <div class="text-muted small">94</div>
            </li>
            <li class="d-flex justify-content-between align-items-center py-2">
              <div>Cappuccino</div>
              <div class="text-muted small">88</div>
            </li>
          </ul>
        </div>

        <div class="card p-3 mt-3">
          <strong>Shortcuts</strong>
          <div class="d-grid gap-2 mt-2">
            <a class="btn btn-outline-primary btn-sm" href="../Menu/index.php" target="content">Manage Menu</a>
            <!-- <a class="btn btn-outline-secondary btn-sm" href="../POS/index.php" target="content">Open POS</a> -->
            <a class="btn btn-outline-success btn-sm" href="../Inventory/index.php" target="content">Manage Inventory</a>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>
// Chart data (static sample)
const ctx = document.getElementById('salesChart');
if (ctx) {
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
      datasets: [{
        label: 'Sales',
        data: [120, 200, 150, 220, 180, 240, 200],
        borderColor: '#16c784',
        backgroundColor: 'rgba(22,199,132,0.15)',
        tension: 0.35,
        fill: true,
      }]
    },
    options: {
      plugins: { legend: { display: false } },
      scales: { y: { beginAtZero: true } }
    }
  });
}
</script>
</body>
</html>
