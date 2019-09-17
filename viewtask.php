<!DOCTYPE html>
<html>
    <head>
        <title>TASK MASTER</title>
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

            #task {
                border-collapse: collapse;
                width: 80%;
                color: black;
            }

            #task th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #task th:nth-child(even){
                background-color: white;
                color: black;
            }

            #task th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: #3E8DB5;
                color: white;
            }

            #task tr:hover th{
                background-color: #D0F9F9;
                color: black;
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
        <div align='center'>
            <?php
            /* things not done

			admin search task column names
			Search by flag counts


             */
            include('session.php');
            $thisuser = $_SESSION['login_user'];

            date_default_timezone_set("Singapore");
            $date = date('Y-m-d');
            $task_id = $_GET['task_id'];

            $sql = "SELECT * FROM task WHERE task_id = '$task_id'; ";
            $result = pg_query($db, $sql);
            $row = pg_fetch_row($result);
            if (pg_num_rows($result) != 1) {
                echo " invalid task $task_id";
            } else if ($row[12] !== 't') {
                echo "task is removed by admin";
            } else {
                if (date("Y-m-d") < $row[6]) {
                    $phase = 'unpublished';
                } else if ($row[6] <= date("Y-m-d") && date("Y-m-d") <= $row[7]) {
                    $phase = 'open bidding';
                } else if ($row[7] < date("Y-m-d") && date("Y-m-d") < $row[9]) {
                    $phase = 'closed bidding';
                } else if ($row[9] <= date("Y-m-d") && date("Y-m-d") <= $row[10]) {
                    //check if the number of winning bids selected reached the requirement
                    $sql = "SELECT (number_of_winning_bids_requirement-(SELECT COUNT(*) FROM bid WHERE task_id = '$task_id' AND is_winning_bid='TRUE' AND is_valid='TRUE')) FROM task WHERE task_id='$task_id'; ";
                    $status = pg_fetch_row(pg_query($db, $sql))[0];
                    if ($status == 0) {
                        $phase = 'confirmed';
                    } else {
                        $phase = 'expired';
                    }
                } else if ($row[10] < date("Y-m-d")) {
                    //check if a feedback record exist for this task
                    $sql = "SELECT * FROM bid WHERE task_id = '$task_id' AND is_winning_bid='TRUE' AND is_valid='TRUE';";
                    $complete = false;
                    if ($thisuser == $row[1]) { //user is creator
                        $feedback_given = pg_fetch_row(pg_query($db, $sql))[6];
                    } else if ($thisuser == pg_fetch_row(pg_query($db, $sql))[1]) {//user is tasker
                        $feedback_given = pg_fetch_row(pg_query($db, $sql))[8];
                        $feedback_received = pg_fetch_row(pg_query($db, $sql))[6];
                    }

                    if ($feedback_given == null && $thisuser == $row[1]) {
                        $phase = 'pending';
                        $complete = true;
                    } else if ($feedback_given == null && $feedback_received != null) {
                        $phase = 'completed';
                        $complete = true;
                    } else {
                        $phase = 'completed';
                    }
                }


                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $flip_flag = pg_escape_string($db, $_POST['flip_flag']);
                    if ($row[1] != $thisuser && $row[12] === 't') {
                        if ($flip_flag == 0) {
                            $delete = "INSERT INTO flag VALUES ($task_id, '$thisuser');";
                            pg_query($db, $delete);
                        } else {
                            $update = "DELETE FROM flag WHERE task_id=$task_id AND flagger='$thisuser'; ";
                            pg_query($db, $update);
                        }
                    }
                }

                $tagString = "";
                $result = pg_query($db, "SELECT tag FROM tag WHERE task_id=$task_id;");
                if (pg_num_rows($result) > 0) {
                    $tagString = pg_fetch_row($result)[0];
                    while ($tagrow = pg_fetch_row($result)) {
                        $tagString = $tagString . ", " . $tagrow[0];
                    }
                }

                echo
                "<table id='task' style='width:80%' border='1'>" .
                "<tr><th>Task Id</th><th>" . $row[0] . "</th></tr>" .
                "<tr><th>Requester Name</th><th>" . $row[1] . "</th></tr>" .
                "<tr><th>Task Name</th><th>" . $row[2] . "</th></tr>" .
                "<tr><th>Description</th><th>" . $row[3] . "</th></tr>" .
                "<tr><th>Tags</th><th>" . $tagString . "</th></tr>" .
                "<tr><th>Location</th><th>" . $row[4] . "</th></tr>" .
                "<tr><th>Time of Service</th><th>" . $row[5] . "</th></tr>" .
                "<tr><th>Date of Publishing</th><th>" . $row[6] . "</th></tr>" .
                "<tr><th>Bidding Deadline</th><th>" . $row[7] . "</th></tr>" .
                "<tr><th>Number of Required Bids</th><th>" . $row[8] . "</th></tr>" .
                "<tr><th>Date of Expiry</th><th>" . $row[9] . "</th></tr>" .
                "<tr><th>Date of Service</th><th>" . $row[10] . "</th></tr>" .
                "<tr><th>Current Phase</th><th>" . $phase . "</th></tr>" .
                "<tr><th>Price Offered</th><th>" . $row[11] . "</th></tr>" .
                "<tr><th>Flagged by Users</th><th>" . pg_fetch_row(pg_query($db, "SELECT COUNT(*) FROM flag WHERE task_id = '$task_id'; "))[0] . "</th></tr>" .
                "<tr><th>Task Approved</th><th>" . $row[12] . "</th></tr>" .
                "<tr><th>Number of Bids</th><th>" . pg_fetch_row(pg_query($db, "SELECT COUNT(*) FROM bid WHERE is_valid='TRUE' AND task_id = '$task_id'; "))[0] . "</th></tr>" .
                "<tr><th>View Bids:&nbsp;</th><th><a href = 'bidpage.php?task_id=$task_id'>bids</a></th></tr>" .
                "</table>";

                $flagged = pg_num_rows(pg_query($db, "SELECT flagger FROM flag WHERE task_id = $task_id AND flagger='$thisuser'; "));
                $submitmessage = "flag";
                if ($flagged > 0) {
                    $submitmessage = "unflag";
                }

                if ($row[1] != $thisuser) {
                    echo "<form action='viewtask.php?task_id=$task_id' method = 'post'>
    <input type = 'text' name = 'flip_flag' value='$flagged' style='display:none' />
    <input type = 'submit' value = '$submitmessage'/>
</form>";
                }
                if ($row[1] != $thisuser) {
                    echo '<div style="text-align: center;"><h2>Requester: ' . $row[1] . '</h2></div>';
                    $username = $row[1];
                    $sql1 = "SELECT avatar_path FROM account WHERE username = '$username';";
                    $result1 = pg_query($db, $sql1);
                    $requester = pg_fetch_array($result1, pg_fetch_assoc);
                    echo '<div style="text-align: center;"><img src = "/img/account/' . $requester['avatar_path'] . '" style="height:30%;"></div>';

                    $sql2 = "SELECT * FROM bid WHERE bidder_name = '$row[1]' AND is_winning_bid = 'true' AND feedback_from_creator IS NOT NULL;";
                    $result2 = pg_query($db, $sql2);

                    //select creator
                    if (pg_num_rows($result2) > 0) {
                        echo '<h4>Reviews from Requesters</h4>';
                        echo '<table style="width:100%">';

                        while ($requester = pg_fetch_row($result2)) {
                            $query_task = "SELECT * FROM task WHERE task_id = '$requester[2]';";
                            $result_task = pg_query($db, $query_task);
                            $task = pg_fetch_row($result_task);

                            $query_requester = "SELECT * FROM account WHERE username = '$task[1]';";
                            $result_requester = pg_query($db, $query_requester);
                            $account = pg_fetch_row($result_requester);
                            echo '<tr><th><img src = "/img/account/' . $account[5] . '" style="height:10%;"></th><th>' . $account[0] . '</th><th>Rating: ' . $requester[7] . '</th><th>Feedback: ' . $requester[6] . '</th></tr>';
                        }
                        echo "</table>";
                    }
                    //reviews from taskers
                    $sql3 = "SELECT * FROM task WHERE requester_name = '$row[1]';";
                    $result3 = pg_query($db, $sql3);

                    //select bidder
                    if (pg_num_rows($result3) > 0) {
                        echo "<table style='width:100%'>";
                        echo "<h4>Reviews from Taskers</h4>";
                        while ($requester = pg_fetch_row($result3)) {
                            $query_bid = "SELECT * FROM bid WHERE task_id = '$requester[0]' AND is_winning_bid = 'true' AND feedback_to_creator IS NOT NULL;";
                            $result_bid = pg_query($db, $query_bid);

                            if (pg_num_rows($result_bid) > 0) {

                                while ($bid = pg_fetch_row($result_bid)) {
                                    $query_bidder = "SELECT * FROM account WHERE username = '$bid[1]';";
                                    $result_bidder = pg_query($db, $query_bidder);
                                    $account = pg_fetch_row($result_bidder);
                                    echo '<tr><th><img src = "/img/account/' . $account[5] . ' style="height:10%;"></th><th>' . $account[0] . '</th><th>Rating: ' . $bid[9] . '</th><th>Feedback: ' . $bid[8] . '</th></tr>';
                                }
                            }
                        }
                        echo "</table>";
                    }
                }

                if ($row[1] == $thisuser && $phase != 'pending' && $phase != 'completed' && $phase != 'expired' && $phase != 'confirmed')
                    echo "<h3><a href = 'taskeditor.php?task_id=$task_id'>Edit Task</a></h3>";

                if ($row[1] == $thisuser && $phase == 'pending' && $complete == true)
                    echo "<h3><a href = 'feedback.php?task_id=$task_id'>Complete Task</a></h3>";
                else if ($row[1] != $thisuser && $complete == true)
                    echo "<h3><a href = 'feedback.php?task_id=$task_id'>Submit Feedback</a></h3>";
            }
            ?>
            <h3><a href = "welcome.php">Back</a></h3>
        </div>
    </body>
</html> 
