<?php
require('connection.inc.php');
if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($con,$_GET['operation']);
		$id=get_safe_value($con,$_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="update `user` set status='$status' where id='$id'";
		mysqli_query($con,$update_status_sql);
    }
}
$res="";
if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']!=''){

    #$sql = " select user.id, user.name,user.email,user.phone,blog.blog_name,user.status from `user` FULL OUTER JOIN `blog` ON (user.id = blog.user_id) ";
    #$sql = "select user.id, user.name,user.email,user.phone,blog.blog_name,user.status from `user`,`blog`";
    $sql ="select user.id, user.name,user.email,user.phone,user.status from `user`";

    $res = mysqli_query($con,$sql);
}else{
	header('location:index.php');
	die();
}

function get_safe_value($con , $str){
    if($str!=''){
        return(mysqli_real_escape_string($con, $str));
    }
}
?>
<DOCTYPE HTML> 
<html>
    <head>
    </head>
    <body>
	<h1 style="text-align: center;"><b>Users And Their Status</b></h1>
        <form>
        <table border = '|' style="border:1px solid black;margin-left: auto; margin-right:auto;border-collapse: separate; border-spacing:15px 15px">
			<thead>
				<tr>
                    <th>#</th>
					<th>ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<!-- <th>Blog Name</th> -->
					<th>status</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i=1;
				while($row = mysqli_fetch_assoc($res)){?>
				<tr>
					<td ><?php echo $i?></td>
					<td><?php echo $row['id']?></td>
				    <td><?php echo $row['name']?></td>
					<td><?php echo $row['email']?></td>
					<td><?php echo $row['phone']?></td>
					<!-- <td><?php echo $row['blog_name']?></td> -->
                    <td>
					<?php
					if($row['status']==1){
					echo "<span><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
					}else{
					echo "<span><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
					} ?> 
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
        </form>
    </body>
</html>
