<?php 
require('connection.inc.php');
if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']!=''){
    if(isset($_GET["id"]))
    {
        $data = $_GET['id'];
        $blog_query = "select * from blog where id= '$data' ";
        $result = mysqli_fetch_assoc(mysqli_query($con,$blog_query));
        $sql = "select * from comment where blog_id = '$data'";
        $res = mysqli_query($con,$sql);
        if(isset($_POST['save'])){
            $data = $_GET['id'];
            $user_id = $result['user_id'];
            $comment = $_POST['comment'];
            $query = "insert into `comment`(user_id,blog_id,comment) values('$user_id','$data','$comment')";
            mysqli_query($con,$query);
            header('location:blog.php');
        }
    }
    else{
        header('location:blog.php');
    }
}
else{
    header('location:login.php');
}

?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Comments</title>
</head>

<body style="background:lightsteelblue">
    <form method="POST" action="">
        <a href="blog.php" style="float:right;;text-decoration:none;width:7%"><span
                style="border: 1px solid black;background:darkgrey">BACK</span></a>
        <div style="text-align:center;margin: auto; width:80%">
            <h2 style="background-color:crimson ;color:black;">
                <b> <?php echo $result['blog_name']?><br> </b>
            </h2>
            <p>
                <?php echo $result['blog']?><br>
            </p>
            <h2><b>Add Comment</b></label></h2>
            <input type="text" name="comment" placeholder="Add your Comment"
                style="text-align:center;width: 60%; height:40px">
            <button type="submit" name="save"
                style="text-align:center;height:42px ;width:5%;background:chartreuse">Add</button>
            <h3>Comment Section</h3>
        </div>
        <table style="margin: auto;background:skyblue">
            <tbody>
                <?php
                $lastcol= 0; 
                $i=0;
                while($rows = mysqli_fetch_assoc($res)){
                //     $i++;
                //     if(ceil($i/3)!==$lastcol){
                //         $lastcol = ceil($i/3);
                //         if($i>2){
                //             echo "</tr>";
                //         }
                //     }
                //     echo "<tr>";
                // ?>
                <tr>
                    <td><span
                            style="border: 2px solid black;display: inline-block;width: 500px;height: 30px;text-align: center;background:gainsboro;">
                            <?php echo $rows['comment'];?></span>
                    </td>
                </tr>
                <tr></tr>
                <?php } ?>
            </tbody>
        </table>
    </form>
</body>

</html>