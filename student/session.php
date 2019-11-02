<?php


session_start();
// ob_start();

include('database_connection.php');
include('config.php');

/*

if($_SESSION['login_user'] == null)
	{ 
	header("location:login.php"); 
	}
else {
	
	 $query7777 = "UPDATE account SET last_seen = now() WHERE user_id = '".$_SESSION["user_id"]."'";
	 $statement7777 = $connect->prepare($query7777);
	 $statement7777->execute();
	
} 
*/

?>