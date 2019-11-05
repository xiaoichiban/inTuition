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
  "<h3>Create quiz for " . $row[1] ."</h3>";
  "<br/>";
  
}

?>

<form action="createQuizProcess.php" method="post">
  <b>Quiz title</b>
  <br>
  <input type="text" name="quiztitle" size="48">

  <br>
  <input type="hidden" name="moduleid" value="<?= $module_id ?>" size="48">
  <br>
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

