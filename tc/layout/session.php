<?php
include('config.php');
session_start();
ob_start();
// include('database_connection.php');


if(!isset($_SESSION['username'])){
      header("location:loginPlease.php");
}

/*
if($_SESSION['username'] == null) { header("location:logout.php"); }
else if($_SESSION['user_id'] == null) { header("location:logout.php"); }
*/
else {
	
	$query7777 = "UPDATE account SET last_seen = now() WHERE username = '".$_SESSION["username"]."'";
	$statement7777 = $db->prepare($query7777);
	$statement7777->execute();
} 
?>