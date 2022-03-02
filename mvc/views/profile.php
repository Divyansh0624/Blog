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
        background: #f1f1f2;
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
    <form method="post" style="background:#f1f1f1" action="index.php?action=Profile">
        <h2 style="text-align: center;color:blue">Personal Details!</h2>
        <h3 style="text-align: center;color:#04AA6D">
            <?php if (isset($_GET['Message'])) {
                echo $_GET['Message'];
            } ?></h3>
        <div class="container">
            <label><b>Name</b></label>
            <input type="text" name="name" value="<?php echo $current_user[0]['name'] ?>" required>

            <label><b>Email</b></label>
            <input type="text" name="email" value="<?php echo $current_user[0]['email'] ?>" required>

            <label><b>Phone</b></label>
            <input type="text" name="phone" value="<?php echo $current_user[0]['phone'] ?>" required>

            <label><b>Address</b></label>
            <textarea name="address" rows="3"
                style="width:95%;font-family:Arial, Helvetica, sans-serif;padding:15px;font-size:15px;background:#f1f1f2;margin:10px 0 22px 0"
                required><?php echo $current_user[0]['address'] ?></textarea>

            <button type="submit" name="save" style="background-color: #04AA6D;">Save</button>
            <button type="submit" name="cancel" style="background-color:#f44336">Cancel</button>
        </div>
    </form>
</body>

</html>