<?php
//create_cat.php
include 'config.php';
include 'session.php';
 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{//someone is calling the file directly, which we don't want
echo 'This file cannot be called directly.';
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
$username = $_SESSION['login_user'];
$id = $_POST['id'];
$reply = $_POST['reply'];
$sql = "INSERT INTO  reply(poster,  body, threadid) VALUES ('$username', '$reply' , '$id');";              



//echo $username;
//echo $reply;
//echo $id;


$db->query($sql);

//$result = mysqli_query($sql);

header("Location:viewforum.php?id=$id");
    
}
 
?>