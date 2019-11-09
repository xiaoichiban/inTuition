<?php 
  $db = mysqli_connect("localhost", "admin", "admin", "petdb");
  
  if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
	}
?>