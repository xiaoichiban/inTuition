<?php
// mysqli_();
include("config.php");
session_start();




$_SESSION['user_id'] = "1";
$_SESSION['username'] = "danny";
$_SESSION['login_user'] = "danny";
$_SESSION['login_details_id'] = "danny";

echo "Fake Login success ! <br/>";
echo $_SESSION['user_id']."<br/>";
echo $_SESSION['username']."<br/>";
echo $_SESSION['login_user']."<br/>";
echo $_SESSION['login_details_id']."<br/>";






?>
