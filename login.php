<?php
require('connection.inc.php');
$msg = " ";
if (isset($_POST['submit'])) {
    $username = get_safe_value($con, $_POST['name']);
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
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {
    border: 3px solid #f1f1f1;
    width: 50%;
    margin-left: auto;
    margin-right: auto;
    height:80%;
}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}


.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>
<div style="text-align: center;"><?php if(isset($_GET['Message'])){
        echo $_GET['Message'];
    }?></div>
<h2 style="text-align: center;"> Login Form</h2>
<form method="post">
  <div class="container">
    <label ><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="name" required>

    <label ><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
        
    <button type="submit" name="submit">Login</button>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="submit" class="cancelbtn" name="back">Cancel</button>
    <span class="psw"><a href="index.php">Back?</a></span>
  </div>
</form>

</body>
</html>
