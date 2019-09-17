<a href="welcome.php"><b><font color='green'>BACK</font> </b></a>
<br><br>
<h2>=====================================</h2> 

<?php
//reviews from creators
include 'config.php';
include 'session.php';

$user = $_SESSION['login_user'];
$sql = "SELECT * FROM bid WHERE bidder_name = '$user' AND is_winning_bid = 'TRUE' AND feedback_from_creator IS NOT NULL;";
$result = mysqli_query($db, $sql);

echo"<h3>Reviews for <font color='blue'><b>$user</b></font> </h3>";

//select creator
if (mysqli_num_rows($result) > 0) {
    echo "<h4>Reviews from Requesters</h4>";
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

//select bidder
if (mysqli_num_rows($result1) > 0) {
    echo "<table style='width:100%'>";
    
    while ($row1 = mysqli_fetch_row($result1)) {
        $query_bid = "SELECT * FROM bid WHERE task_id = '$row1[0]' AND is_winning_bid = 'true' AND feedback_to_creator IS NOT NULL;";
        $result_bid = mysqli_query($db, $query_bid);

        if (mysqli_num_rows($result_bid) > 0) {
            
            $headline=true;

            while ($bid = mysqli_fetch_row($result_bid)) {
                if ($headline == true){
                    echo "<h4>Reviews from Taskers</h4>";
                }
                $query_bidder = "SELECT * FROM account WHERE username = '$bid[1]';";
                $result_bidder = mysqli_query($db, $query_bidder);
                $account = mysqli_fetch_row($result_bidder);
                echo '<tr><th><img src = "/img/account/' . $account[5] .
                '" style="height:10%;"></th><th>' . $account[0] .
                '</th><th>Rating: ' . $bid[9] .
                '</th><th>Feedback: ' . $bid[8] .
                '</th></tr>';
                $headline == false;
            }
            
        }
    }
    echo "</table>";
}
?>






