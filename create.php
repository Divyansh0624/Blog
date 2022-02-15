<?php 
require('connection.inc.php');
if(isset($_POST['save'])){
    if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']!=''){
        $data = $_SESSION['USER_USERNAME'];
        $sql = 
        $name = get_safe_value($con, $_POST['name']);
        $blog= get_safe_value($con, $_POST['blog']);
    }else{
    header('location:login.php');
    die();
    }
}
if(isset($_POST['back'])){
    header('location:blog.php');

}
function get_safe_value($con , $str){
    if($str!=''){
        return(mysqli_real_escape_string($con, $str));
    }
}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>NewBlog</title>
    </head>
    <body>
        <form method="POST">
        <table>
           <tr>
                <td><label><b>Blog Name</b></label></td>
                <td><input type="text" name="name" placeholder="Enter Blog Name" required></td>   
            </tr>
            <tr>
                <td><label><b>Blog</b></label></td>
                <td><textarea name="blog" cols="100" rows="30" required></textarea></td>  
            </tr>
            <tr>
                <td></td>                
                <td><button type="submit" name="back">Back</button></td>
                <td><button type="submit" name="save">Save</button></td>
            </tr>
            
        </table>
        </form>
    </body>
</html>