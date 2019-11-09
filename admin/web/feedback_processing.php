<?php

include('config.php');
include('session.php');
error_reporting(E_ALL);
ini_set('display_errors', '1');

$task_id = $_GET['task_id'];
$thisuser = $_SESSION['login_user'];
$sqlquery = mysqli_query("SELECT * FROM task WHERE task_id = '$task_id';");
$row = mysqli_fetch_row($sqlquery);
$creator = $row[1];

//if user is creator
if ($creator == $thisuser) {

    $result = mysqli_query("SELECT * FROM bid WHERE task_id ='$task_id' AND is_winning_bid = 'true';");
    if (mysqli_num_rows($result) > 0) {
        //insert feedback into database
        $count = 1;
        while ($row = mysqli_fetch_row($result)) {

            $rating_id = "rating" . "$row[1]";
            $feedback_id = "feedback" . "$row[1]";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $user = $row[1];
                $rating = $_POST[$rating_id];
                $feedback = $_POST[$feedback_id];
                
                $sql = "UPDATE bid SET \"feedback_from_creator\" = '$feedback', \"rating_from_creator\" = '$rating' WHERE task_id = '$task_id' AND bidder_name = '$user';";
                $results = mysqli_query($db, $sql);
                
                if ($results && ($count == mysqli_num_rows($result))) {
                    echo "<script type = 'text/javascript'> alert ('Thank you for your feedback!!')</script>";
                } else if (!$results){
                    echo "<script type = 'text/javascript'> alert ('Error in Submission!!')</script>";
                }
                
            }
            $count++;
        }
    }
}

//if user is tasker
else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $rating_id = "rating" . $thisuser;
        $feedback_id = "feedback" . $thisuser;
        $rating = $_POST[$rating_id];
        $feedback = $_POST[$feedback_id];
        $sql = "UPDATE bid SET \"feedback_to_creator\" = '$feedback', \"rating_to_creator\" = '$rating' WHERE task_id = '$task_id' AND bidder_name = '$thisuser';";
        $results = mysqli_query($db, $sql);
        if ($results) {
            echo "<script type = 'text/javascript'> alert ('Thank you for your feedback!!')</script>";
        } else {
            echo "<script type = 'text/javascript'> alert ('Error in Submission!!')</script>";
        }
        
    }
}
//echo '<script>window.location.href = "welcome.php";</script>';
?>

