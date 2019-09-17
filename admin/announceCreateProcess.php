<?php
include 'config.php';
include 'session.php';

$topic = $_POST['topic'];
$body = $_POST['body'];

$statement = "INSERT INTO announcement(topic, body) VALUES('$topic' , '$body');" ;
echo $statement;
$result = mysqli_query($db , $statement);
echo $result;	

header("Location:announceManage.php");

?>