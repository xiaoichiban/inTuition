


<?php

// https://www.daniweb.com/programming/web-development/threads/433571/renaming-file-while-uploading-php


session_start();

//require_once("./include/fg_membersite.php");
//require_once("./include/membersite_config.php");

// if(!$fgmembersite->CheckLogin()){ $fgmembersite->RedirectToURL("login.php"); exit; }


$allowedExts = array("mp4", "WebM", "ogg");
$extension = end(explode(".", $_FILES["file"]["name"]));

if (($_FILES["file"]["size"] < 90000000000000000000000000000000000) && in_array($extension, $allowedExts)){
    if ($_FILES["file"]["error"] > 0){
        echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }else{
        echo "Upload: " . $_FILES["file"]["name"] . "<br />";
        echo "Type: " . $_FILES["file"]["type"] . "<br />";
        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
        echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
        if (file_exists("upload/" . $_FILES["file"]["name"])){
            echo $_FILES["file"]["name"] . " already exists. ";
        }else{
            move_uploaded_file($_FILES["file"]["tmp_name"],
            "uploads/upload/" . $_FILES["file"]["name"]);
            echo "Stored in: " . "uploads/upload/" . $_FILES["file"]["name"];
        }
    }
    $con = mysql_connect("host.com","username","password");
    if (!$con){
      die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("dbname", $con);
    $name = mysql_real_escape_string($_FILES["file"]["name"]);
    $user = $_SESSION['email_of_user'];
    $videoname = mysql_real_escape_string($_POST['videoname']);
    $r = mysql_query("INSERT INTO `videos` SET `videoname` = '$videoname', `email` = '$user', `name`= '$name'");
    if(mysql_affected_rows()){
        echo "1 record added";
    }else{
        echo "problem";
    }
}else{
    echo "Invalid file";
}
?>