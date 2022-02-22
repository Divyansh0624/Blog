<?php
require('connection.inc.php');
if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']!=''){
    $sql = "select * from `blog` ";
    $res = mysqli_query($con,$sql);
}
else{
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>MyBlogs</title>
</head>
<style>
.column {
    float: left;
    padding: 50px;
}

.left {
    width: 90%;
}
</style>

<body>
    <section>
        <div style="background-color:grey ; width:100%;opacity:0.9">
            <h1 style="text-align: center;color:darkblue;"><b>BLOGS</b></h1>
            <div style="text-align:right;">
                <a href='create.php'
                    style="display:inline;color:black;background:grey;text-align:center;">CreateNew</a>&nbsp;
                <a href='myblog.php'
                    style="display:inline;color:black;background:grey;text-align:center;">MyBlogs</a>&nbsp;
                <a href='list.php'
                    style="display:inline;color:blue;background:grey;text-align:center;">UserList</a>&nbsp;
                <a href='logout.php' style=" display:inline;color:red;background:grey;text-align:center;">LogOut</a>
            </div>
        </div>

        <div style=" padding-left: 50px; padding-right:50px" class="row">
            <form action="" method="POST">
                <?php 
					$i=1;
					while($row = mysqli_fetch_assoc($res)){?>
                <div class="coloum left">
                    <h2 style="text-align: center;background-color:skyblue ;color:black;">
                        <b> <?php echo $row['blog_name']?><br> </b>
                    </h2>
                    <p style="text-align: left;">
                        <?php echo $row['blog']?><br>
                    </p>
                </div>
                <div style="text-align: right;">
                    <a href="comments.php?id=<?php echo $row['id']?>" style="text-decoration:none;color:black"><span
                            style="border: 1px solid black;background:darkgrey">COMMENTS</span></a><br>
                </div>
                <?php } ?>
            </form>
        </div>
    </section>
</body>

</html>