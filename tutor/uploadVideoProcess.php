<?php

// include('layout.php');


include('config.php');


$target_dir = "video/";



$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));






// Check if file already exists
//if (file_exists($target_file)) {
//    echo "Sorry, file already exists.";
//    $uploadOk = 0;
//}
// Check file size

// 5 * 1024 * 1024; //5MB

if ($_FILES["fileToUpload"]["size"] > (17*1024*1024)  ) {
    echo "<h3 align='center'>Sorry, your video file is too large at ".$_FILES["fileToUpload"]["size"]."</h3>";
    $uploadOk = 0;
}
// Allow certain file formats
if($fileType != "mp4" && $fileType != "webm" ) {
    echo "<h3 align='center'>Sorry, only MP4 or WEBM files are allowed.</h3>";
    $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	// if everything is ok, try to upload file
	echo "<div align='center'>";
	echo "<h3 align='center'>Sorry, your file was not uploaded.</h3> </div>";
	return;
} 





$microTimeNow = round(microtime(true));

//$target_file_subs = $target_dir . basename($_FILES["subsToUpload"]["name"]);
$newsubsfilename = "./video/".$microTimeNow.".vtt";

if( move_uploaded_file($_FILES["subsToUpload"]["tmp_name"], $newsubsfilename)  == TRUE ){
	$newsubsfilename = $microTimeNow.".vtt";
}
else {
	$newsubsfilename = "blank.vtt";
}








if ($uploadOk == 1) {
	
	$extension = explode(".", $_FILES["fileToUpload"]["name"]);
	$newfilename = "./video/".$microTimeNow.".".end($extension);
	$smallfilename = $microTimeNow.".".end($extension);
	
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newfilename) == TRUE) {
		

		
        echo "<div align='center'>";
        echo "<h3 align='center'> YAY The file ".$newfilename. " has been uploaded. </h3>";

		
		// SQL PART
		
		
		//$thisusername = $_SESSION['username'];
		//$thisuserid = $_SESSION['user_id'];
		// $smallfilename
		// $newsubsfilename
		$vidname  = $_POST["vidname"];
		$videscript  = $_POST["videscript"];
		$mod_id = $_POST["mod_id"];
		
		
		$sql = "
		INSERT INTO video (mod_id, name, description, filename, subtitles)
		VALUES ('$mod_id', '$vidname', '$videscript' , '$smallfilename' , '$newsubsfilename' )";


		if ($db->query($sql) === TRUE) {
			echo "New record created successfully";
		} 
		else {
			echo "Error: " . $sql . "<br>" . $db->error;
		}
		
		
		echo "</div>";
		
		
    } 
	else {
		
		echo " error code = <b>". $_FILES['fileToUpload']['error'] ."</b>";
        echo "<h3 align='center' style='color:red'>
		Sorry, there was an error uploading your file. Please try again. </h3>";
    }
	
	echo "
	<div align='center'>
	<h3>You will be redirected in <div id='counter'>3</h3>
	<script>
	setInterval(function() {
            var div = document.querySelector('#counter');
            var count = div.textContent * 1 - 1;
            div.textContent = count;
            if (count <= 0) {window.location.replace('./videoList.php');  }
        }, 1000);
    </script>
	<img src='./load.gif'  />
	<br/>
	<a href = './videoList.php'>Alternatively you can click here to redirect !</a>
	</div>
	";

}


?>







