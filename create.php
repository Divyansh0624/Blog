<?php 
require('connection.inc.php');
if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']!=''){
    if(isset($_POST['save'])){
        $data = $_SESSION['USER_USERNAME'];
        $sql = "select id from `user` where email = '$data '";
        $res = mysqli_query($con,$sql);
        if(mysqli_num_rows($res) > 0){
            $set = mysqli_fetch_assoc($res);
            $id = $set['id'];
            $name = get_safe_value($con, $_POST['name']);
            $blog= get_safe_value($con, $_POST['blog']);
            $sql = "insert into `blog` (`user_id`, `blog_name`, `blog`) VALUES ('$id', '$name', '$blog') ";
            mysqli_query($con,$sql);
            header('location:blog.php');
        }else{
            header('location:login.php');
        }
    }
}else{
    header('location:login.php');
    die();
}
function get_safe_value($con , $str){
    if($str!=''){
        return(mysqli_real_escape_string($con, $str));
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

/* Set a style for the submit button */
.savebtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.savebtn:hover {
  opacity: 1;
}

</style>
</head>
<body>

<form method="POST">
  <div class="container">
    <h1>Create Your New Blog!</h1>
    <a href="blog.php" style="float:right;">BACK</a>
    <hr>
    <label><b>BLOG NAME</b></label>
    <input type="text" placeholder="Enter Your Blog Name" name="name" id="email" required>

    <label><b>BLOG</b></label>
    <textarea style="width: 100%;
                    padding: 15px;
                    margin: 5px 0 22px 0;
                    display: inline-block;
                    border: none;
                    background: #f1f1f1;" name="blog" rows="10" placeholder="Enter Your Blog Description"  required></textarea>
    <hr>
    <button type="submit" class="savebtn" name = "save">SAVE</button>
  </div>
</form>

</body>
</html>