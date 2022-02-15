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
    <body>
    <section>
        <div style="background-color:grey ;color:brown;" >
            <!-- <table>
                <tr>
                    <td><h1><b>Blogs &nbsp;&nbsp;&nbsp;&nbsp;</b></h1></td>
                    <td><a href='create.php'>CreateNew</a>-&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><a href='edit.php'>Edit</a>-&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><a href='list.php'>UserList</a>-&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>
            </table> -->
            <h1 style="text-align: center;"><b>BLOGS</b></h1>
        </div>
        <div style="text-align:right">
            <a href='create.php' style="display:inline; width:80px; height:25px;color:blue;background:white;text-align:center;">CreateNew</a>
            <a href='edit.php' style="display:inline; width:80px; height:25px;color:blue;background:white;text-align:center;">LogOut</a>
            <a href='list.php' style="display:inline; width:80px; height:25px;color:blue;background:white;text-align:center;">UserList</a>
        </div>
        <div style="background-color:skyblue ;color:black; padding-left: 50px; padding-right:50px">
            <form action="" method="POST">
                <div>
                <?php 
					$i=1;
					while($row = mysqli_fetch_assoc($res)){?>
					<h2 style="text-align: center;">
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