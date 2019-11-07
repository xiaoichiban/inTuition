<?php
include('session.php');
$studentName = $_GET['student'];
$date = $_GET['date'];

$attemptSql = "SELECT * FROM attempts WHERE student = '$studentName' and datetimestamp = '$date'; ";
$attemptResult = mysqli_query($db, $attemptSql);
$attemptResult1 = mysqli_query($db, $attemptSql);
$attemptRow = mysqli_fetch_row($attemptResult);

$quizid = $attemptRow[2];

if (mysqli_num_rows($attemptResult) < 1) {
  echo "Invalid attempt on $date";
}
else {
  echo "<h3>$studentName's attempts details</h3>";
  echo "Attempted on: $date <br>"; 

  $correctAnsSql = "SELECT count(*) FROM attempts WHERE student = '$studentName' and datetimestamp = '$date' and isCorrect = 1;" ;
  $correctAnsResult = mysqli_query($db, $correctAnsSql);
  $correctAnsRow = mysqli_fetch_row($correctAnsResult);
  $totalCorrectAns = $correctAnsRow[0];

  $totalQnsSql = "SELECT count(*) FROM question WHERE quizid = '$quizid';";
  $totalQnsResult = mysqli_query($db, $totalQnsSql);
  $totalQnsRow = mysqli_fetch_row($totalQnsResult);
  $totalQns = $totalQnsRow[0];

  echo "Score: $totalCorrectAns/$totalQns";

  echo "<div class='container'>"; 
  echo "<h3>Questions </h3>";
  $qnscounter = 0;

  while ($row = mysqli_fetch_row($attemptResult1)) {
    echo "Question " . ++$qnscounter; 
    echo "<br>";

    $qnsSql = "SELECT * FROM question WHERE id = '$row[3]'; ";
    $qnsResult = mysqli_query($db, $qnsSql);
    $qnsRow = mysqli_fetch_row($qnsResult);

    echo $qnsRow[1]; //questiontitle
    echo "<br>";
    ?> 
    <input type="radio" name="qns<?= $row[0]?>ans" value="a" <?php echo ($row[1] == 'a') ?  "checked" : "disabled" ;  ?> /> <?= $qnsRow[2] ?>
    <input type="radio" name="qns<?= $row[0]?>ans" value="b" <?php echo ($row[1] == 'b') ?  "checked" : "disabled" ;  ?> /> <?= $qnsRow[3] ?>
    <input type="radio" name="qns<?= $row[0]?>ans" value="c" <?php echo ($row[1] == 'c') ?  "checked" : "disabled" ;  ?> /> <?= $qnsRow[4] ?>
    <input type="radio" name="qns<?= $row[0]?>ans" value="d" <?php echo ($row[1] == 'd') ?  "checked" : "disabled" ;  ?> /> <?= $qnsRow[5] ?>
    <br>
    <?
    echo "<br>";

    if ($row[1] == $qnsRow[6]) {
      echo "Correct.";
    } else {
      echo "Wrong. The correct answer is: ";
      $correctAnsStr = ''; 
      if ($qnsRow[6] == 'a') {
        $correctAnsStr = $qnsRow[2];
      } else if ($qnsRow[6] == 'b') {
        $correctAnsStr = $qnsRow[3];
      } else if ($qnsRow[6] == 'c') {
        $correctAnsStr = $qnsRow[4];
      } else if ($qnsRow[6] == 'd') {
        $correctAnsStr = $qnsRow[5];
      }
      echo $correctAnsStr;
    }

    echo "<br><br>";
  }
  echo "<h3><a href = 'viewAllStudentsAttempts.php?quizid=".$quizid."'>Back to all attempts</a></h3>";
  
  echo "</div>";
}
?>