<?php
require('connection.inc.php');
$username = $_SESSION['USER_USERNAME'];
$sql = "update `user` set status = '0' where email = '$username'";
mysqli_query($con, $sql);
$data = "";
if (isset($_GET['Message'])) {
    $data = $_GET['Message'];
}
session_unset();
session_destroy();
header('location:login.php?Message=' . $data);