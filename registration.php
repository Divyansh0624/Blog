<?php
require('connection.inc.php');
$msg = "";
$name="";
$email="";
$phone="";
$address="";
$password="";
$nameErr=$emailErr=$phoneErr=$addressErr=$passwordErr="";
if (isset($_POST['save'])) {
    #Name Validation
    if (empty($_POST["name"])) {
        $nameErr = "Name is required.<br/>";
    } else {
        if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["name"])) {
            $nameErr = "Only letters and white space allowed.<br/>";
        }else{
        $name = get_safe_value($con,$_POST["name"]);
        }
    }
    #Email Validation
    if (empty($_POST["email"])) {
        $emailErr = "Email is required.<br/>";
    } else {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format.<br/>";
          }else{
            $email = get_safe_value($con,$_POST["email"]);
            if(mysqli_num_rows(mysqli_query($con , "select * from user where email = '$email'"))>0){
                $emailErr = "Email Already Present.<br/>";
            }
          }
    }
    #Phone Number Validation
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone Number is required.<br/>";
    } else {
        if(!preg_match('/^[0-9]{10}+$/', $_POST["phone"])){
            $phoneErr = "Invalid Phone Number.<br/>";
        }else{
        $phone = get_safe_value($con,$_POST["phone"]);
        }
    }
    #Address Validaion
    if (empty($_POST["address"])) {
        $addressErr = "Address is required.<br/>";
    } else {
        $address = get_safe_value($con,$_POST["address"]);
    }
    #password validation
    if (empty($_POST["password"])) {
        $phoneErr = "Password is required.<br/>";
    } else {
        if (strlen($_POST["password"]) <= '8') {
            $passwordErr = "Your Password Must Contain At Least 8 Characters!.<br/>";
        }
        elseif(!preg_match("#[0-9]+#",$_POST["password"])) {
            $passwordErr = "Your Password Must Contain At Least 1 Number!.<br/>";
        }
        elseif(!preg_match("#[A-Z]+#",$_POST["password"])) {
            $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!.<br/>";
        }
        elseif(!preg_match("#[a-z]+#",$_POST["password"])) {
            $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!.<br/>";
        }
        elseif(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["password"])) {
            $passwordErr = "Your Password Must Contain At Least 1 Special Character!.<br/>";
        }
        else{
            //$password = get_safe_value($con , $_POST['password']);
            $password  = password_hash($_POST['password'],PASSWORD_DEFAULT);
        }
    }
    if($nameErr==''&& $emailErr==''&& $phoneErr==''&& $addressErr==''&& $passwordErr==''){
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
        }
    }
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
p{
    display:inline; 
    color:red; 
    font-size:80%;
}
</style>
</head>
<body>

<form method="POST">
  <div class="container">
    <h1 style="text-align: center;">Register!</h1>
    <h3 style="text-align: center;">Please fill in this form to create an account.</h3>
    <hr>
    <label><b>NAME</b><p><?php echo $nameErr; ?></p></label>
    <input type="text" placeholder="Enter Your Name" name="name" id="email" value="<?php echo $name ?>" required>
    
    <label><b>EMAIL</b><p><?php echo $emailErr; ?></p></label>
    <input type="text" placeholder="Enter Email as Username" name="email" id="email" value="<?php echo $email ?>" required>

    <label><b>PHONE NUMBER</b><p><?php echo $phoneErr; ?></P></label>
    <input type="text" placeholder="Enter Phone Number" name="phone" id="email" value="<?php echo $phone ?>" required>
    

    <label><b>ADDRESS</b><p><?php echo $addressErr; ?></P></label>
    <textarea style="width: 100%;
                    padding: 15px;
                    margin: 5px 0 22px 0;
                    display: inline-block;
                    border: none;
                    background: #f1f1f1;" name="address" rows="4" placeholder="Enter Your Permanent Address" id= "psw"required></textarea>
    

    <label><b>PASSWORD</b><p ><?php echo $passwordErr;?><p></label>
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