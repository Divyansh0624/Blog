<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NewBlog</title>
    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        background-color: aliceblue;
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
    <form method=" POST">
        <div class="container">
            <h1>Your Blogs!</h1>
            <a href="index.php?action=blog-all" style="float:right;">BACK</a>
            <hr>
            <?php
            echo "<h2>" . $msg . "</h2>";
            foreach ($result as $row) { ?>
            <h2 style="text-align: center;background-color:skyblue ;color:black;">
                <b><?php echo $row['blog_name']; ?><br></b>
            </h2>
            <p>
                <b><?php echo $row['blog'] ?></b>
            </p>
            <br>
            <div style="text-align: right;">
                <a href="index.php?action=edit&body=<?php echo $row['id']; ?>" style="color:crimson">Edit</a>
            </div>
            <?php } ?>
            <hr>
        </div>
    </form>
</body>

</html>