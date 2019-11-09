

<?php
include 'config.php';
include 'session.php';

$id = $_SERVER['QUERY_STRING'];

$statement = "DELETE FROM complain WHERE complain_id = '$id';" ;
echo $statement;
$result = mysqli_query($db , $statement);
echo $result;	

header("Location:searchcomplain.php");

?>