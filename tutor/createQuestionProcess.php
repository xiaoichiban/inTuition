<?php

  include 'config.php';
  include 'session.php';

  $tc = $_SESSION['login_user'];
  $quizid = mysqli_real_escape_string($db, $_POST['quizid']);
  $questiontitle = mysqli_real_escape_string($db, $_POST['questiontitle']);
  $optiona = mysqli_real_escape_string($db, $_POST['optiona']);
  $optionb = mysqli_real_escape_string($db, $_POST['optionb']);
  $optionc = mysqli_real_escape_string($db, $_POST['optionc']);
  $optiond = mysqli_real_escape_string($db, $_POST['optiond']);
  $correctans = mysqli_real_escape_string($db, $_POST['correctans']);

  $sql = "INSERT INTO question (questiontitle, optiona, optionb, optionc, optiond, answer, quizid)
  VALUES ('$questiontitle', '$optiona', '$optionb', '$optionc', '$optiond', '$correctans', '$quizid')";

  if ($db->query($sql) === TRUE) {
      echo $questiontitle . " created successfully!";

      echo "<h3><a href = 'createQuestion.php?quizid=". $quizid ."'>Add question</a></h3>";
  } else {
      echo "Error: " . $sql . "<br>" . $db->error;
  }
  echo "<h3><a href = 'viewquiz.php?quizid=". $quizid ."'>Back</a></h3>";
?>
