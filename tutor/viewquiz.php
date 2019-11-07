<?php
include('session.php');
$thisuser = $_SESSION['login_user'];
$quiz_id = $_GET['quizid'];

$sql = "SELECT * FROM quiz WHERE id = '$quiz_id'; ";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_row($result);

$sql1 = "SELECT * FROM question WHERE quizid = '$quiz_id'; ";
$result1 = mysqli_query($db, $sql1);
$countQuestion = mysqli_query($db, $sql1);
$overviewQuestion = mysqli_query($db, $sql1);
$countQuestionRow = mysqli_fetch_row($countQuestion);

$countAttemptsSql = "SELECT count(*) FROM attempts WHERE quizid = '$quiz_id' and questionid = '$countQuestionRow[0]'; ";
$countAttemptsResult = mysqli_query($db, $countAttemptsSql);
$countAttemptRow = mysqli_fetch_row($countAttemptsResult);

$totalStudents = mysqli_fetch_row(mysqli_query($db, "SELECT COUNT(*) FROM enroll where mod_id = '$row[2]';"))[0];

if (mysqli_num_rows($result) != 1) {
  echo "invalid quiz $quiz_id";
}
else {
  echo "<h3>Quiz details</h3>";
  echo
  "<table style='width:80%' border='1'>" .
  "<tr><th>Quiz title</th><th>" . $row[1] . "</th></tr>" .
  "<tr><th>Number of student attempts</th><th> <a href='viewAllStudentsAttempts.php?quizid=". $quiz_id ."'>". $countAttemptRow[0] ."</a> out of $totalStudents students</th></tr>" .
  "</table>";
}
echo "<br>";

$qnscounter = 0; 
?> 

<?
  echo "<h3>Overview performance of this quiz</h3>";
  echo "<table style='width:100%' border='1'>"; 
  echo "<tr>
  <th>Question #</th>
  <th># students answered correctly</th>
  <th># students answered wrongly</th>
  <th># students who chose option a</th>
  <th># students who chose option b</th>
  <th># students who chose option c</th>
  <th># students who chose option d</th>
  </tr>";
  while ($row2 = mysqli_fetch_row($overviewQuestion)) {
  $correctCount = mysqli_fetch_row(mysqli_query($db, "SELECT count(questionid) from attempts WHERE quizid = '$quiz_id' and questionid= '$row2[0]' and isCorrect = '1'; "))[0];

  $wrongCount = mysqli_fetch_row(mysqli_query($db, "SELECT count(questionid) from attempts WHERE quizid = '$quiz_id' and questionid= '$row2[0]' and isCorrect = '0'; "))[0];

  $countOptionA = mysqli_fetch_row(mysqli_query($db, "SELECT count(*) from attempts where quizid = '$quiz_id' and questionid= '$row2[0]' and attemptedans = 'a'; "))[0];

  $countOptionB = mysqli_fetch_row(mysqli_query($db, "SELECT count(*) from attempts where quizid = '$quiz_id' and questionid= '$row2[0]' and attemptedans = 'b'; "))[0];

  $countOptionC = mysqli_fetch_row(mysqli_query($db, "SELECT count(*) from attempts where quizid = '$quiz_id' and questionid= '$row2[0]' and attemptedans = 'c'; "))[0];

  $countOptionD = mysqli_fetch_row(mysqli_query($db, "SELECT count(*) from attempts where quizid = '$quiz_id' and questionid= '$row2[0]' and attemptedans = 'd'; "))[0];

  echo "<tr>
    <th>Question " . ++$qnscounter ."</th>
    <th>$correctCount out of $totalStudents</th>
    <th>$wrongCount out of $totalStudents</th>
    <th>$countOptionA</th>
    <th>$countOptionB</th>
    <th>$countOptionC</th>
    <th>$countOptionD</th>
  </tr>";
  
}
echo "</table>";
?>


<form action="editQuizProcess.php?quizid=<? echo $quiz_id; ?>" method="post">
<?

$counter = 0;
while ($row1 = mysqli_fetch_row($result1)) {
  
  echo "<h3>Edit questions</h3>";
  echo "Question " . ++$counter; 
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
  } //end of while loop
  ?>

  <input type="submit" value="Edit"/>
</form>

<?

echo "<h3><a href = 'createQuestion.php?quizid=". $quiz_id ."'>Add question</a></h3>";

echo "<h3><a href = 'viewmodule.php?module_id=". $row[2] ."'>Back</a></h3>";
?>