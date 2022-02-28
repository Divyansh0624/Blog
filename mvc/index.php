<?php
$action = $_GET['action'] ?? $_POST['action'] ?? 'home';
if ($action == 'user') {
    include_once "models/user.php";
    $users = new user();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $result = $users->getuserbyid($username, $password);
    if ($result) {
        include_once 'views/blog.php';
    }
} elseif ($action == 'blog-all') {
    if (isset($_POST['submit'])) {
        $username = $_POST['name'];
        $password =  $_POST['password'];
        include_once 'models/user.php';
        $user_login = new user();
        $rows = $user_login->getuserbyemail($username);
        if (!empty($rows)) {
            $cnt = 0;
            foreach ($rows as $row) {
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
                    include_once "models/blog.php";
                    $blog = new blog();
                    $blog_list = $blog->getallblog();
                    require_once 'views/blog.php';
                }
            }
            if ($cnt === 0) {
                $msg = "Password is Incorrect";
            }
        } else {
            $msg = "Please Enter Correct login details <br> If you are new than Register Yourself First!";
        }
    }
} elseif ($action == 'registration') {
    require_once 'views/registration.php';
} elseif ($action == 'add-user') {
    $msg = "";
    $name = "";
    $email = "";
    $phone = "";
    $address = "";
    $password = "";
    $nameErr = $emailErr = $phoneErr = $addressErr = $passwordErr = "";
    if (isset($_POST['register'])) {
        #Name Validation
        if (empty($_POST["name"])) {
            $nameErr = "Name is required.<br/>";
        } else {
            if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["name"])) {
                $nameErr = "Only letters and white space allowed.<br/>";
            } else {
                $name =  $_POST["name"];
            }
        }
        #Email Validation
        if (empty($_POST["email"])) {
            $emailErr = "Email is required.<br/>";
        } else {
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format.<br/>";
            } else {
                $email = $_POST["email"];
            }
        }
        #Phone Number Validation
        if (empty($_POST["phone"])) {
            $phoneErr = "Phone Number is required.<br/>";
        } else {
            if (!preg_match('/^[0-9]{10}+$/', $_POST["phone"])) {
                $phoneErr = "Invalid Phone Number.<br/>";
            } else {
                $phone =  $_POST["phone"];
            }
        }
        #Address Validaion
        if (empty($_POST["address"])) {
            $addressErr = "Address is required.<br/>";
        } else {
            $address = $_POST["address"];
        }
        #password validation
        if (empty($_POST["password"])) {
            $phoneErr = "Password is required.<br/>";
        } else {
            if (strlen($_POST["password"]) <= '8') {
                $passwordErr = "Your Password Must Contain At Least 8 Characters!.<br/>";
            } elseif (!preg_match("#[0-9]+#", $_POST["password"])) {
                $passwordErr = "Your Password Must Contain At Least 1 Number!.<br/>";
            } elseif (!preg_match("#[A-Z]+#", $_POST["password"])) {
                $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!.<br/>";
            } elseif (!preg_match("#[a-z]+#", $_POST["password"])) {
                $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!.<br/>";
            } else {
                //$password = get_safe_value($con , $_POST['password']);
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }
        }

        if ($nameErr == '' && $emailErr == '' && $phoneErr == '' && $addressErr == '' && $passwordErr == '') {
            include_once 'models/user.php';
            $user = new user();
            $id = $user->adduser($name, $email, $phone, $address, $password);
            if (!empty($id)) {
                require_once 'views/login.php';
            }
        }
    }
} elseif ($action == 'login') {
    require_once 'views/login.php';
} elseif ($action == 'add-user') {
    if (isset($_POST['save'])) {
    }
} else {
    if (isset($_POST['login'])) {
        require_once 'views/login.php';
        if (isset($_POST['submit'])) {
        }
    } elseif (isset($_POST['register'])) {
        require_once 'views/registration.php';
    } else {
        require_once 'views/home.php';
    }
}