<?php

include('layout.php');

if (isset($_POST['about_me']) && isset($_POST['email'])) { 
  	
	$about_me = $_POST['about_me'];
	$email = $_POST['email'];
	$color = $_POST['color'];
	$thisusername = $_SESSION['username'];
	
	
	//echo $about_me . "<br/>" .$email. "<br/>" . $thisusername ."<br/>";
	
	$sqlstatement = 
	"UPDATE account a SET a.email='$email' , a.about_me='$about_me' , a.color='$color'
	WHERE a.username='$thisusername' ; ";
	
	//echo $sqlstatement;
	
	$db->query($sqlstatement);
	echo "<meta http-equiv='refresh' content='0;url=myProfile.php'>";
	

	
}
else {
	echo "<h3 align='center'> Nothing to Show </h3>";
}
?>