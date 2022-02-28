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

.a {
    display: inline;
    background: grey;
    text-align: center;
}

.dropdown {
    float: right;
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 90px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 1px 1px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: darkgray
}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: skyblue;
}
</style>

<body>
    <section>
        <div style=" background-color:grey ; width:100%;opacity:0.9">
            <h1 style="text-align: center;"> BLOGS </h1>
            <div class="dropdown">
                <button class="dropbtn">MoreOptions</button>
                <div class="dropdown-content">
                    <a href='create.php' style="color:black;text-decoration: none;">CreateNew</a>&nbsp;
                    <a href='myblog.php' style="color:green;text-decoration: none;">MyBlogs</a>&nbsp;
                    <a href='list.php' style="color:blue;text-decoration: none;">UserList</a>&nbsp;
                    <a href='profile.php' style="color:darkorchid;text-decoration: none;">Profile</a>&nbsp;
                    <a href='logout.php' style=" color:red;text-decoration: none;">LogOut</a>
                </div>
            </div>
        </div>


        <div style=" padding-left: 50px; padding-right:50px" class="row">
            <form action="" method="POST">
                <?php
                foreach ($blog_list as $row) { ?>
                <div class="coloum left">
                    <h2 style="text-align: center;background-color:skyblue ;color:black;">
                        <b> <?php echo $row['blog_name'] ?><br> </b>
                    </h2>
                    <p style="text-align: left;">
                        <b><?php echo $row['blog'] ?></b><br>
                    </p>
                </div>
                <div style="text-align: right;">
                    <a href="comments.php?id=<?php echo $row['id'] ?>" style="text-decoration: none;color:black">
                        <span style="padding:2px;border: 2px solid black;background:lightgrey">COMMENTS</span></a><br>
                </div>
                <?php } ?>
            </form>
        </div>
    </section>
</body>

</html>