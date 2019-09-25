<?php 
  $conn = mysqli_connect("localhost", "admin", "admin", "petdb");
  
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	}
?>