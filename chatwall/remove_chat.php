<?php
//remove_chat.php
include('session.php');

// isset — Determine if a variable is declared and is different than NULL

if(isset($_POST["chat_message_id"]))
{
	$query = "UPDATE chat_message SET status = '2' WHERE chat_message_id = '".$_POST["chat_message_id"]."'";
	$statement = $connect->prepare($query);
	$statement->execute();
}
?>