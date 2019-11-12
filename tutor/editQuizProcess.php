<?php

  include 'config.php';
  include 'session.php';

  $tc = $_SESSION['login_user'];
  $quiz_id = mysqli_real_escape_string($db, $_POST['quizid']);
  $questionid = mysqli_real_escape_string($db, $_POST['questionid']);

  $sql1 = "SELECT * FROM question WHERE quizid = '$quiz_id'; ";
  $result1 = mysqli_query($db, $sql1);

  $sql2 = "SELECT quiztitle FROM quiz WHERE id = '$quiz_id'; ";
  $result2 = mysqli_query($db, $sql2);
  $row2 = mysqli_fetch_row($result2);

  while ($row1 = mysqli_fetch_row($result1)) {
    $quiztitle = mysqli_real_escape_string($db, $_POST['quiztitle']);
    $questiontitle = mysqli_real_escape_string($db, $_POST['questiontitle' .$row1[0]]);
    $optiona = mysqli_real_escape_string($db, $_POST['qns'.$row1[0].'a']);
    $optionb = mysqli_real_escape_string($db, $_POST['qns'.$row1[0].'b']);
    $optionc = mysqli_real_escape_string($db, $_POST['qns'.$row1[0].'c']);
    $optiond = mysqli_real_escape_string($db, $_POST['qns'.$row1[0].'d']);
    $correctans = mysqli_real_escape_string($db, $_POST['correctans'.$row1[0]]);
    
    $sql = "UPDATE question SET questiontitle = '$questiontitle', optiona = '$optiona', optionb = '$optionb', optionc = '$optionc', optiond = '$optiond', answer = '$correctans' WHERE id = '$row1[0]'; ";

    $result = mysqli_query($db, $sql);

    $sql1 = "UPDATE quiz SET quiztitle = '$quiztitle' WHERE id = '$quiz_id'; ";

    $result1 = mysqli_query($db, $sql1);
  }

  if ($result && $result1) {
    header("Location: viewquiz.php?quizid=$quiz_id");

  } else {
    echo "Error: " . $sql . "<br>" . $db->error;
  }

?>
