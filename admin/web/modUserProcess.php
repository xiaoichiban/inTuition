<?php 

include('session.php');

$username = $_POST['username'];
$status = $_POST['status'];

$query =  "UPDATE account SET status = '$status' WHERE username = '$username' ;" ;

$result = mysqli_query($db, $query);

echo "<center><br/><br/><br/>";
echo "<p> <b> $username's </b> 
status details have been updated to <b style='color:blue'>
$status</b></p><br>";
echo "<h3><a href = 'welcome.php'>BACK HOME</a></h3></center>";


?>

 