<?php

  include '../config.php';
  include '../session.php';

  $tc = $_SESSION['login_user'];
  $student = mysqli_real_escape_string($db, $_POST['username']);
  $mod_id = mysqli_real_escape_string($db, $_POST['mod_id']);
  echo $mod_id . " and " . $student;
?>
