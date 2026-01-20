
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</head>
<!-- <?php 
session_start();

// If NOT logged in → redirect
// if (!isset($_SESSION['IsLogin']) || $_SESSION['IsLogin'] !== true) {
//     echo '<script>window.location.href = "view/Login/login.php";</script>';
//     exit;
// }
// ?>-->


<frameset rows="0%,100%" frameborder="0" border="0">
    <frame src="navbar.php" name="sidebar">
    <frameset cols="18%,*">
        <frame src="root/Sidemenu.php" name="menu">
        <frame src="view/Dashboard/index.php" name="content">
    </frameset>
</frameset>

</html>
