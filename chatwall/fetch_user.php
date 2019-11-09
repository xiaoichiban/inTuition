<?php

//fetch_user.php

include('session.php');


// OLD
// $query = "SELECT * FROM account WHERE user_id != '".$_SESSION["user_id"]."' ";
// $thisusername = $_SESSION["username"];


/*
$query = "
SELECT a.user_id , a.username , a.status , a.last_seen , 
about_me, a.email, a.profilepic, a.status, a.last_login, a.date_registered
FROM account a , followtable f
WHERE a.username =   f.leader
AND f.leader != f.follower
AND f.follower = '$thisusername'
GROUP BY a.user_id
; ";
*/




$thisusername = $_SESSION["username"];
$query = "SELECT * FROM account WHERE username != '".$_SESSION["username"]."' ";


// $query = "SELECT * FROM account a WHERE a.username; ";
//AND a.username != '$thisusername'




$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

$output = '<table class="table table-bordered table-striped">
			<tr><th width="50%">Username</td>
				<th width="10%">Status</td>
				<th width="10%">Action</td>
				<th width="30%">Last Seen</td>
				
				</tr> ';

foreach($result as $row)
{
	$status = '';
	$current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
	$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
	$user_last_activity = fetch_user_last_activity($row['user_id'], $connect);
	if($user_last_activity > $current_timestamp)
	{
		$status = '<span class="label label-success">Online</span>';
	}
	else
	{
		$status = '<span class="label label-danger">Offline</span>';
	}
	$output .= '
	<tr>
		<td>'.$row['username'].' '.count_unseen_message($row['user_id'], $_SESSION['user_id'], $connect).' '.fetch_is_type_status($row['user_id'], $connect).'</td>
		<td>'.$status.'</td>
		<td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['username'].'">Start Chat</button></td>
		<td>'.$user_last_activity.'</td>
	</tr>
	';
}

$output .= '</table>';

echo $output;

?>