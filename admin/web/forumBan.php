

<?php
include 'config.php';
include 'session.php';

$id = $_SERVER['QUERY_STRING'];

// echo " >>>>> ".$id;


if ($id == null || $id == ''){
	echo "<br/>case 01";
	header("Location:forumMain.php");
}

else {
	echo "<br/>case 02";
	$statement1 = "UPDATE thread SET status = 'ban' WHERE id = '$id';" ;
	echo "<br/>" . $statement1;
	$result1 = mysqli_query($db , $statement1);
	header("Location:forumMain.php");
}


?>