<?php
include '../session.php';
include '../config.php';
if (isset($_POST['about_me']) && isset($_POST['email'])) {

  $about_me = $_POST['about_me'];
  $email = $_POST['email'];
  $thisusername = $_GET['username'];

  $sqlstatement =
  "UPDATE account a SET a.email='$email' , a.about_me='$about_me' WHERE a.username='$thisusername'; ";

  //echo $sqlstatement;

  $db->query($sqlstatement);
  echo "<meta http-equiv='refresh' content='0;url=viewProfile.php?username=$thisusername'>";

}
else {
  echo "<h3 align='center'> Nothing to Show </h3>";
}
?>
