<?php

//update_is_type_status.php
include('session.php');

$query = "UPDATE account SET is_type = '".$_POST["is_type"]."' WHERE user_id = '".$_SESSION["login_details_id"]."'";
$statement = $connect->prepare($query);
$statement->execute();
?>