<!DOCTYPE html>
<html>
    <head>
        <title>Change Avatar</title>
        <link rel="shortcut icon" type="image/x-icon" href="lightbulb.ico">
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

            .photo {
                align:center;
                text-align: center;
                background-color:#D7DBDD;
                border-radius: 4px;
                max-width: 80%;
                margin: auto;
            }

            input[type=file] {
                border-radius: 4px;
            }

            input[type=file]:hover {
                background-color: white;
                color: black;
                cursor: pointer;

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
        <div class="topnav">
            <b><a href = "welcome.php">Home</a></b>
            <b><a href = "myprofile.php">My Profile</a></b>
            <div class="dropdown">
                <button class="dropbtn"><b>Social</b>
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <b><a href = "forum.php">Forum</a></b>
                    <b><a href = "inbox.php">Chat</a></b>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn"><b>Search</b>
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <b><a href = "searchtasks.php">All Tasks </a></b>
                    <b><a href = "searchGeneralTask.php">Search By Name/Description</a></b>
                    <b><a href = "searchTags.php">Search By Tags</a></b>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn"><b>My Tasks</b>
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <b><a href = "taskcreateform.php">Create Tasks</a></b>
                    <b><a href = "mytasks.php">My Tasks</a></b>
                    <b><a href = "viewbidtask.php">My Bid Tasks</a></b>
                </div>
            </div>
            <b><a href = "report.php">Report Problem</a></b>
            <b><a href = "logout.php">Sign Out</a></b>
        </div>
        <br/>
        <br/>

        <form action="changephoto.php" method="post" enctype="multipart/form-data">
            <div align='center'>
                <h4>Image Allowed:&nbsp;Not larger than 2MB,&nbsp;File type is JPG, PNG, JPEG OR GIF.</h4>
            </div>
            <div class='photo'>
                <br/>
                <h3 align='center'>Select image to upload: &nbsp;<input type="file" name="fileToUpload" id="fileToUpload" style='font-family:Old Standard;font-size: 18px;'></h3>
                <br/>
            </div>
            <div align='center'>
                <br/>
                <input type="submit" value="Submit" name="submit" style='font-family:Old Standard;font-size: 18px;'>
            </div>
        </form>

        <?php
        include'config.php';
        include'session.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_SESSION['login_user'];
            $target_dir = "img/account/";
            $info = pathinfo($_FILES["fileToUpload"]["name"]);
            $ext = $info['extension'];
            $target_file = $target_dir . $username . "." . $ext;
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) {

                    $uploadOk = 1;
                } else {
                    echo "<script type = 'text/javascript'> alert ('Error: File is not an image.')</script>";
                    $uploadOk = 0;
                }
            }
// Check if file already exists
            if (file_exists($target_file)) {

                //delete($target_file);
                $uploadOk = 1;
            }
// Check file size
            if ($_FILES["fileToUpload"]["size"] > 2097152) {
                echo "<script type = 'text/javascript'> alert ('Error: File is too large (>2MB).')</script>";
                $uploadOk = 0;
            }
// Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "<script type = 'text/javascript'> alert ('Error: Only JPG, JPEG, PNG & GIF files are allowed.')</script>";
                $uploadOk = 0;
            }
// Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "<script type = 'text/javascript'> alert ('Error: File was not uploaded..')</script>";
// if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

                    $file = basename($target_file);
                    $sql = "UPDATE account SET avatar_path = '$file' WHERE username = '$username';";
                    $results = mysqli_query($db, $sql);
                    if ($results) {
                        echo "<script type = 'text/javascript'> alert ('Your avatar has been changed!')</script>";
                    } else {
                        echo "<script type = 'text/javascript'> alert ('Sorry, there was an error uploading your file.\n$error')</script>";
                    }
                    echo '<script>window.location.href = "myprofile.php";</script>';
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
        ?>
        <br/>
        <div align='center'><h3><a href = 'myprofile.php' style='font-family:Old Standard;font-size: 18px'>Back</a></h3></div>
    </body>
</html>
