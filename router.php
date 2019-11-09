<?php

session_start();
$thisusername = $_SESSION['username'];
$account_type = $_SESSION['account_type'];
		 
 if ($account_type == "student"){
	header("location: ./student/studentdashboard.php");
 }
 else if ($account_type == "tc"){
	header("location: ./tc/tcdashboard.php");
 }
 else if ($account_type == "tutor") {
	header("location: ./tutor/tutordashboard.php");
 }
 else {
	// header("location: loginFailed.php");
	echo "<br/><br/><h3 align='center'><font color='red'>LOGIN HERE</font></h3>";
 }

?>


