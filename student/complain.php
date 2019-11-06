
<?php
include 'config.php';
include 'session.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $title = $_POST['title'];
    $problem = $_POST['problem'];
    $sql = "INSERT INTO complain(title, content, complainer, status)"
            . "VALUES('$title', '$problem', '$username', 'new');";
    $results = mysqli_query($db, $sql);
    if ($results) {
        echo "<script type = 'text/javascript'> alert ('Thank you for your report!!')</script>";
    } else {
        echo "<script type = 'text/javascript'> alert ('Error in Submission!!')</script>";
    }
    echo '<script>window.location.href = "studentdashboard.php";</script>';
    exit();
}
?>
<html>
    <head>
        <title>Submit Feedback</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            * {
                box-sizing: border-box;
            }
            @media screen and (max-width:600px) {
                .column {
                    width: 100%;
                }
            }
            body {
                font-family: Old Standard;
                color: black;
                margin: 0;
            }

            /* Style the header */
            .header {
                background-color: #f1f1f1;
                padding: 5px;
                text-align: center;
            }

            .column {
                float: left;
                width: 33.33%;
                padding: 15px;
            }
            .row:after {
                content: "";
                display: table;
                clear: both;
            }

            .column {
                float: left;
                width: 25%;
                padding: 15px;
            }

            .columnright {
                float: left;
                width: 75%;
                padding: 15px;
            }
            .row:after {
                content: "";
                display: table;
                clear: both;
            }

            /* Style the top navigation bar */
            .topnav {
                overflow: hidden;
                background-color: #333;
                text-align: center;
                display: flex;
                justify-content: space-around;
                padding-left: 150px;
                padding-right: 150px;
            }

            /* Style the topnav links */
            .topnav a {
                float: left;
                display: block;
                color: #f2f2f2;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                width:150px;
            }

            /* Change color on hover */
            .topnav a:hover {
                background-color: #ddd;
                color: black;
            }

            .dropdown {
                float: left;
                overflow: hidden;
            }

            .dropdown .dropbtn {
                font-size: 16px;
                border: none;
                outline: none;
                color: white;
                padding: 14px 16px;
                background-color: inherit;
                font-family: inherit;
                margin: 0;
                width:150px;
            }

            .navbar a:hover, .dropdown:hover .dropbtn {
                background-color: bisque;
                color: black;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }

            .dropdown-content a {
                float: none;
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                text-align: left;
            }

            .dropdown-content a:hover {
                background-color: #ddd;
            }

            .dropdown:hover .dropdown-content {
                display: block;
            }

            .imagecontainer {
                position:absolute;
                bottom:0;
            }

            .report {
                align:center;
                text-align: center;
                background-color:#D7DBDD;
                border-radius: 4px;
                max-width: 80%;
                margin: auto;
            }

            input[type=text] {
                width: 50%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            input[type=text]:focus {
                border: 3px solid #555;
            }

            input[type=submit] {
                border-radius: 4px;
            }

            input[type=submit]:hover {
                background-color: white;
                color: black;
                cursor: pointer;

            }
        </style>
    </head>
    <body>

        <form action="complain.php" method="post" enctype="multipart/form-data">
            <div class='report'>
                <br/>
                <h3 align='center'>Title: &nbsp;<input type="text" name="title" id="title"></h3>
                <h3 align='center'>Problem: &nbsp;<input type="text" name="problem" id="problem"></h3>
                <br/>
            </div>
            <div align='center'>
                <br/>
                <input type="submit" value="Submit" name="submit" style='font-family:Old Standard;font-size: 18px'>
            </div>
        </form>


        <div align='center'><h3><a href = 'studentdashboard.php' style='font-family:Old Standard;font-size: 18px'>Back</a></h3></div>
    </body>
</html>

<?php
include 'config.php';
include 'session.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $title = $_POST['title'];
    $problem = $_POST['problem'];
    $sql = "INSERT INTO complain(title, content, complainer, status)"
            . "VALUES('$title', '$problem', '$username', 'new');";
    $results = mysqli_query($db, $sql);
    if ($results) {
        echo "<script type = 'text/javascript'> alert ('Thank you for your report!!')</script>";
    } else {
        echo "<script type = 'text/javascript'> alert ('Error in Submission!!')</script>";
    }
    echo '<script>window.location.href = "studentdashboard.php";</script>';
    exit();
}
?>
