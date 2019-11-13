<?php

  include '../config.php';
  include '../session.php';

  $tc = $_SESSION['login_user'];
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);


  $password = password_hash($password, PASSWORD_DEFAULT);


  $name = mysqli_real_escape_string($db, $_POST['name']).strtolower();
  $email = mysqli_real_escape_string($db, $_POST['email']).strtolower();
  $status = 'active';
  // $tc_owner = mysqli_real_escape_string($db, $_POST['tc']);

  $sql = "INSERT INTO account (username, password, name, email, status, date_registered)
  VALUES ('$username', '$password', '$name', '$email', '$status' , now())";

  if ($db->query($sql) === TRUE) {
      echo $username . " account created successfully!";
      $sql = "INSERT INTO tutor (username, tc_owner) VALUES ('$username', '$tc')";
      if ($db->query($sql) === TRUE) {
        echo $username . " tutor created successfully!";
      }


  if ($db->query($sql) === TRUE) {
      echo $username . " account created successfully!";

  } else {
      echo "Error: " . $sql . "<br>" . $db->error;
  }

header('Location: tcTutorManagement.php');
?>
