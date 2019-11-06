<?php
include('../session.php');
$thisuser = $_SESSION['login_user'];
$date = date('Y-m-d');
$module_id = $_GET['module_id'];

$sql = "SELECT * FROM module WHERE id = '$module_id'; ";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_row($result);
if (mysqli_num_rows($result) != 1) {
  echo "invalid module $module_id";
}
else if ($row[6] == 'inactive'){
  echo "module is no longer active";
}
else {
  echo
  "<table style='width:100%' border='1'>" .
  "<tr><th>module_id</th><th>" . $row[0] . "</th></tr>" .
  "<tr><th>module_name</th><th>" . $row[1] . "</th></tr>" .
  "<tr><th>description</th><th>" . $row[2] . "</th></tr>" .
  "<tr><th>offered by</th><th>" . $row[3] . "</th></tr>" .
  "<tr><th>tutored by</th><th>" . $row[4] . "</th></tr>" .
  "<tr><th>number of students</th><th>" . mysqli_fetch_row(mysqli_query($db, "SELECT COUNT(*) FROM enroll where mod_id = '$module_id' AND status = 'accepted';"))[0] . "</th></tr>" .
  "</table>";
}

$sql = "SELECT * FROM enroll WHERE mod_id = '$module_id' AND status = 'accepted' ORDER BY student";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_row($result);

echo
"<form method='post' action='removeStudentProcess.php'>
  <table style='width:100%' border='1'>
    <tr>
    <th>Student name</th>
    <th>Date of Enrollment</th>
    <th></th>
    <tr/>" .
  "<tr><th>" . $row[1] . "</th>" .
  "<th>" . $row[4] . "</th>" .
  "<th><input type='hidden' name='mod_id' value='$module_id'><input type='hidden' name='username' value='$row[1]'>
  <input type='submit' onclick='return confirm('Remove student $row[1] from Module $module_id?')' name='submit' value='Remove'></th></tr>
</table>
</form>";


    echo "<h3><a href = 'tcModuleManagement.php'>Back</a></h3>";
?>
