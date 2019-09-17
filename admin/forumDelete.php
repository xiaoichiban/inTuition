

<?php
include 'config.php';
include 'session.php';

$id = $_SERVER['QUERY_STRING'];


$statement0 = "DELETE FROM reply WHERE threadid = '$id';" ;
$result0 = mysqli_query($db , $statement0);


$statement1 = "DELETE FROM thread WHERE id = '$id';" ;
$result1 = mysqli_query($db , $statement1);


header("Location:forumMain.php");

?>