<?php
   
require('connection.inc.php');
if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']!=''){
    if(isset($_GET["body"]))
    {
        $data = $_GET["body"];
        $id_query = "select blog_name ,blog from `blog` where id='$data' ";
        $res = mysqli_query($con,$id_query);
        if(mysqli_num_rows($res)>0){
        $set = mysqli_fetch_assoc($res);
        $blog_title = $set['blog_name'];
        $blog = $set['blog'];
        }
        else{
        $error = "There is some issue";
        }
        if(isset($_POST['save'])){
            $name = $_POST['name'];
            $blog = $_POST['blog'];
            $sql = "UPDATE 'blog' SET blog_name='$name' , blog='$blog'  WHERE id = $data";
            mysqli_query($con,$sql);
        }
        elseif(isset($_POST['delete'])){
            $sql = "DELETE FROM `blog` WHERE id = '$data'";
            mysqli_query($con,$sql);
            header('location:myblog.php');
        }
    }
    else{
        header('location:myblog.php');
    }
    
}
else{
    header('location:login.php');
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
            background-color: grey;
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

<body>

    <form method="POST">
        <div class="container">
            <h1>Update Your Blog!</h1>
            <a href="myblog.php" style="float:right;">BACK</a>
            <hr>
            <label><b>BLOG NAME</b></label>
            <input type="text" placeholder="Enter Your Blog Name" name="name" value="<?php echo $blog_title ?>" required>

            <label><b>BLOG</b></label>
            <textarea style="width: 100%;
                    font-family: Arial, Helvetica, sans-serif;
                    padding: 15px;
                    margin: 5px 0 22px 0;
                    display: inline-block;
                    border: none;
                    background: #f1f1f1;" name="blog" rows="10" required>
                    <?php echo $blog?>
            </textarea>
            <div style="text-align: right;">
            <button type="submit" style="background-color: lightgreen;" name="save">SAVE</button>
            <button type="submit" style="background-color: crimson;" name="delete">Delete</button>
            </div>
            <hr>
            
        </div>
    </form>

</body>

</html>