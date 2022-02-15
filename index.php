<?php
if(isset($_POST['login'])){
    header('location:login.php');
}
elseif(isset($_POST['register'])){
    header('location:registration.php');
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>BLOG WEBSITE</title>
    </head>
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
    </style>
    <body>
    <form method="POST">
        <h1 style="text-align: center;"><b>Welcome</b></h1>
        <h3 style="text-align: center;">Want to login or Register</h3>
        <table style="margin-left: auto; margin-right:auto;">
            <tr>
            <td><button type="submit" name="login">LogIn</button></td>
            <td><button type="submit" name="register">Register</button></td>
            </tr>
        </table>
    </form>
    </body>
</html>