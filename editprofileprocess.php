<?php

include('session.php');
$name  = $_POST['name'];
$email = $_POST['email'];
$sql = "UPDATE account SET name = '$name', email = '$email' WHERE username = '$login_session';";

echo "<br>";
echo "<br>";
		
		$result002 = mysqli_query($db, $sql);
		if (!$result002) { echo "An error occurred while updating your profile <br><br>";}
		else{	echo "Profile updated successfully <br><br>"; 	}	
?>
	
	
	
	<br>
	<br>
	<a href="welcome.php"> Back </a>