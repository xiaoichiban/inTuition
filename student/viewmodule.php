<?php
include('session.php');
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
  "<tr><th>number of students</th><th>" . mysqli_fetch_row(mysqli_query($db, "SELECT COUNT(*) FROM enroll where mod_id = '$module_id';"))[0] . "</th></tr>" .
  "</table>";
}

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
