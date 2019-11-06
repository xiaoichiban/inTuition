<?php

  include '../config.php';
  include '../session.php';

  $tc = $_SESSION['login_user'];
  $student = mysqli_real_escape_string($db, $_POST['username']);
  $mod_id = mysqli_real_escape_string($db, $_POST['mod_id']);

  $sql = "UPDATE enroll SET status = 'accepted' WHERE student = '$student' AND mod_id = $mod_id";

  if ($db->query($sql) === TRUE) {
      echo $student . " registered into ". $mod_id . " successfully!";
      $sql1 = "SELECT * FROM module WHERE id = '$mod_id';";
      $result1 = mysqli_query($db, $sql1);
      $row = mysqli_fetch_row($result1);
      $sql2 = "INSERT INTO notification (content, sender, receiver) VALUES ('You have successfully been registered into the module $row[1]', '$tc', '$student');";
      $result2 = mysqli_query($db, $sql2);
      if (!result2){
        echo "unsuccessful";
      }
      else{
        echo "successful";
      }
  } else {
      echo "Error: " . $sql . "<br>" . $db->error;

  }

header('Location: studentEnrollment.php');
?>
