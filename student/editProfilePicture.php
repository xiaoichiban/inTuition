<?php
include('layout.php');
?>



<body>  
	<div align="center">
		<h3>Edit Profile Picture</h3>
		<br/>	
<?php 

  $dba = mysqli_connect("localhost", "admin", "admin", "petdb");
  
  if (!$dba) {
    die("Connection failed: " . mysqli_connect_error());
	}
					
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
  
// Attempt select query execution
$targetUsername = $_SESSION['username'];
$sql = "SELECT * FROM account WHERE username = '$targetUsername' ";
if($result = mysqli_query($dba, $sql)){
    
	if(mysqli_num_rows($result) > 0){
	
	$row = mysqli_fetch_array($result);
	
		
echo "



<div class='container'>



  <div class='row'>
    <div class='col'>
      <br/>
    </div>
	
	
    <div class='col'>
		<form action='editProfilePictureProcess.php' method='post' enctype='multipart/form-data'>
		
			<b>profilepic:</b> <br/> <img src='./profile/" . $row['profilepic'] . "' width='200px' height='200px' />
			<br/><br/>

			<script src='./js/jslib.js'></script>
	
			<label>Select image to upload:</label>
			
			<label class='file-upload btn btn-primary'>

			<input type='file' class='form-control-file'  
				accept='image/*' name='fileToUpload' id='fileToUpload' required='true' onchange='checkFileSize(this)'>
			</label>		
			
			<br/> <br/>

			<button type='submit' class='btn btn-success'>Change Profile Picture</button>
	  
		</form>
    </div>
	
	
    <div class='col'>
      <br/>
    </div>
	
  </div>
";

        // Free result set
        mysqli_free_result($result);
		
    } 
	
	else{
        echo "No records matching your query were found.";
    }
} 
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($dba);
}
 
// Close connection
mysqli_close($dba);


?>
		
</body>  