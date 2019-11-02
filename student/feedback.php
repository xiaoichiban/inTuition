<!DOCTYPE html>
<html>
    <head>
        <title>Task Feedback</title>
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
            
            input[type=submit] {
                border-radius: 4px;
            }
            
            input[type=submit]:hover {
                background-color: white;
                color: black;
                cursor: pointer;
                border-radius: 4px;
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
        <?php
        include('session.php');
        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        $task_id=$_GET['task_id'];
        $thisuser = $_SESSION['login_user'];
        $sqlquery = pg_query("SELECT * FROM task WHERE task_id = $task_id;");
        $row = pg_fetch_row($sqlquery);
        $creator = $row[1];
        
        //if user is creator
        if ($creator == $thisuser)
        {
            echo "<h2 align='center'>Kindly leave some feedback for your tasker(s)!</h2>";
            echo "<br/>";
            $result = pg_query("SELECT * FROM bid WHERE task_id =$task_id AND is_winning_bid = 'true';");
            if(pg_num_rows($result)>0)
            {
                $num = pg_num_rows($result);
                $count = 1;
                while($row = pg_fetch_row($result)) {
                    
                    $rating_id = "rating" . "$row[1]";
                    $feedback_id = "feedback" . "$row[1]";
                    
                    if ($num == 1) //only one tasker
                    {
                        echo "<h3 align='center'>Tasker " . $count . ": " . $row[1] . "</h3>";
                        echo "<form action='feedback_processing.php?task_id=$task_id' method='post' enctype='multipart/form-data'><div align='center'><table style='width:80%' border='1'>"
                        . "<tr><th><h4>Rating (Integer From 1 [poor] to 5 [great]):&nbsp;</h4></th>"
                        . "<th><input type='number' name='$rating_id' min='1' max='5' id='$rating_id' required></th>"
                        . "<tr><th><h4>Feedback:&nbsp;</h4></th>"
                        . "<th><input type='text' name='$feedback_id' id='$feedback_id'></th></tr></table><br/>"
                        . "<input type='submit' value='Submit' name='submit' align='center' style='font-family:Old Standard;' required></form></div><br/>";
                    }
                    
                    else if($count == 1) //first tasker
                    {
                        echo "<h3 align='center'>Tasker " . $count . ": " . $row[1] . "</h3>";
                        echo "<form action='feedback_processing.php?task_id=$task_id' method='post' enctype='multipart/form-data'><div align='center'><table style='width:80%' border='1'>"
                        . "<tr><th><h4>Rating (Integer From 1 [poor] to 5 [great]):&nbsp;</h4></th>"
                        . "<th><input type='number' name='$rating_id' min='1' max='5' id='$rating_id' required></th>"
                        . "<tr><th><h4>Feedback:&nbsp;</h4></th>"
                        . "<th><th><input type='text' name='$feedback_id' id='$feedback_id'></th></tr></table><br/>";
                        $count++;
                    }
                    
                    else if($count <$num) //not first or last tasker
                    { 
                        echo "<h3 align='center'>Tasker " . $count . ": " . $row[1] . "</h3>";
                        echo "<form action='feedback_processing.php?task_id=$task_id' method='post' enctype='multipart/form-data'><div align='center'><table style='width:80%' border='1'>"
                        . "<tr><th><h4>Rating (Integer From 1 [poor] to 5 [great]):&nbsp;</h4></th>"
                        . "<th><input type='number' name='$rating_id' min='1' max='5' id='$rating_id' required></th>"
                        . "<tr><th><h4>Feedback:&nbsp;</h4></th>"
                        . "<th><th><input type='text' name='$feedback_id' id='$feedback_id'></th></tr></table><br/>";
                        $count++;
                    }
                    else //last tasker
                    {
                        echo "<h3 align='center'>Tasker " . $count . ": " . $row[1] . "</h3>";
                        echo "<tr><th><form action='feedback_processing.php?task_id=$task_id' method='post' enctype='multipart/form-data'><div align='center'><table style='width:80%' border='1'>"
                        . "<th><h4>Rating (Integer From 1 [poor] to 5 [great]):&nbsp;</h4></th>"
                        . "<th><input type='number' name='$rating_id' min='1' max='5' id='$rating_id' required></th>"
                        . "<tr><th><h4>Feedback:&nbsp;</h4></th>"
                        . "<th><th><input type='text' name='$feedback_id' id='$feedback_id'></th></tr></table><br/>"
                        . "<input type='submit' value='Submit' name='submit' align='center' style='font-family:Old Standard;' required></form></div><br/>";
                    }               
                }
            }
            
            
        }
        
        //if user is tasker
        else
        {
            $rating_id = "rating" . $thisuser;
            $feedback_id = "feedback" . $thisuser;
            echo "<h2 align='center'>Kindly leave some feedback for your requester!</h2>";
            echo "<br/>";
            echo "<h3 align='center'>Requester: " . $creator;
            echo "</h3><div align='center'><table style='width:80%' border='1'>";
            echo "<tr><th><form action='feedback_processing.php?task_id=$task_id' method='post' enctype='multipart/form-data'>"
                . "<th><h4>Rating (Integer From 1 [poor] to 5 [great]):&nbsp;</h4></th>"
                        . "<th><input type='number' name='$rating_id' min='1' max='5' id='$rating_id' required></th>"
                        . "<tr><th><h4>Feedback:&nbsp;</h4></th>"
                        . "<th><th><input type='text' name='$feedback_id' id='$feedback_id'></th></tr></table><br/>"
                . "<input type='submit' value='Submit' name='submit' align='center' style='font-family:Old Standard;' required></form></div><br/>";
            
        }
        echo "<div align='center'><h3><a href = 'viewtask.php?task_id=$task_id' style='font-family:Old Standard;font-size: 18px'>Back</a></h3></div>";
        ?>
        
    </body>
</html>

