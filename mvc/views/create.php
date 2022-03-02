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

    <form method="POST" action="index.php?action=CreateNew">
        <div class="container">
            <h1>Create Your New Blog!</h1>
            <h2><?php echo $msg; ?></h2>
            <a href="index.php?action=blog-all" style="float:right;">BACK</a>
            <hr>
            <label><b>BLOG NAME</b></label>
            <input type="text" placeholder="Enter Your Blog Name" name="name" required>

            <label><b>BLOG</b></label><br>
            <textarea style="width: 100%;
                    padding:15px;
                    margin:5px 0 22px 0;
                    display:inline-block;
                    background: #f1f1f1" name="blog" rows="10" placeholder="Enter your blog description"
                required></textarea>
            <hr>
            <button type="submit" class="savebtn" name="saveblog">SAVE</button>
        </div>
    </form>
</body>

</html>