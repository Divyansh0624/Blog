<?php
require('connection.inc.php');
$msg = " ";
$username = "";
$password = "";
if (isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN'] != '') {
    header('location:blog.php');
}
if (isset($_POST['submit'])) {
    $username = get_safe_value($con, $_POST['name']);
    $password = get_safe_value($con, $_POST['password']);
    $sql = "select * from `user` where email = '$username'";
    $res = mysqli_query($con, $sql);
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        $cnt = 0;
        while ($row = mysqli_fetch_assoc($res)) {
            if (password_verify($password, $row['password'])) {
                $cnt = 1;
                $_SESSION['USER_LOGIN'] = 'yes';
                $_SESSION['USER_USERNAME'] = $username;
                if (isset($_POST['remember'])) {
                    setcookie("username", $username, time() + 1 * 60 * 60);
                } else {
                    if (isset($_COOKIE['username'])) {
                        setcookie("username", "");
                    }
                }
                $sql = "update `user` set status = '1' where email = '$username'";
                mysqli_query($con, $sql);
                header('location:blog.php');
                die();
            }
        }
        if ($cnt === 0) {
            $msg = "Password is Incorrect";
        }
    } else {
        $msg = "Please Enter Correct login details <br> If you are new than Register Yourself First!";
    }
} elseif (isset($_POST['back'])) {
    header('location:index.php');
}
function get_safe_value($con, $str)
{
    if ($str != '') {
        return (mysqli_real_escape_string($con, $str));
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }

    form {
        background: #f1f1f1;
        border: 3px solid #f1f1f1;
        width: 50%;
        margin-left: auto;
        margin-right: auto;
        height: 80%;
    }

    input[type=text],
    input[type=password] {
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
        padding-left: 100px;
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

<body style="background-image: url('image/blog.jpg');">
    <form method="post">
        <div style="text-align: center;color:#04AA6D"><?php if (isset($_GET['Message'])) {
                                                            echo $_GET['Message'];
                                                        } ?></div>
        <h2 style="text-align: center;">Welcome Back!</h2>
        <div class="container">
            <label><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="name" value="<?php if (isset($_COOKIE['username'])) {
                                                                                    echo $_COOKIE['username'];
                                                                                } ?>" required>

            <label><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" value="<?php echo $password; ?>"
                required>

            <button type="submit" name="submit">Login</button>
            <div style="text-align: center; color:#f44336"><?php echo $msg; ?></div>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <!-- <button type="submit" class="cancelbtn" name="back">Cancel</button> -->
            <input type="checkbox" name="remember" <?php if (isset($_COOKIE['username'])) { ?> checked <?php } ?> />
            <label>Remember Me</label>
            <span style="padding-left: 15%;">Register Yourself ? <a href="registration.php"
                    style="text-decoration: none;">sign up</a></span>
            <span class="psw"><a href="index.php">Back?</a></span>
        </div>
    </form>
</body>

</html>