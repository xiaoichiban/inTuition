<?php
// mysqli_();
include("config.php");
session_start();




$_SESSION['user_id'] = "1";
$_SESSION['username'] = "alice";
$_SESSION['login_user'] = "alice";
$_SESSION['login_details_id'] = "alice";

echo "Fake Login success ! <br/>";
echo $_SESSION['user_id']."<br/>";
echo $_SESSION['username']."<br/>";
echo $_SESSION['login_user']."<br/>";
echo $_SESSION['login_details_id']."<br/>";






?>
