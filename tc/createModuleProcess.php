<?php

  include '../config.php';
  include '../session.php';

  $tc = $_SESSION['login_user'];
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $description = mysqli_real_escape_string($db, $_POST['description']);
  $day = mysqli_real_escape_string($db, $_POST['day']).mb_strtoupper();
  $start = mysqli_real_escape_string($db, $_POST['start']);
  $end = mysqli_real_escape_string($db, $_POST['end']);
  $tutor = mysqli_real_escape_string($db, $_POST['tutor']).strtolower();
  $status = mysqli_real_escape_string($db, $_POST['status']).strtolower();

  
  
  //echo "<h3> $day </h3>";
  //echo "<h3> $start </h3>";
  //echo "<h3> $end </h3>";
  
  
  
  
  if($status === "") {
    $status = 'active';
  }

  $sql = "INSERT INTO module (name, description, class_day, class_startTime, class_endTime, tc, tutor, datetimestamp, status)
  VALUES ('$name','$description', '$day','$start', '$end', 
  '$tc', '$tutor', now(), '$status')";

  if ($db->query($sql) === TRUE) {
      echo $description . " created successfully!";
  } else {
      echo "Error: " . $sql . "<br>" . $db->error;
  }

  // comment out if needed
  //
  
 header('Location: tcModuleManagement.php');
?>
