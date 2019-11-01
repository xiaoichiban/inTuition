<?php

// include('layout.php');

$target_dir = "video/";



$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


$microTimeNow = round(microtime(true));


//$target_file_subs = $target_dir . basename($_FILES["subsToUpload"]["name"]);
$newsubsfilename = './video/$microTimeNow.vtt';
move_uploaded_file($_FILES["subsToUpload"]["tmp_name"], $newsubsfilename);




// Check if file already exists
//if (file_exists($target_file)) {
//    echo "Sorry, file already exists.";
//    $uploadOk = 0;
//}
// Check file size

// 5 * 1024 * 1024; //5MB

if ($_FILES["fileToUpload"]["size"] > (10*1024*1024)  ) {
    echo "<h3 align='center'>Sorry, your video file is too large at ".$_FILES["fileToUpload"]["size"]."</h3>";
    $uploadOk = 0;
}
// Allow certain file formats
if($fileType != "mp4") {
    echo "<h3 align='center'>Sorry, only MP4 files are allowed.</h3>";
    $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	// if everything is ok, try to upload file
	echo "<div align='center'>";
	echo "<h3 align='center'>Sorry, your file was not uploaded.</h3> </div>";
	return;
} 


if ($uploadOk == 1) {
	
	$extension = explode(".", $_FILES["fileToUpload"]["name"]);
	$newfilename = "./video/$microTimeNow.".end($extension);
	$smallfilename = round(microtime(true)) . '.' . end($extension);
	
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newfilename)) {
		

		
        echo "<div align='center'>";
        echo "<h3 align='center'> YAY The file ".$newfilename. " has been uploaded. </h3>";

		
		// SQL PART
		
		/*
		$thisusername = $_SESSION['username'];
		$thisuserid = $_SESSION['user_id'];
		$thistweetbody = $_POST["body"];
		$thistweetcat  = $_POST["category"];
		$url1  = $_POST["url1"];
		$url2  = $_POST["url2"];
		
		
		if ($url1=='' ||$url1 == null ){
			$url1 = './uploads/blank.png';
		}
		
		if ($url2=='' ||$url2 == null ){
			$url2 = './uploads/blank.png';
		}
		
		
		$sql = "INSERT INTO tweet (user_id, username, tweetbody, category, photo , url1 , url2)
				VALUES ('$thisuserid', '$thisusername', '$thistweetbody' , '$thistweetcat' ,'$smallfilename' , '$url1' , '$url2' )";

		if ($db->query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $db->error;
		}
		*/
		
		echo "</div>";
		
		
    } 
	else {
        echo "<h3 align='center'>Sorry, there was an error uploading your file. Please try again. </h3>";
    }
	
	echo "<br/><br/>
	<div align='center'>
	<h3>You will be redirected in <div id='counter'>5</h3>
	<script>
	setInterval(function() {
            var div = document.querySelector('#counter');
            var count = div.textContent * 1 - 1;
            div.textContent = count;
            if (count <= 0) {window.location.replace('./index.php');  }
        }, 1000);
    </script>
	<img src='./load.gif'  />
	<br/>
	<a href = './index.php'>Alternatively you can click here to redirect !</a>
	</div>
	";

}


?>







