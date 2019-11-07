<?php

  include 'config.php';
  include 'session.php';

  $student = $_SESSION['login_user'];
  $quiz_id = $_GET['quizid'];

  $sql1 = "SELECT * FROM question WHERE quizid = '$quiz_id'; ";
  $result1 = mysqli_query($db, $sql1);

  $totalCorrect = 0; 

  while ($row1 = mysqli_fetch_row($result1)) {
    $questionid = $row1[0];
    $attemptedans = mysqli_real_escape_string($db, $_POST['qns' .$questionid. 'ans']); 
    
    if ($attemptedans == $row1[6]) { //if answer is correct 
      $sql = "INSERT INTO attempts (attemptedans, quizid, questionid, student, isCorrect)
      VALUES ('$attemptedans', '$quiz_id', '$questionid', '$student', '1')";

      $result = mysqli_query($db, $sql);

      $totalCorrect++; 
    } else {
      $sql = "INSERT INTO attempts (attemptedans, quizid, questionid, student, isCorrect)
      VALUES ('$attemptedans', '$quiz_id', '$questionid', '$student', '0')";

      $result = mysqli_query($db, $sql);
    }
  
  }

  if ($result) {
    echo "Submitted answers successfully! <br>";
    echo $totalCorrect . "/" . mysqli_fetch_row(mysqli_query($db, "SELECT count(*) FROM question WHERE quizid = '$quiz_id';"))[0] . " correct" ;

  } else {
    echo "Error: " . $sql . "<br>" . $db->error;
  }

  echo "<h3><a href = 'viewquiz.php?quizid=".$quiz_id."'>Back to quiz</a></h3>";
?>
