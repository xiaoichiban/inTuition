<!-- Supply module id as mod_id and filename in URI parameter -->

<?php

  include '../config.php';
  include '../session.php';

  $mod_id = null;
  $filename = null;

  if(isset($_GET["mod_id"])) {
  	$mod_id = $_GET["mod_id"];
  	// echo "$id";
  }


  if(isset($_GET["filename"])) {
  	$filename = $_GET["filename"];
  }

  if($mod_id == null || $filename =='' ){
  	return;
  }

  $sql = "DELETE FROM file WHERE mod_id = '$mod_id' AND filename = '$filename'";

  if ($db->query($sql) === TRUE) {
      echo $filename . " removed from ". $mod_id . " successfully!";
  } else {
      echo "Error: " . $sql . "<br>" . $db->error;
  }

header('Location: fileUploadedList.php?mod_id='.$mod_id.'');
?>
