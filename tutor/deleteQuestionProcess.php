<?php

include('config.php');
// POST OK
if (isset($_POST['id'])) { 
    
  $id = $_POST['id'];
  
  // all is good
  echo"<center>";
  $questionSQL = "SELECT quizid FROM question WHERE id = '$id'";
  $questionResult = mysqli_query($db, $questionSQL); 
  $quiz_id = mysqli_fetch_row($questionResult)[0];

  echo $quiz_id; 

  $deleteSQL = "DELETE FROM question WHERE id = '$id'";
  
  if ($db->query($deleteSQL) === TRUE) {
    header("Location: viewquiz.php?quizid=$quiz_id");
  } 
  else {
    echo "Error deleting record: " . $db->error;
  }
}
// NOT POST
else {
  echo "<h3 align='center'> Nothing to Show</h3>";
  header("Location: viewquiz.php?quizid=$quiz_id");
}

?>