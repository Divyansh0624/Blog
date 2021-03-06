<?php

require('connection.inc.php');
if (isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN'] != '') {
    if (isset($_GET["body"])) {
        $data = $_GET["body"];
        $id_query = "select blog_name ,blog from `blog` where id='$data' ";
        $res = mysqli_query($con, $id_query);
        if (mysqli_num_rows($res) > 0) {
            $set = mysqli_fetch_assoc($res);
            $blog_title = $set['blog_name'];
            $blog = $set['blog'];
        } else {
            $error = "There is some issue";
        }
        if (isset($_POST['save'])) {
            $name = get_safe_value($con, $_POST['name']);
            $blog = get_safe_value($con, $_POST['blog']);
            $sql = "update `blog` SET blog_name='$name' , blog='$blog'  WHERE id = '$data' ";
            mysqli_query($con, $sql);
            header('location:myblog.php');
        } elseif (isset($_POST['delete'])) {
            $sql = "DELETE FROM `blog` WHERE id = '$data'";
            mysqli_query($con, $sql);
            $query = "Delete from `comment` where blog_id='$data' ";
            mysqli_query($con, $query);
            header('location:myblog.php');
        }
    } else {
        header('location:myblog.php');
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
    <title>NewBlog</title>
    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;

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
    input[type=text] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }

    input[type=text]:focus {
        background-color: #ddd;
        outline: none;
    }

    /* Overwrite default styles of hr */
    hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
    }
    </style>
</head>

<body style="background-image: url('image/download.jpg');">

    <form method="POST">
        <div class="container">
            <h1>Update Your Blog!</h1>
            <a href="myblog.php" style="float:right;">BACK</a>
            <hr>
            <label><b>BLOG NAME</b></label>
            <input type="text" placeholder="Enter Your Blog Name" name="name" value="<?php echo $blog_title ?>"
                required>

            <label><b>BLOG</b></label>
            <textarea
                style="width:100%;font-family:Arial, Helvetica, sans-serif;padding:15px;font-size:17px;background:#f1f1f2;margin:10px 0 22px 0"
                name="blog" rows="8" required><?php echo $blog ?></textarea>
            <div style="text-align: right;">
                <button type="submit" style="background-color: lightgreen; width:20%;height:35px"
                    name="save">SAVE</button>
                <button type="submit" style="background-color: crimson;width:20%;height:35px"
                    name="delete">DELETE</button>
            </div>
            <hr>

        </div>
    </form>
    <script>
    ifvisible.on("blur", function() {
        <?php $username = $_SESSION['USER_USERNAME'];
            $sql = "update `user` set status = '0' where email = '$username'";
            mysqli_query($con, $sql); ?>
    });

    ifvisible.on("focus", function() {
        <?php $username = $_SESSION['USER_USERNAME'];
            $sql = "update `user` set status = '1' where email = '$username'";
            mysqli_query($con, $sql); ?>
    });
    </script>
</body>

</html>