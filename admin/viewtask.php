<?php
include('session.php');
$thisuser = $_SESSION['login_user']; 

date_default_timezone_set("Singapore");
$date=date('Y-m-d');
$task_id=$_GET['task_id'];

$sql = "SELECT * FROM task WHERE task_id = '$task_id'; ";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_row($result);
if(mysqli_num_rows($result) != 1) {
	echo " invalid task $task_id";
}

else{
	if(date("Y-m-d")<$row[6]){
		$phase = 'unpublished';
	}
	else if($row[6]<=date("Y-m-d") && date("Y-m-d")<=$row[7]){
		$phase = 'open bidding';
	}
	else if($row[7]<date("Y-m-d") && date("Y-m-d")<=$row[9]){
		$phase = "closed bidding";
	}
	else if($row[9]<date("Y-m-d") && date("Y-m-d")<=$row[10]){
		//check if the number of winning bids selected reached the requirement
		$sql="SELECT (number_of_winning_bids_requirement-(SELECT COUNT(*) FROM bid WHERE task_id = '$task_id' AND is_winning_bid='TRUE' AND is_valid='TRUE')) FROM task WHERE task_id='$task_id'; ";
		$status = mysqli_fetch_row(mysqli_query($db,$sql))[0];
		if($status==0){
			$phase = 'confirmed';
		}
		else{
			$phase = 'expired';
		}
	}
	else if(date("Y-m-d") > $row[10]){
		//check if a feedback record exist for this task
            $sql = "SELECT * FROM bid WHERE task_id = '$task_id' AND is_winning_bid='TRUE' AND is_valid='TRUE';";
            $complete = false;
            if ($thisuser == $row[1]){ //user is creator
                $feedback_given= mysqli_fetch_row(mysqli_query($db,$sql))[6];
                
            }
            else if ($thisuser == mysqli_fetch_row(mysqli_query($db,$sql))[1]){//user is tasker
                $feedback_given= mysqli_fetch_row(mysqli_query($db,$sql))[8];
                $feedback_received = mysqli_fetch_row(mysqli_query($db,$sql))[6];
                
            }
                
		if($feedback_given == null && $thisuser = $row[1]){
			$phase = 'pending';
                        $complete = true;
		}
                else if ($feedback_given == null && $feedback_received != null){
                        $phase = 'completed';
                        $complete = true;
                }
		else{
			$phase = 'completed';
		}
	}
	
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$flip_flag = mysqli_escape_string($db,$_POST['flip_flag']);
		if($row[1]!=$thisuser && $row[13]==='t'){
			if($flip_flag==0){
				$delete="INSERT INTO flag VALUES ($task_id, '$thisuser');";
				mysqli_query($db, $delete);
			}
			else{
				$update = "DELETE FROM flag WHERE task_id=$task_id AND flagger='$thisuser'; ";
				mysqli_query($db, $update);
			}
		}
	}
	
	$tagString="";
	$result = mysqli_query($db, "SELECT tag FROM tag WHERE task_id=$task_id;");
	if(mysqli_num_rows($result) > 0) {
		$tagString = mysqli_fetch_row($result)[0];
		while($tagrow = mysqli_fetch_row($result)) {
			$tagString = $tagString.", ".$tagrow[0];
		}
	}
		
    echo
	"<table style='width:50%' border='1'>" .
	"<tr><th>task_id</th><th>". $row[0] . "</th></tr>" .
	"<tr><th>requester_name</th><th><a href='viewprofile.php?". $row[1] . "'>$row[1]</a></th></tr>" .
	"<tr><th>task_name</th><th>". $row[2] . "</th></tr>" .
	"<tr><th>description</th><th>". $row[3] . "</th></tr>" .
	"<tr><th>tags</th><th>". $tagString . "</th></tr>" .
	"<tr><th>location</th><th>". $row[4] . "</th></tr>" .
	"<tr><th>time_of_service</th><th>". $row[5] . "</th></tr>" .
	"<tr><th>date_of_publishing</th><th>". $row[6] . "</th></tr>" .
	"<tr><th>bidding_deadline</th><th>". $row[7] . "</th></tr>" .
	"<tr><th>number_of_winning_bids_requirement</th><th>". $row[8] . "</th></tr>" .
	"<tr><th>date_of_expiry</th><th>". $row[9] . "</th></tr>" .
	"<tr><th>date_of_service</th><th>". $row[10] . "</th></tr>" .
	"<tr><th>current phase</th><th>". $phase . "</th></tr>" .
	"<tr><th>requested_ideal_price</th><th>". $row[11] . "</th></tr>" .
	"<tr><th>user_flags</th><th>". mysqli_fetch_row(mysqli_query($db,"SELECT COUNT(*) FROM flag WHERE task_id = '$task_id'; "))[0] . "</th></tr>" .
	"<tr><th>is_approved</th><th>". $row[12] . "</th></tr>" .
	"<tr><th>number of bids</th><th>". mysqli_fetch_row(mysqli_query($db,"SELECT COUNT(*) FROM bid WHERE task_id = '$task_id'; "))[0] . "</th></tr>" .
	"<tr><th>view bids here: </th><th><a href = 'bidpage.php?task_id=$task_id'>bids</a></th></tr>" .
	"</table>";
	
	$flagged=mysqli_num_rows(mysqli_query($db,"SELECT flagger FROM flag WHERE task_id = $task_id AND flagger='$thisuser'; "));
	$submitmessage="flag";
	if($flagged>0){
		$submitmessage="unflag";
	}
	
	echo "<h3><a href = 'taskeditor.php?task_id=$task_id'>Edit Task</a></h3>";
		
}
?>
<h3><a href = "welcome.php">Back</a></h3>