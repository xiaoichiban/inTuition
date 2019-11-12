<?php
include '../session.php';
include '../config.php';

// POST OK
if (isset($_GET['quizid']) && isset($_GET['status'])) { 
    
  $quizid = $_GET['quizid'];
  $status = $_GET['status'];
  
  // all is good
  $updateSQL = "UPDATE quiz SET status='$status' WHERE id ='$quizid'; ";
  
  if ($db->query($updateSQL) === TRUE) {
    header("Location: viewquiz.php?quizid=$quizid");
  } 
  else {
    echo "Error updating record: " . $db->error;
  }

 
}

// NOT POST
else {
  echo "<h3 align='center'> Nothing to Show </h3>";
  //echo "<meta http-equiv='refresh' content='4;url=tutordashboard.php'>";
}

?>