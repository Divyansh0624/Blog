<?php
require('connection.inc.php');
$msg = " ";
if (isset($_POST['submit'])) {
    $username = get_safe_value($con, $_POST['username']);
    $password = get_safe_value($con, $_POST['password']);
    $sql = "select * from `user` where email = '$username' and password = '$password'";
    $res = mysqli_query($con, $sql);
    $count = mysqli_num_rows($res);
    //$rows = mysqli_fetch_assoc($res);
    if ($count > 0 ) {
        $_SESSION['USER_LOGIN'] = 'yes';
        $_SESSION['USER_USERNAME'] = $username;
        header('location:blog.php');
        die();
    } else {
        $msg = "Please Enter Correct login details Or Register Yourself First";
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
        <title>
            LOGIN 
        </title>
    </head>
    <body>
	<h1 style="text-align: center;"><b>LOGIN!</b></h1>
    <div style="text-align: center;"><?php if(isset($_GET['Message'])){
        echo $_GET['Message'];
    }?></div>
    <form method="POST">
        <table style="margin-left: auto; margin-right:auto;border-collapse: separate; border-spacing:15px 15px">
            <tr>
                <td><label><b>Username</b></label></td>
                <td><input type="text" name="username" placeholder="Email" required></td>   
            </tr>
            <tr>
                <td><label><b>Password</b></label></td>
                <td><input type="password" name="password" placeholder="Password" required></td>
            </tr>
            <tr>
                <td><button type="submit" name="back">Back</button></td>
                
                <td><button type="submit" name="submit" data-theme="b">LogIn</button></td>
            </tr>
        </table>
    </form>
    <div style="text-align:center;"><?php echo $msg ?></div>

    </body>
</html>