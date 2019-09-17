<?php
include 'config.php';
include 'session.php';
$creator = $_SESSION['login_user'];
$topic = $_POST['topic'];
$body = $_POST['body'];
$statement = "INSERT INTO thread(creator, topic, body, status) VALUES( '$creator' , '$topic' , '$body' , 'ok');" ;
echo $statement;
$result = mysqli_query($db , $statement);
echo $result;	
header("Location:forum.php");
?>