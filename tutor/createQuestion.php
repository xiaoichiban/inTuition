<?php
include('session.php');
$thisuser = $_SESSION['login_user'];
$quiz_id = $_GET['quizid'];

$sql = "SELECT * FROM quiz WHERE id = '$quiz_id'; ";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_row($result);
if (mysqli_num_rows($result) != 1) {
  echo "invalid quiz $quiz_id";
}
else {
  echo
  "<h3>Create questions for " . $row[1] ."</h3>";
  "<br/>";
  
}

?>

<form action="createQuestionProcess.php" method="post">
  <b>Question title</b>
  <br>
  <input type="text" name="questiontitle" size="48">
  <br><br>
  <b>Option a: </b>
  <input type="text" name="optiona" size="48">
  <br>
  <b>Option b: </b>
  <input type="text" name="optionb" size="48">
  <br>
  <b>Option c: </b>
  <input type="text" name="optionc" size="48">
  <br>
  <b>Option d: </b>
  <input type="text" name="optiond" size="48">
  <br>
  <b>Correct answer: </b>
  <input type="text" name="correctans" size="48">
  <br><br>
  <input type="hidden" name="quizid" value="<?= $quiz_id ?>" size="48">
  <input type="submit" value="Create"/>
</form>

<?
$sql1 = "SELECT account_type FROM account WHERE username = '$thisuser';";
$result1 = mysqli_query($db, $sql1);
while ($row1 = mysqli_fetch_row($result1)) {
  $acctype = $row1[0];
  if ($acctype == 'tc'){
    echo "<h3><a href = 'viewtcmodules.php'>Back</a></h3>";
  }
  else if ($acctype == 'tutor'){
    echo "<h3><a href = 'viewtutormodules.php'>Back</a></h3>";
  }
  else{
    echo "<h3><a href = 'viewstudentmodules.php'>Back</a></h3>";
  }
}

?>

