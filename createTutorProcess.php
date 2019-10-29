<?php

  include 'config.php';
  include 'session.php';

  $tc = $_SESSION['login_user'];
  $username = mysqli_real_escape_string($db, $_POST['username']).strtolower();

  if($status === "") {
    $status = 'active';
  }

  $sql = "INSERT INTO tutor (username, tc_owner)
  VALUES ('$username', '$tc')";

  if ($db->query($sql) === TRUE) {
      echo $description . " created successfully!";
  } else {
      echo "Error: " . $sql . "<br>" . $db->error;
  }

header('Location: tcTutorManagement.php');
?>
