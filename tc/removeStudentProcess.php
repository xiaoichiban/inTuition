<?php

  include '../config.php';
  include '../session.php';

  $tc = $_SESSION['login_user'];
  $student = mysqli_real_escape_string($db, $_POST['username']);
  $mod_id = mysqli_real_escape_string($db, $_POST['mod_id']);

  $sql = "DELETE FROM enroll WHERE student = '$student' AND mod_id = $mod_id";

  if ($db->query($sql) === TRUE) {
      echo $student . " removed from ". $mod_id . " successfully!";
  } else {
      echo "Error: " . $sql . "<br>" . $db->error;
  }

header('Location: tcModuleManagement.php');
?>
