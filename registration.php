<?php
require('connection.inc.php');
$msg = " ";
if (isset($_POST['save'])) {
    $name = get_safe_value($con, $_POST['name']);
    $email = get_safe_value($con, $_POST['email']);
    $phone = get_safe_value($con, $_POST['phone']);
    $address = get_safe_value($con, $_POST['address']);
    $password = get_safe_value($con, $_POST['password']);
    $sql = "insert into `user` (`name`, `email`, `phone`, `address`, `password`,`status`) VALUES ('$name', '$email', '$phone', '$address', '$password','1')";
    //$res = mysqli_query($con, $sql);
    //echo $res;
    #$count = mysqli_fetch_assoc($res);

    //$count = mysqli_num_rows($res);
    //echo $count;
    if (mysqli_query($con, $sql)) {
        $msg=urldecode("You Can Login Now");
        header('location:login.php?Message='.$msg);
        die();
    } else {
        $msg = "Enter Detail Correctly";
    }
}
elseif(isset($_POST['back'])){
    header('location:index.php');
}

function get_safe_value($con , $str){
    if($str!=''){
        return(mysqli_real_escape_string($con, $str));
    }
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Registration</title>
    </head>
    <body>
	<h1 style="text-align: center;"><b>Register Youserlf!</b></h1>
        <form method="POST">
            <table style="margin-left: auto; margin-right:auto;border-collapse: separate; border-spacing:10px 15px">
            <tr>
                <td style="width:50%"><label><b>NAME</b></label></td>
                <td style="width: 50%;"><input type="text" name="name" placeholder="Enter Your Name" required></td>   
            </tr>
            <tr>
                <td><label><b>EMAIL</b></label></td>
                <td><input type="text" name="email" placeholder="Enter Your Email ID" required></td>   
            </tr>
            <tr>
                <td><label><b>PHONE</b></label></td>
                <td><input type="text" name="phone" placeholder="Enter Your Phone Number" required></td>   
            </tr>
            <tr>
                <td><label><b>Address</b></label></td>
                <td><textarea name="address" cols="20" rows="4" required></textarea></td>  
            </tr>
            <tr>
                <td><label><b>Password</b></label></td>
                <td><input type="password" name="password" placeholder="Password" required></td>   
            </tr>
            <tr>
                <td><button type="submit" name="back">Back</button></td>
            
                <td><button type="submit" name="save">Save</button></td>
            </tr>
            </table>
        </form>
    </body>
</html>