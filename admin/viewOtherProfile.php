<?php

//reviews from creators
include 'config.php';

$user = $_GET['review_id'];

$task_id = $_GET['task_id'];

$sql1 = "SELECT avatar_path FROM account WHERE username = '$user';";
        $result1 = mysqli_query($db, $sql1);
        $requester = mysqli_fetch_array($result1, mysqli_fetch_assoc);
        echo '<div style="text-align: center;"><img src = "/img/account/' . $requester['avatar_path'] . '" style="height:30%;"></div>';
$sql = "SELECT * FROM bid WHERE bidder_name = '$user' AND is_winning_bid = 'true' AND feedback_from_creator IS NOT NULL;";
$result = mysqli_query($db, $sql);

echo"<div style='text-align: center;'><h3>Reviews for <font color='blue'><b>$user</b></font> </h3></div>";

//select creator
if (mysqli_num_rows($result) > 0) {
    echo "<div style='text-align: center;'><h4>Reviews from Requesters</h4></div>";
    echo "<table style='width:100%'>";

    while ($row = mysqli_fetch_row($result)) {
        $query_task = "SELECT * FROM task WHERE task_id = '$row[2]';";
        $result_task = mysqli_query($db, $query_task);
        $task = mysqli_fetch_row($result_task);

        $query_requester = "SELECT * FROM account WHERE username = '$task[1]';";
        $result_requester = mysqli_query($db, $query_requester);
        $account = mysqli_fetch_row($result_requester);
        echo '<tr><th><img src = "/img/account/' . $account[5] .
        '" style="height:10%;"></th><th>' . $account[0] .
        '</th><th>Rating: ' . $row[7] .
        '</th><th>Feedback: ' . $row[6] .
        '</th></tr>';
    }
    echo "</table>";
}
//reviews from taskers

$sql1 = "SELECT * FROM task WHERE requester_name = '$user';";
$result1 = mysqli_query($db, $sql1);
$headline=true;
//select bidder
if (mysqli_num_rows($result1) > 0) {
    echo "<table style='width:100%'>";
    
    while ($row1 = mysqli_fetch_row($result1)) {
        $query_bid = "SELECT * FROM bid WHERE task_id = '$row1[0]' AND is_winning_bid = 'true' AND feedback_to_creator IS NOT NULL;";
        $result_bid = mysqli_query($db, $query_bid);

        if (mysqli_num_rows($result_bid) > 0) {
            
            while ($bid = mysqli_fetch_row($result_bid)) {
                if($headline == true){
                    echo "<div style='text-align: center;'><h4>Reviews from Taskers</h4></div>";
                }
                $query_bidder = "SELECT * FROM account WHERE username = '$bid[1]';";
                $result_bidder = mysqli_query($db, $query_bidder);
                $account = mysqli_fetch_row($result_bidder);
                echo '<tr><th><img src = "/img/account/' . $account[5] .
                '" style="height:10%;"></th><th>' . $account[0] .
                '</th><th>Rating: ' . $bid[9] .
                '</th><th>Feedback: ' . $bid[8] .
                '</th></tr>';
                $headline = false;
            }
        }
        
    }
    echo "</table>";
}
echo "<div style='text-align: center;'><a href = 'bidpage.php?task_id=$task_id'><b><font color='green'>BACK</font> </b></a>
<br><br>
<h2>=====================================</h2> </div>"
?>






