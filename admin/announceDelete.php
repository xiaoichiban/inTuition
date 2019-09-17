

<?php
include 'config.php';
include 'session.php';

$id = $_SERVER['QUERY_STRING'];

$statement = "DELETE FROM announcement WHERE id = '$id';" ;
echo $statement;
$result = mysqli_query($db , $statement);
echo $result;	

header("Location:announceManage.php");

?>