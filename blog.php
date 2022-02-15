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
        padding: 10px;
        }
        
        .left {
         width: 75%;
        }
        
    </style>
    <body>
    <section>
        <div style="background-color:grey ;color:brown; width:77%;" >
            <h1 style="text-align: center;"><b>BLOGS</b></h1>
        </div>
        <div style="text-align:right">
            <a href='create.php' style="display:inline; width:80px; height:25px;color:blue;background:white;text-align:center;">CreateNew</a>
            <a href='edit.php' style="display:inline; width:80px; height:25px;color:blue;background:white;text-align:center;">LogOut</a>
            <a href='list.php' style="display:inline; width:80px; height:25px;color:blue;background:white;text-align:center;">UserList</a>
        </div>
        <div style=" padding-left: 50px; padding-right:50px" class="row">
            <form action="" method="POST">
                <div class="coloum left">
                    <?php 
					$i=1;
					while($row = mysqli_fetch_assoc($res)){?>
					<h2 style="text-align: center;background-color:skyblue ;color:black;">
					  <b> <?php echo $row['blog_name']?><br> </b>
                    </h2>
                    <p>
					   <?php echo $row['blog']?>
                    </p>
                    <br>
                    <?php } ?>
                </div>
            </form>
        </div>
      </section>
    </body>
</html> 



