<?php

  include 'config.php';
  include 'session.php';

  $tc = $_SESSION['login_user'];
  $description = mysqli_real_escape_string($db, $_POST['description']);
  $tutor = mysqli_real_escape_string($db, $_POST['tutor']);
  $status = mysqli_real_escape_string($db, $_POST['status']).strtolower();

  if($status === "") {
    $status = 'active';
  }

  $sql = "INSERT INTO module (description, tc, tutor, datetimestamp, status)
  VALUES ('$description', '$tc', '$tutor', 'NOW()', '$status')";

  if ($db->query($sql) === TRUE) {
      echo $description . " created successfully!";
  } else {
      echo "Error: " . $sql . "<br>" . $db->error;
  }

header('Location: tcModuleManagement.php');
?>
