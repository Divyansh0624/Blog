<?php
require('connection.inc.php');
if (isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN'] != '') {
    $data = $_SESSION['USER_USERNAME'];
    $sql = "select * from `user` where email='$data' ";
    $res = mysqli_fetch_assoc(mysqli_query($con, $sql));
    $oldEmail = $res['email'];
    if (isset($_POST['save'])) {
        $id = $res['id'];
        $name = get_safe_value($con, $_POST['name']);
        $email = get_safe_value($con, $_POST['email']);
        $phone = get_safe_value($con, $_POST['phone']);
        $address = get_safe_value($con, $_POST['address']);
        $query = "update user set name = '$name',phone = '$phone',email = '$email',address = '$address' where id =$id";
        mysqli_query($con, $query);
        if ($email != $oldEmail) {
            $msg = urldecode("Login Again With New Email");
            header('location:logout.php?Message=' . $msg);
        } else {
            $msg = urldecode("Profile Updated Successfully");
            header('location:profile.php?Message=' . $msg);
        }
    } elseif (isset($_POST['cancel'])) {
        header('location:blog.php');
    }
} else {
    header('location:login.php');
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
    <title>Profile Management</title>
    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;

    }

    form {
        border: 3px solid #f1f1f1;
        width: 50%;
        margin-left: auto;
        margin-right: auto;
        height: 70%;
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
    <h2 style="text-align: center;">Personal Details!</h2>
    <h3 style="text-align: center;color:#04AA6D">
        <?php if (isset($_GET['Message'])) {
            echo $_GET['Message'];
        } ?></h3>
    <form method="post">
        <div class="container">
            <label><b>Name</b></label>
            <input type="text" name="name" value="<?php echo $res['name'] ?>" required>

            <label><b>Email</b></label>
            <input type="text" name="email" value="<?php echo $res['email'] ?>" required>

            <label><b>Phone</b></label>
            <input type="text" name="phone" value="<?php echo $res['phone'] ?>" required>

            <label><b>Address</b></label>
            <textarea name="address" rows="3" style="width:100% ;" required><?php echo $res['address'] ?></textarea>

            <button type="submit" name="save" style="background-color: #04AA6D;">Save</button>
            <button type="submit" name="cancel" style="background-color:#f44336">Cancel</button>
        </div>
    </form>

</body>

</html>