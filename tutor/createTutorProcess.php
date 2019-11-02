<?php

  include 'config.php';
  include 'session.php';

  $tc = $_SESSION['login_user'];
  $username = mysqli_real_escape_string($db, $_POST['username']).strtolower();
  // $tc_owner = mysqli_real_escape_string($db, $_POST['tc']);

  $sql = "INSERT INTO tutor (username, tc_owner) VALUES ('$username', '$tc')";

  if ($db->query($sql) === TRUE) {
      echo $username . " created successfully!";
  } else {
      echo "Error: " . $sql . "<br>" . $db->error;
  }

header('Location: tcTutorManagement.php');
?>
