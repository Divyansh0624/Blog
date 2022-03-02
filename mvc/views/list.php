<DOCTYPE HTML>
    <html>

    <head>
        <title>UserList</title>
        <style>
        th,
        td {
            text-align: left;
            padding: 16px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        span.psw {
            float: right;

        }
        </style>
    </head>

    <body>
        <form method="POST">
            <div>
                <span class="psw"><a href="index.php?action=blog-all">BACK</a></span>
                <h1 style="text-align: center;"><b>Users And Their Status</b></h1>
            </div>

            <div style="overflow-x:auto;">
                <table
                    style="border:1px solid black;margin-left: auto; margin-right:auto;border-collapse: separate;border-spacing: 0;width:90%">
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
                        $i = 1;
                        foreach ($rows as $row) { ?>
                        <tr>
                            <td><?php echo $i;
                                    $i++; ?></td>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $row['phone'] ?></td>
                            <!-- <td><?php echo $row['blog_name'] ?></td> -->
                            <td>
                                <?php
                                    if (($row['status'] == 1)) {
                                        // echo "<span><a href='?type=status&operation=deactive&id=".$row['id']."'>Active</a></span>&nbsp;";
                                        echo "<p style='color:green;'>Active</p>";
                                    } else {
                                        // echo "<span><a href='?type=status&operation=active&id=".$row['id']."'>Deactive</a></span>&nbsp;";
                                        echo "<p style='color:red;'>Deactive</p>";
                                    } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </form>
    </body>

    </html>