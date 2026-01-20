<?php
    $con = new mysqli('localhost','root','','coffee_btg');
    if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>