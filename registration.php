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
elseif(isset($_POST['signin'])){
    header('location:index.php');
}

function get_safe_value($con , $str){
    if($str!=''){
        return(mysqli_real_escape_string($con, $str));
    }
}
?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registration</title>
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: black;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
</head>
<body>

<form method="POST">
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
    <label><b>NAME</b></label>
    <input type="text" placeholder="Enter Your Name" name="name" id="email" required>

    <label><b>EMAIL</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>

    <label><b>PHONE NUMBER</b></label>
    <input type="text" placeholder="Enter Phone Number" name="phone" id="email" required>

    <label><b>ADDRESS</b></label>
    <textarea style="width: 100%;
                    padding: 15px;
                    margin: 5px 0 22px 0;
                    display: inline-block;
                    border: none;
                    background: #f1f1f1;" name="address" cols="20" rows="4" placeholder="Enter Your Permanet Address" id= "psw" required></textarea>

    <label><b>PASSWORD</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="psw" required>

    <hr>
    <button type="submit" class="registerbtn" name = "save">Register</button>
  </div>
  
  <div class="container signin">
    <p>Already have an account? <a href="login.php">Sign in</a>.</p>
  </div>
</form>

</body>
</html>