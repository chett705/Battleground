<?php include '../../root/header.php';
include '../../Config/connect.php';

$sql = "SELECT * FROM inventory ORDER BY qty ASC";
$result = mysqli_query($con, $sql);
?>

<body>
    <h1>inventory report</h1>
    
    

</body>