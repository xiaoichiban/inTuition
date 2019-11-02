<?php

include('layout.php');

$target_dir = "./profile/";

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



echo basename($_FILES["fileToUpload"]["name"]);





 
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	

	
    if($check !== false) {
        // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        // echo "File is not an image.";
        $uploadOk = 0;
    }
}


/*
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists. Error";
    $uploadOk = 0;
}
*/


	




// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} 
else {
	
	
	$extension = explode(".", $_FILES["fileToUpload"]["name"]);
	$newfilename = "./profile/".round(microtime(true)) . '.' . end($extension);
	$smallfilename = round(microtime(true)) . '.' . end($extension);
	
	
	
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newfilename)) {
        // echo "The file ".$newfilename. " has been uploaded.";
        echo "<div align='center'>";

        echo "<h3 align='center'> GOOD </h3>";
		
		$thisusername = $_SESSION['username'];
		
		$sql = "UPDATE account SET profilepic = '$smallfilename' WHERE username ='$thisusername';";

		if ($db->query($sql) === TRUE) {
			echo "Update successfully";
		} else {
			echo "Error: !!  <br>";
		}
		
		echo "</div>";
		
		
    } 
	else {
        echo "<h3 align='center'>Sorry, there was an error uploading your picture file. Please try again. </h3>";
    }
	

	echo "<br/><br/>
	<div align='center'>
	<h3>You will be redirected in <div id='counter'>5</h3>
	<script>
	setInterval(function() {
            var div = document.querySelector('#counter');
            var count = div.textContent * 1 - 1;
            div.textContent = count;
            if (count <= 0) {window.location.replace('./myprofile.php');  }
        }, 1000);
    </script>
	<img src='./load.gif'  />
	<br/>
	<a href = './myprofile.php'>Alternatively you can click here to redirect !</a>
	</div>
	";

}


?>







