<?php

include('config.php');


// POST OK
if (isset($_POST['id'])) { 
  	
	$id = $_POST['id'];
	$thisusername = $_SESSION['username'];
	
	
	// all is good
	echo"<center>";
	$deleteSQL = "DELETE FROM video WHERE id = '$id'";
	
	if ($db->query($deleteSQL) === TRUE) {
		echo "<b> We are getting it done ! </b>";
		echo "<p> <img src='./shredder.gif' class='img-fluid' alt='Responsive image'> </p>";
	} 
	else {
		echo "Error deleting record: " . $db->error;
	}

	
	// REDIRECT
	echo "<meta http-equiv='refresh' content='4;url=tutordashboard.php'>";
	echo"</center>";
	
}


// NOT POST
else {
	echo "<h3 align='center'> Nothing to Show </h3>";
	echo "<meta http-equiv='refresh' content='4;url=tutordashboard.php'>";
}





?>