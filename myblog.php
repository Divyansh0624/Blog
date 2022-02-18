<?php 
require('connection.inc.php');
if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']!=''){
    $data = $_SESSION['USER_USERNAME'];
    $id_query = "select id from `user` where email='$data' ";
    $res = mysqli_query($con,$id_query);
    $set = mysqli_fetch_assoc($res);
    $id = $set['id'];
    $sql = "select * from `blog` where user_id = '$id' ";
    $res = mysqli_query($con,$sql);
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
            background-color:aliceblue;
        }

        * {
            box-sizing: border-box;
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
            <h1>Your Blogs!</h1>
            <a href="blog.php" style="float:right;">BACK</a>
            <hr>
            <?php 
				while($row = mysqli_fetch_assoc($res)){?>
				<h2 style="text-align: center;background-color:skyblue ;color:black;">
					<b><?php echo $row['blog_name'];?><br></b>
                </h2>
                <!-- <textarea style="width: 100%;
                    font-family: Arial, Helvetica, sans-serif;
                    padding: 15px;
                    margin: 5px 0 22px 0;
                    display: inline-block;
                    border: none;
                    background: #f1f1f1;" name="blog" rows="10" >
                    <?php  echo $row['blog']  ?>
                </textarea> -->
                <p>
				   <?php echo $row['blog']?>
                </p>
                <br>
                <div style="text-align: right;">
                <a href="edit.php?body=<?php echo $row['id'];?>" style="color:crimson">Edit</a>                </div>
            <?php } ?>
            <hr>
        </div>
    </form>
</body>

</html>