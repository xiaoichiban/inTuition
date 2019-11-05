<?php
include('session.php');
$thisuser = $_SESSION['login_user'];
$date = date('Y-m-d');
$quiz_id = $_GET['quizid'];

$sql = "SELECT * FROM quiz WHERE id = '$quiz_id'; ";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_row($result);

$sql1 = "SELECT * FROM question WHERE quizid = '$quiz_id'; ";
$result1 = mysqli_query($db, $sql1);
$row1 = mysqli_fetch_row($result1);

if (mysqli_num_rows($result) != 1) {
  echo "invalid quiz $quiz_id";
}
else {
	echo "<h3>Quiz details</h3>";
  echo
  "<table style='width:100%' border='1'>" .
  "<tr><th>Quiz title</th><th>" . $row[1] . "</th></tr>" .
  "<tr><th>number of attempts</th><th> </th></tr>" .
  "</table>";
}

?>