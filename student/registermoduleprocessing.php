<?php
include("config.php");
include('session.php');
$username = $_SESSION['login_user'];
$date = date('Y-m-d');
$module_id = $_GET['module_id'];

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $sql = "INSERT INTO enroll (student, mod_id, status) VALUES ('$username', '$module_id' , 'pending');";
  $result = mysqli_query($db,$sql);

  if (!$result) {
    echo 'alert("An error occurred. Registration failed.")';
    echo '<script>window.location.href = "searchmodules.php";</script>';
  }
  else{
    echo 'alert("Registration successful.")';
    echo '<script>window.location.href = "viewstudentmodules.php";</script>';
  }
}
?>
