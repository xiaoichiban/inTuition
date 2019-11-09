

<?php
include 'config.php';
include 'session.php';

$id = $_SERVER['QUERY_STRING'];

if ($id == null || $id = ''){
	header("Location:forumMain.php");
}

else {
	$statement1 = "UPDATE thread SET status = 'ban' WHERE id = '$id';" ;
	$result1 = mysqli_query($db , $statement1);
	header("Location:forumMain.php");
}


?>