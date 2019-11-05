<?php

  include 'config.php';
  include 'session.php';

  $tc = $_SESSION['login_user'];
  $module_id = mysqli_real_escape_string($db, $_POST['moduleid']);
  $quiztitle = mysqli_real_escape_string($db, $_POST['quiztitle']);

  $sql = "INSERT INTO quiz (quiztitle, moduleid)
  VALUES ('$quiztitle','$module_id')";


  if ($db->query($sql) === TRUE) {
      echo $quiztitle . " created successfully!";
      $sql1 = "SELECT id FROM quiz WHERE quiztitle = '$quiztitle' AND moduleid = '$module_id'; ";
      $result1 = mysqli_query($db, $sql1);
      $row = mysqli_fetch_row($result1);

      if (mysqli_num_rows($result1) != 1) {
        echo "invalid module $module_id";
      } else {
        echo "<h3><a href = 'createQuestion.php?quizid=". $row[0] ."'>Create questions</a></h3>";
      }

  } else {
      echo "Error: " . $sql . "<br>" . $db->error;
  }

?>
