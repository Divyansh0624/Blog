<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NewBlog</title>
    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;

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
    </style>
</head>

<body>

    <form method="POST">
        <div class="container">
            <h1>Update Your Blog!</h1>
            <a href="index.php?action=MyBlog" style="float:right;">BACK</a>
            <hr>
            <label><b>BLOG NAME</b></label>
            <input type="text" placeholder="Enter Your Blog Name" name="name" value="<?php echo $blog_title ?>"
                required>

            <label><b>BLOG</b></label>
            <textarea
                style="width:100%;font-family:Arial, Helvetica, sans-serif;padding:15px;font-size:17px;background:#f1f1f2;margin:10px 0 22px 0"
                name="blog" rows="8" required><?php echo $blog ?></textarea>
            <div style="text-align: right;">
                <button type="submit" style="background-color: lightgreen; width:20%;height:35px"
                    name="save">SAVE</button>
                <button type="submit" style="background-color: crimson;width:20%;height:35px"
                    name="delete">DELETE</button>
            </div>
            <hr>

        </div>
    </form>
</body>

</html>