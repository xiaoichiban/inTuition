<?php
include('session.php');
$thisuser = $_SESSION['login_user'];
$date = date('Y-m-d');
$module_name = $_GET['module_name'];

$sql2 = "SELECT * FROM module WHERE name = '$module_name'; ";
$result2 = mysqli_query($db, $sql2);
echo "<table style='width:100%' border='1'>" .
"<tr><th>module_id</th>" .
"<th>module_name</th>" .
"<th>description</th>" .
"<th>offered by</th>" .
"<th>tutored by</th>" .
"<th>time</th>" .
"</tr>";
while ($row = mysqli_fetch_row($result2)) {
  if ($row[3] == 0){
    $day_label = "Sunday";
  }
  elseif ($row[3] == 1) {
    $day_label = "Monday";
  }
  elseif ($row[3] == 2) {
    $day_label = "Tuesday";
  }
  elseif ($row[3] == 3) {
    $day_label = "Wednesday";
  }
  elseif ($row[3] == 4) {
    $day_label = "Thursday";
  }
  elseif ($row[3] == 5) {
    $day_label = "Friday";
  }
  else{
    $day_label = "Saturday";
  }
  echo
  "<tr><th>" . $row[0] . "</th>" .
  "<th>" . $row[1] . "</th>" .
  "<th>" . $row[2] . "</th>" .
  "<th>" . $row[6] . "</th>" .
  "<th>" . $row[7] . "</th>" .
  "<th>" . $day_label . " " . $row[4] . " to " . $row[5] . "</th>" .
  "<th><form action = 'registermoduleprocessing.php?module_id=$row[0]' method = 'post'>
  <input type = 'submit' value = ' Register '/>
  </form></th></tr>";
}
echo "</table>";

?>
