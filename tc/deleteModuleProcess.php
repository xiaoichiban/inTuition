<?php

  include '../config.php';
  include '../session.php';

  $tc = $_SESSION['login_user'];
  $mod_id = $_GET['mod_id'];
  // $tc_owner = mysqli_real_escape_string($db, $_POST['tc']);

echo"Tutor ID is $tutor_id";

  $sql = "UPDATE module SET status = 'deactivate' WHERE id='$mod_id'";

  if ($db->query($sql) === TRUE) {
      echo $mod_id . " account deactivted successfully!";
  } else {
      echo "Error: " . $sql . "<br>" . $db->error;
  }

header('Location: tcModuleManagement.php');
?>
