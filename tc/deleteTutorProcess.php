<?php

  include '../config.php';
  include '../session.php';

  $tc = $_SESSION['login_user'];
  $tutor_id = mysqli_real_escape_string($db, $_POST['tutor_id']);
  // $tc_owner = mysqli_real_escape_string($db, $_POST['tc']);

echo"Tutor ID is $tutor_id";

  $sql = "UPDATE account SET status = 'deactivate' WHERE account.username = (SELECT username FROM tutor WHERE tutor.id = $tutor_id)";

  if ($db->query($sql) === TRUE) {
      echo $username . " account deactivted successfully!";
  } else {
      echo "Error: " . $sql . "<br>" . $db->error;
  }

header('Location: tcTutorManagement.php');
?>
