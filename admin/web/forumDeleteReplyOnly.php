

<?php
include 'config.php';
include 'session.php';

$id = $_SERVER['QUERY_STRING'];


$statement0 = "DELETE FROM reply WHERE id = '$id';" ;
$result0 = mysqli_query($db , $statement0);

header("Location:forumMain.php");

?>