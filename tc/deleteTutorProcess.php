<?php

  include '../config.php';
  include '../session.php';

  $tc = $_SESSION['login_user'];
  $tutor_id = $_GET['tutor_id'];
  // $tc_owner = mysqli_real_escape_string($db, $_POST['tc']);

echo"Tutor ID is $tutor_id";

  $sql = "UPDATE account SET status = 'deactivate' WHERE account.username = (SELECT username FROM tutor WHERE tutor.id = $tutor_id)";

  if ($db->query($sql) === TRUE) {
      echo $tutor_id . " account deactivted successfully!";
  } else {
      echo "Error: " . $sql . "<br>" . $db->error;
  }

header('Location: tcTutorManagement.php');
?>
