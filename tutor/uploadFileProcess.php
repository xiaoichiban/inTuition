<?php

include '../config.php';

$mod_id = $_POST["mod_id"];
$name = $_POST['name'];
$description = $_POST['description'];
// echo "mod id: ". $mod_id . " name: " . $name . "description: " . $description;
$target_dir = "upload/";
$temp = explode(".", $_FILES["fileToUpload"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$target_file = $target_dir . $newfilename;
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {

  // Check if file already exists
  if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 20000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Allow certain file formats
  else if ($fileType != "pdf") {
      echo "Sorry, only PDF files are allowed.";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  else if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          $sql = "INSERT INTO file (mod_id, name, description, filename) VALUES ('$mod_id', '$name', '$description', '$newfilename')";
          if ($db->query($sql) === TRUE) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            header('Location: fileUploadedList.php?mod_id=' . $mod_id . '');
          }
          else {
              echo "Sorry, there was an error uploading your file.";
          }
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
  }
}
?>
