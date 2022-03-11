<?php
require('connection.inc.php');
if (isset($_POST['login'])) {
    header('location:login.php');
} elseif (isset($_POST['register'])) {
    header('location:registration.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>BLOG WEBSITE</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script>
</head>
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
    background-color: aliceblue;
}

p {
    margin-left: auto;
    margin-right: auto;
    width: 80%;

}

h3 {
    margin-left: 10%;
    height: 27px;
    padding-top: 5px;

}

table {
    float: right;
}
</style>

<body>
    <form method="POST">
        <h1 style="text-align: center;background-color:skyblue"><b>Welcome to our Blog family!</b></h1>
        <nav class="navbar navbar-light bg-light">
            <form class="container-fluid justify-content-start">
                <button type="submit" name="login" class="btn btn-outline-success me-2" type="button">Login</button>
                <button type="submit" name="register" class="btn btn-sm btn-outline-secondary"
                    type="button">Register</button>
            </form>
        </nav>
        <!-- <table class="table">
            <tr>
                <td><button type="submit" name="login" style="background-color: skyblue;cursor: pointer;">LogIn</button>
                </td>
                <td><button type="submit" name="register"
                        style="background-color:aquamarine;cursor: pointer;">Register</button></td>
            </tr>
        </table> -->
        <h3>What is a Blog ?</h3>
        <P>
            A blog (a truncation of "weblog")[1] is a discussion or informational website
            published on the World Wide Web consisting of discrete, often informal diary-style
            text entries (posts). Posts are typically displayed in reverse chronological order,
            so that the most recent post appears first, at the top of the web page. Until 2009,
            blogs were usually the work of a single individual,[citation needed] occasionally of
            a small group, and often covered a single subject or topic. In the 2010s, "multi-author blogs"
            (MABs) emerged, featuring the writing of multiple authors and sometimes professionally edited.
            MABs from newspapers, other media outlets, universities, think tanks, advocacy groups, and
            similar institutions account for an increasing quantity of blog traffic. The rise of Twitter
            and other "microblogging" systems helps integrate MABs and single-author blogs into the news media.
            Blog can also be used as a verb, meaning to maintain or add content to a blog.
        </P>
        <h3>History</h3>
        <P>
            The term "weblog" was coined by Jorn Barger[9] on December 17, 1997.
            The short form, "blog", was coined by Peter Merholz, who jokingly broke
            the word weblog into the phrase we blog in the sidebar of his blog Peterme.com
            in April or May 1999.[10][11][12] Shortly thereafter, Evan Williams at Pyra Labs
            used "blog" as both a noun and verb ("to blog", meaning "to edit one's weblog or to
            post to one's weblog") and devised the term "blogger" in connection with Pyra Labs'
            Blogger product, leading to the popularization of the terms.
        </P>
        <h3>Technology</h3>
        <P>
            Early blogs were simply manually updated components of common Websites.
            In 1995, the "Online Diary" on the Ty, Inc. Web site was produced and updated
            manually before any blogging programs were available. Posts were made to appear
            in reverse chronological order by manually updating text-based HTML code using FTP
            software in real time several times a day. To users, this offered the appearance of a
            live diary that contained multiple new entries per day. At the beginning of each new day,
            new diary entries were manually coded into a new HTML file, and at the start of each month,
            diary entries were archived into their own folder which contained a separate HTML page for
            every day of the month. Then menus that contained links to the most recent diary entry were
            updated manually throughout the site. This text-based method of organizing thousands of files
            served as a springboard to define future blogging styles that were captured by blogging software
            developed years later.
        </P>
        <p id="moreabout">
            <button id="More" class="btn btn-sm btn-outline-secondary">More</button>
        </p>
    </form>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    <script>
    $(document).ready(function() {
        $("#More").click(function() {
            $("#More").hide();
            const xhr = new XMLHttpRequest();
            console.log("yes");
            xhr.open('GET', 'ajax.txt', true)
            xhr.onload = function() {
                console.log("bye");
                $("#moreabout").html(this.responseText);
            }
            xhr.send();
        });
    });
    </script>
</body>

</html>