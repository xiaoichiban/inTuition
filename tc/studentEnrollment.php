

<?php
include('../session.php');
$tc = $_SESSION['login_user'];
?>

<?php
$sql = "SELECT * FROM enroll WHERE status ='pending' ORDER BY mod_id, student";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_row($result);
if (mysqli_num_rows($result) < 1) {
  echo "No Outstanding Student Enrollment";
}
else {
  while ($row = mysqli_fetch_row($result)) {
  echo
  "<form method='post' action='registerStudentProcess.php'>
    <table style='width:100%' border='1'>
      <tr>
      <th>Module ID</th>
      <th>Student</th>
      <th>Status</th>
      <th>Accept</th>
      <tr/>" .
    "<tr><th>" . $row[2] . "</th>" .
    "<th>" . $row[1] . "</th>" .
    "<th>" . $row[3] . "</th>" .
    "<th><input type='hidden' name='mod_id' value='$row[2]'><input type='hidden' name='username' value='$row[1]'>
    <input type='submit' onclick='return confirm('Accept student $row[1] to Module $row[2]?')' name='submit' value='Accept'></th></tr>
  </table>
</form>";

echo $row[2] . " and " . $row[1];
  }
}
?>

<?php

    echo "<h3><a href = 'tcTutorManagement.php'>Back</a></h3>";
?>
