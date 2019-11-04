<?php
include("config.php");
include('session.php');
$username = $_SESSION['login_user'];
$date = date('Y-m-d');
$module_id = $_GET['module_id'];

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $sql = "DELETE FROM enroll WHERE student = '$username' AND mod_id = '$module_id' AND status = 'pending';";
  $result = mysqli_query($db,$sql);

  if (!$result) {
    echo 'alert("An error occurred. Deregistration failed.")';
    echo '<script>window.location.href = "viewmodule.php?module_id=' . $module_id .'";</script>';
  }
  else{
    echo 'alert("Deregistration successful.")';
    echo '<script>window.location.href = "viewstudentmodules.php";</script>';
  }
}
?>
