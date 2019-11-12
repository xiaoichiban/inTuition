<?php

include('config.php');


// POST OK
if (isset($_POST['id'])) {

	$id = $_POST['id'];


	// all is good
	echo"<center><br><br><br>";
	$deleteSQL = "DELETE FROM video WHERE id = '$id'";

	if ($db->query($deleteSQL) === TRUE) {
		echo "<h2><b> We are getting it done ! </b></h2>";
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
