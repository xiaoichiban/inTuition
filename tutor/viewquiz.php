<?php
include('session.php');
$thisuser = $_SESSION['login_user'];
$quiz_id = $_GET['quizid'];

$sql = "SELECT * FROM quiz WHERE id = '$quiz_id'; ";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_row($result);

$sql1 = "SELECT * FROM question WHERE quizid = '$quiz_id'; ";
$result1 = mysqli_query($db, $sql1);


if (mysqli_num_rows($result) != 1) {
  echo "invalid quiz $quiz_id";
}
else {
  echo "<h3>Quiz details</h3>";
  echo
  "<table style='width:100%' border='1'>" .
  "<tr><th>Quiz title</th><th>" . $row[1] . "</th></tr>" .
  "<tr><th>Number of student attempts</th><th> </th></tr>" .
  "</table>";
}
echo "<br>";
$qnscounter = 0; 
?> 

<form action="editQuizProcess.php?quizid=<? echo $quiz_id; ?>" method="post">

<?
while ($row1 = mysqli_fetch_row($result1)) {
  
  echo "Question " . ++$qnscounter; 
  echo "<br><br>";

  ?>
    
  <b>Question title</b>
  <br>
  <input type="text" name="questiontitle<?= $row1[0] ?>" size="48" value="<?= $row1[1] ?>">
  <br><br>
  <b>Option a: </b>
  <input type="text" name="qns<?= $row1[0] ?>a" size="48" value="<?= $row1[2] ?>">
  <br>
  <b>Option b: </b>
  <input type="text" name="qns<?= $row1[0] ?>b" size="48" value="<?= $row1[3] ?>">
  <br>
  <b>Option c: </b>
  <input type="text" name="qns<?= $row1[0] ?>c" size="48" value="<?= $row1[4] ?>">
  <br>
  <b>Option d: </b>
  <input type="text" name="qns<?= $row1[0] ?>d" size="48" value="<?= $row1[5] ?>">
  <br>
  <b>Correct answer: </b>
  <input type="text" name="correctans<?= $row1[0] ?>" size="48" value="<?= $row1[6] ?>">
  <br><br>
  <input type="hidden" name="quizid" value="<?= $quiz_id ?>" size="48">
  <input type="hidden" name="questionid" value="<?= $row1[0] ?>" size="48">
  <?
      
  }
  ?>

  <input type="submit" value="Edit"/>
</form>

<?

echo "<h3><a href = 'createQuestion.php?quizid=". $quiz_id ."'>Add question</a></h3>";

echo "<h3><a href = 'viewmodule.php?module_id=". $row[2] ."'>Back</a></h3>";
?>