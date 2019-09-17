<?php
include('session.php');
$thisuser = $_SESSION['login_user']; 
date_default_timezone_set("Singapore");
$date=date('Y-m-d');
$task_id=$_GET['task_id'];

$bidresult="";
$resultstatus="";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    //trigger validate to stop all changes after date of expiry
    //trigger validate to make bids invalid and send message notification when date of expiry/completion is changed
	
    $task_name = mysqli_escape_string($db,$_POST['task_name']);
    $description = mysqli_escape_string($db,$_POST['description']);
    $location = mysqli_escape_string($db,$_POST['location']);
    $time_of_service = mysqli_escape_string($db,$_POST['time_of_service']);
    $date_of_publishing = mysqli_escape_string($db,$_POST['date_of_publishing']);
    $bidding_deadline = mysqli_escape_string($db,$_POST['bidding_deadline']); //triggers set all bids to invalid
    $number_of_winning_bids_requirement = mysqli_escape_string($db,$_POST['number_of_winning_bids_requirement']);
    $date_of_expiry = mysqli_escape_string($db,$_POST['date_of_expiry']);
    $date_of_service = mysqli_escape_string($db,$_POST['date_of_service']);
    $requested_ideal_price = mysqli_escape_string($db,$_POST['requested_ideal_price']);
    $approve = mysqli_escape_string($db,$_POST['approve']);
	
	$update = 
	"UPDATE task 
	SET task_name='$task_name', 
	description='$description', 
	location='$location', 
	time_of_service='$time_of_service', 
	date_of_publishing='$date_of_publishing', 
	bidding_deadline='$bidding_deadline',
	number_of_winning_bids_requirement=$number_of_winning_bids_requirement, 
	date_of_expiry='$date_of_expiry', 
	date_of_service='$date_of_service', 
	requested_ideal_price='$requested_ideal_price' ,
	is_approved = '$approve'
	WHERE task_id= '$task_id';";
	
    $tags = mysqli_escape_string($db,$_POST['tags']);
	mysqli_query($db, "DELETE FROM tag WHERE task_id=$task_id;");
	$tagsArray = explode(',', str_replace(' ', '', $tags));
	foreach($tagsArray as $tagsi){
		mysqli_query($db, "INSERT INTO tag VALUES ($task_id, '$tagsi'); ");
	}
	
	if (mysqli_query($db, $update)) {
		header("Location: viewtask.php?task_id=$task_id");
	}
	else {
		$resultstatus='unsuccessful';
	}
}
	
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
	else if(date("Y-m-d")>=$row[6] && date("Y-m-d")<=$row[7]){
		$phase = 'open bidding';
	}
	else if(date("Y-m-d")<$row[7] && date("Y-m-d")<=$row[9]){
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
	$task_id=$row[0];
	$requester_name=$row[1];
	$task_name= $row[2];
	$description= $row[3];
	$location=$row[4];
	$time_of_service=$row[5];
	$date_of_publishing=$row[6];
	$bidding_deadline= $row[7];
	$number_of_winning_bids_requirement=$row[8];
	$date_of_expiry= $row[9];
	$date_of_service=$row[10];
	$requested_ideal_price=$row[11];
	
	
	$approve=$row[12];
	
	
	
	$tagString="";
	$result = mysqli_query($db, "SELECT tag FROM tag WHERE task_id=$task_id;");
	if(mysqli_num_rows($result) > 0) {
		$tagString = mysqli_fetch_row($result)[0];
		while($row = mysqli_fetch_row($result)) {
			$tagString = $tagString.", ".$row[0];
		}
	}
}

echo "
	<form action='taskeditor.php?task_id=$task_id' method = 'post'>
	<table style='width:50%' border='1'>
	<tr style='display:none'><th>task_id</th><th><input type = 'text' name = 'task_id' value='$task_id' /></th></tr>
	<tr><th>task_name</th><th><input type = 'text' name = 'task_name' value='$task_name' /></th></tr>
	<tr><th>description</th><th><input type = 'text' name = 'description' value='$description' /></th></tr>
	<tr><th>tags</th><th><input type = 'text' name = 'tags' value='$tagString' /></th></tr>
	<tr><th>location</th><th><input type = 'text' name = 'location' value='$location' /></th></tr>
	<tr><th>time_of_service</th><th><input type = 'text' name = 'time_of_service' value='$time_of_service' /></th></tr>
	<tr><th>date_of_publishing</th><th><input type = 'text' name = 'date_of_publishing' value='$date_of_publishing' /></th></tr>
	<tr><th>bidding_deadline</th><th><input type = 'text' name = 'bidding_deadline' value='$bidding_deadline' /></th></tr>
	<tr><th>number_of_winning_bids_requirement</th><th><input type = 'text' name = 'number_of_winning_bids_requirement' value='$number_of_winning_bids_requirement' /></th></tr>
	<tr><th>date_of_expiry</th><th><input type = 'text' name = 'date_of_expiry' value='$date_of_expiry' /></th></tr>
	<tr><th>date_of_service</th><th><input type = 'text' name = 'date_of_service' value='$date_of_service' /></th></tr>
	<tr><th>requested_ideal_price</th><th><input type = 'text' 
	name = 'requested_ideal_price' value='$requested_ideal_price' /></th></tr>		
	<tr><th>approved</th><th>
	<select name='approve'>
	<option value='1'>true (1)</option>
	<option value='0'>false (0)</option>
	</select>
	
	</th></tr>
	
	
	
	
	
	</table>

	<input type = 'submit' value = 'update'/>
</form>$resultstatus
";
echo "<h3><a href = 'viewtask.php?task_id=$task_id'>Back</a></h3>";
?>
