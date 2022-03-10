<?php
session_start();
$action = $_GET['action'] ?? $_POST['action'] ?? 'home';
if ($action == 'UserList') {
    if (isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN'] != '') {
        include_once 'models/user.php';
        $user = new user();
        $rows = $user->getalluser();
        require_once 'views/list.php';
    } else {
        require_once 'views/login.php';
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
                    // include_once 'models/user.php';
                    // $user = new user();
                    // $user->updateuserstatus(true, $username);
                    if (isset($_POST['remember'])) {
                        setcookie("username", $username, time() + 1 * 60 * 60);
                    } else {
                        if (isset($_COOKIE['username'])) {
                            setcookie("username", "");
                        }
                    }
                }
            }
            if ($cnt === 0) {
                $msg = "Password is Incorrect";
                header('location:index.php?action=login&Message=' . $msg);
            } else {
                include_once "models/blog.php";
                $blog = new blog();
                $blog_list = $blog->getallblog();
                if (!empty($blog_list)) {
                    require_once 'views/blog.php';
                }
            }
        } else {
            $msg = "Please Enter Correct login details <br> If you are new than Register Yourself First!";
            header('location:index.php?action=login&Message=' . $msg);
        }
    } elseif (isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN'] != '') {
        include_once "models/blog.php";
        $blog = new blog();
        $blog_list = $blog->getallblog();
        require_once 'views/blog.php';
    } else {
        require_once 'views/login.php';
    }
} elseif ($action == 'registration') {
    require_once 'views/registration.php';
} elseif ($action == 'add-user') {
    // $msg = "";
    // $name = "";
    // $email = "";
    // $phone = "";
    // $address = "";
    // $password = "";
    // $nameErr = $emailErr = $phoneErr = $addressErr = $passwordErr = "";
    // if (isset($_POST['register'])) {
    //     #Name Validation
    //     if (empty($_POST["name"])) {
    //         $nameErr = "Name is required.<br/>";
    //     } else {
    //         if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["name"])) {
    //             $nameErr = "Only letters and white space allowed.<br/>";
    //         } else {
    //             $name =  $_POST["name"];
    //         }
    //     }
    //     #Email Validation
    //     if (empty($_POST["email"])) {
    //         $emailErr = "Email is required.<br/>";
    //     } else {
    //         if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    //             $emailErr = "Invalid email format.<br/>";
    //         } else {
    //             $email = $_POST["email"];
    //         }
    //     }
    //     #Phone Number Validation
    //     if (empty($_POST["phone"])) {
    //         $phoneErr = "Phone Number is required.<br/>";
    //     } else {
    //         if (!preg_match('/^[0-9]{10}+$/', $_POST["phone"])) {
    //             $phoneErr = "Invalid Phone Number.<br/>";
    //         } else {
    //             $phone =  $_POST["phone"];
    //         }
    //     }
    //     #Address Validaion
    //     if (empty($_POST["address"])) {
    //         $addressErr = "Address is required.<br/>";
    //     } else {
    //         $address = $_POST["address"];
    //     }
    //     #password validation
    //     if (empty($_POST["password"])) {
    //         $phoneErr = "Password is required.<br/>";
    //     } else {
    //         if (strlen($_POST["password"]) <= '8') {
    //             $passwordErr = "Your Password Must Contain At Least 8 Characters!.<br/>";
    //         } elseif (!preg_match("#[0-9]+#", $_POST["password"])) {
    //             $passwordErr = "Your Password Must Contain At Least 1 Number!.<br/>";
    //         } elseif (!preg_match("#[A-Z]+#", $_POST["password"])) {
    //             $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!.<br/>";
    //         } elseif (!preg_match("#[a-z]+#", $_POST["password"])) {
    //             $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!.<br/>";
    //         } else {
    //             //$password = get_safe_value($con , $_POST['password']);
    //             $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    //         }
    //     }

    //     if ($nameErr == '' && $emailErr == '' && $phoneErr == '' && $addressErr == '' && $passwordErr == '') {
    //         include_once 'models/user.php';
    //         $user = new user();
    //         $id = $user->adduser($name, $email, $phone, $address, $password);
    //         if (!empty($id)) {
    //             require_once 'views/login.php';
    //         }
    //     } else {
    //         require_once 'views/registration.php';
    //     }
    // }
    require_once 'controllers/usercontroller.php';
    $usertrue = add_user();
    $message = "User Added";
    if ($usertrue === $message) {
        $msg = urlencode('Account Created LogIn Now');
        header('location:index.php?action=login&Message=' . $msg);
    } else {
        if (!empty($usertrue[0])) {
            $nameErr = $usertrue[0];
        }
        if (!empty($usertrue[1])) {
            $emailErr = $usertrue[1];
        }
        if (!empty($usertrue[2])) {
            $phoneErr = $usertrue[2];
        }
        if (!empty($usertrue[3])) {
            $addressErr = $usertrue[3];
        }
        if (!empty($usertrue[4])) {
            $passwordErr = $usertrue[4];
        }

        require_once 'views/registration.php';
    }
} elseif ($action == 'login') {
    require_once 'views/login.php';
} elseif ($action == 'CreateNew') {
    if (isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN'] != '') {
        $msg = "";
        if (isset($_POST['saveblog'])) {
            $data = $_SESSION['USER_USERNAME'];
            include_once 'models/user.php';
            $user = new user();
            $current_user = $user->getuserbyemail($data);
            $user_id = $current_user[0]['id'];
            $name = $_POST['name'];
            $blog = $_POST['blog'];
            include_once 'models/blog.php';
            $new_blog = new blog();
            $result = $new_blog->addblog($user_id, $name, $blog);
            if (!empty($result)) {
                $msg = "Blog Added Successfully";
                require_once 'views/create.php';
            } else {
                $msg = "You have not created any blog.";
                require_once 'views/create.php';
            }
        } else {
            require_once 'views/create.php';
        }
    } else {
        require_once 'views/login.php';
    }
} elseif ($action == 'MyBlog') {
    if (isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN'] != '') {
        $msg = "";
        $data = $_SESSION['USER_USERNAME'];
        include_once 'models/user.php';
        $user = new user();
        $current_user = $user->getuserbyemail($data);
        $user_id = $current_user[0]['id'];
        include_once 'models/blog.php';
        $new_blog = new blog();
        $result = $new_blog->getuserblogs($user_id);
        if (!empty($result)) {
            require_once 'views/myblog.php';
        } else {
            $msg = "Blog Not Inserted";
            require_once 'views/myblog.php';
        }
    } else {
        require_once 'views/login.php';
    }
} elseif ($action == 'logout') {
    session_unset();
    session_destroy();
    require_once 'views/login.php';
} elseif ($action == 'Profile') {
    if (isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN'] != '') {
        $data = $_SESSION['USER_USERNAME'];
        include_once 'models/user.php';
        $user = new user();
        $current_user = $user->getuserbyemail($data);
        $oldEmail = $current_user[0]['email'];
        if (isset($_POST['save'])) {
            $id = $current_user[0]['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address =  $_POST['address'];
            include_once 'models/user.php';
            $user = new user();
            $current_user = $user->updateuser($name,  $phone, $address, $email);
            if ($email != $oldEmail) {
                $msg = "Login Again With New Email";
                session_unset();
                session_destroy();
                require_once 'views/login.php';
            } else {
                $msg = urldecode("Profile Updated Successfully");
                header('location:index.php?action=Profile&Message=' . $msg);
            }
        } elseif (isset($_POST['cancel'])) {
            header('location:index.php?action=blog-all');
        } else {
            require_once 'views/profile.php';
        }
    } else {
        require_once 'views/login.php';
    }
} elseif ($action == 'edit') {
    if (isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN'] != '') {
        if (isset($_GET["body"])) {
            if (isset($_POST['save'])) {
                $blog_id = $_GET["body"];
                $name = $_POST['name'];
                $blog_des = $_POST['blog'];
                include_once 'models/blog.php';
                $blog = new blog();
                $set = $blog->updateblog($name, $blog_des, $blog_id);
                header('location:index.php?action=edit&body=' . $blog_id);
            } elseif (isset($_POST['delete'])) {
                $blog_id = $_GET["body"];
                include_once 'models/blog.php';
                $blog = new blog();
                $blog->deleteblog($blog_id);
                include_once 'models/comment.php';
                // $blog = new comment();
                // $blog->deletecomment($blog_id);
                // require_once 'views/myblog.php';
                header('location:index.php?action=MyBlog');
            } else {
                $blog_id = $_GET["body"];
                include_once 'models/blog.php';
                $blog = new blog();
                $set = $blog->getblogbyid($blog_id);
                if (!empty($set)) {
                    $blog_title = $set[0]['blog_name'];
                    $blog = $set[0]['blog'];
                    require_once 'views/edit.php';
                } else {

                    require_once 'views/myblog.php';
                }
            }
        } else {
            require_once 'views/myblog.php';
        }
    } else {
        require_once 'views/login.php';
    }
} else {
    if (isset($_POST['login'])) {
        header('location:index.php?action=login');
        if (isset($_POST['submit'])) {
        }
    } elseif (isset($_POST['register'])) {
        header('location:index.php?action=registration');
    } else {
        require_once 'views/home.php';
    }
}
