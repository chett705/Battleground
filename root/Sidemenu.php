<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Sidebar</title>

  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans&family=Noto+Sans+Khmer&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <link rel="stylesheet" href="Style/sidemenu.css">
</head>


<body>
    <div class="menu d-flex flex-column text-dark bg-light vh-100 h-100 ">
        <div class="brand-logo d-flex align-items-center px-3 mb-3">
            <!-- <img src="../view/assets/logo.png" alt="Logo" class="me-2"> -->
            <div class="brand-text">
                <div class="brand-name">Cafe Admin</div>
                <div class="brand-sub">Manager</div>
            </div>
        </div>

        

        <!-- Menu -->
        <ul class="list-unstyled components">
                <li>
                    <a href="../view/Dashboard/index.php" target="content">
                        <i class="fa fa-home"></i>Dashboard
                    </a>
                </li>

                <!-- Setting -->
                <li>
                    <a  href="../view/Order/index.php" target="content">
                        <i class="fa fa-receipt"></i><span lang="km">Order</span>
                    </a>
                    <!-- <ul class="collapse list-unstyled" id="Order">
                        <li >
                            <a target="content">Order</a>
                        </li>
                       
                        <li>
                            <a href="../view/Order/view.php" target="content">Views</a>
                        </li>
                      
                    </ul> -->
                    
                </li>

                <!-- Product -->
                <li>
                    <a href="../view/inventory/index.php"  target="content">     
                        <i class="fa fa-warehouse"></i><span lang="km">Inventory</span>
                    </a>

                    
                </li>

                <!-- POS -->
                <li>
                    <a href="../view/Category/index.php" target="content">
                        <i class="fa fa-utensils"></i><span lang="km">Category</span>
                    </a>
                    
                </li>
                <li>
                    <a href="../view/Menu/index.php" target="content">
                        <i class="fa fa-utensils"></i><span lang="km">Menu</span>
                    </a>
                    
                </li>

                <!-- Customer -->
                <li>
                    <a href="../view/Staff/index.php" target="content">
                        <i class="fa fa-user-tie"></i><span lang="km">Staff Management</span>
                    </a>
                   
                </li>

                <!-- Report -->
                <li>
                    <a href="#Report" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fa fa-chart-line"></i><span lang="km">Report</span>
                    </a>
                    <ul class="collapse list-unstyled" id="Report">
                        <li >
                            <a href="../view/PROvertime/index.php" target="content">Overtime</a>
                        </li>
                       
                        <li>
                            <a href="../view/PRPayDetail/paydetail.php" target="content">Pay Detail</a>
                        </li>
                      
                    </ul>
                </li>


               

        </ul>

        <div class="menu-footer mt-auto px-3">
            <div class="user d-flex align-items-center py-3">
                <!-- <img src="../view/assets/avatar.png" alt="User" class="avatar me-2"> -->
                <div>
                    <div class="user-name">Admin User</div>
                    <div class="user-role">Manager</div>
                </div>
                <div>
                    <a href="" class=" ms-3"><i class="bi bi-arrow-right-circle-fill"></i></a>
                </div>
            </div>
           
        </div>
    </div>

    <!-- Small script: handle active menu highlighting -->
    <script>
      document.querySelectorAll('.menu ul.components a').forEach(function(el){
        el.addEventListener('click', function(){
          document.querySelectorAll('.menu ul.components li').forEach(function(li){ li.classList.remove('active'); });
          this.parentElement.classList.add('active');
        });
      });
    </script>    
</body>

</html>