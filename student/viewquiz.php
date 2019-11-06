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
  "<tr><th>Number of attempts</th><th> </th></tr>" .
  "</table>";
}
echo "<br>";

$qnscounter = 0;
echo "<form method='post'>";
while ($row1 = mysqli_fetch_row($result1)) {
  echo "<br><br>Question " . ++$qnscounter; 
  echo "<br>";

	echo $row1[1];
	echo "<br>";
	echo 
  		"<input type='radio' name='qns". $qnscounter ."ans' value='a'> " .$row1[2] ." </input> ".
  		"<input type='radio' name='qns". $qnscounter ."ans' value='b'> " .$row1[3] ." </input> ".
  		"<input type='radio' name='qns". $qnscounter ."ans' value='c'> " .$row1[4] ." </input> ".
  		"<input type='radio' name='qns". $qnscounter ."ans' value='d'>" .$row1[5] ."</input> ";
  		
	}

echo "<br><br><input type='submit' name='submit' value='Submit feedback'>".
"</form> ";

echo "<h3><a href = 'viewmodule.php?module_id=". $row[2] ."'>Back</a></h3>";
?>