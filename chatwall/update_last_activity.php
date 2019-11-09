<?php

include('session.php');

$query = "UPDATE account SET last_seen = now() WHERE user_id = '".$_SESSION["user_id"]."'";
$statement = $connect->prepare($query);
$statement->execute();

?>

