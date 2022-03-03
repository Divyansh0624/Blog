<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;

    }

    * {
        box-sizing: border-box;
    }

    form {
        background: #f1f1f1;
        border: 3px solid #f1f1f1;
        width: 50%;
        margin-left: auto;
        margin-right: auto;
        height: 80%;
    }

    /* Add padding to containers */
    .container {
        padding: 18px;
        background-color: white;
    }

    /* Full-width input fields */
    input[type=text],
    input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }

    input[type=text]:focus,
    input[type=password]:focus {
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

    p {
        display: inline;
        color: red;
        font-size: 80%;
    }
    </style>
</head>

<body>
    <form method="POST" name="form1" onsubmit="return validation()" action="index.php?action=add-user">
        <!-- <form method="POST" name="form1"> -->
        <div class="container">
            <h1 style="text-align: center;">Register!</h1>
            <h3 style="text-align: center;">Please fill in this form to create an account.
            </h3>
            <hr>
            <label><b>NAME</b>
                <p id="fname"><?php if (isset($nameErr)) echo $nameErr; ?></p>
            </label>
            <input type="text" placeholder="Enter Your Name" name="name" value="" id="uname" required>

            <label><b>EMAIL</b>
                <p id="femail"><?php if (isset($emailErr)) echo $emailErr; ?></p>
            </label>
            <input type="text" placeholder="Enter Email as Username" name="email" value="" required>

            <label><b>PHONE NUMBER</b>
                <p id="fphone"><?php if (isset($phoneErr)) echo $phoneErr; ?></P>
            </label>
            <input type="text" placeholder="Enter Phone Number" name="phone" value="" required>


            <label><b>ADDRESS</b>
                <p id="faddress"><?php if (isset($addressErr)) echo $addressErr; ?></P>
            </label>
            <textarea style="width: 100%;
                    padding: 15px;
                    margin: 5px 0 22px 0;
                    display: inline-block;
                    border: none;
                    background: #f1f1f1;" name="address" rows="4" placeholder="Enter Your Permanent Address"
                required></textarea>


            <label><b>PASSWORD</b>
                <p id="psw"><?php if (isset($passwordErr)) echo $passwordErr; ?>
                <p>
            </label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <hr>
            <button type="submit" class="registerbtn" name="register">Register</button>
        </div>

        <div class="container signin">
            <p>Already have an account? <a href="index.php?action=login">Sign in</a>.</p>
        </div>
    </form>
    <script>
    function clearerror() {
        document.getElementById('fname').innerHTML = "";
        document.getElementById('femail').innerHTML = "";
        document.getElementById('fphone').innerHTML = "";
        document.getElementById('faddress').innerHTML = "";
        document.getElementById('psw').innerHTML = "";
    }

    function seterror(id, error) {
        document.getElementById(id).innerHTML = error;
    }

    function validation() {
        clearerror();
        let validate = true;
        let name = document.forms['form1']['name'].value;
        if (name.length < 4) {
            seterror('fname', 'Invalid name');
            validate = false;
        }
        let email = document.forms['form1']['email'].value;
        if (email.length < 10) {
            seterror('femail', 'Invalid email');
            validate = false;
        }
        let phone = document.forms['form1']['phone'].value;
        if (phone.length != 10) {
            seterror('fphone', 'Invalid phone number');
            validate = false;
        }
        let address = document.forms['form1']['address'].value;
        if (address.length < 10) {
            seterror('faddress', 'Invalid Address');
            validate = false;
        }
        let password = document.forms['form1']['password'].value;
        if (password.length < 8) {
            seterror('psw', 'Required minimum 8 characters');
            validate = false;
        }
        return validate;
    }
    </script>
</body>

</html>