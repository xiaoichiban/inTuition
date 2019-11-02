<?php
include('layout.php');
?>




<body>  
	<div align="center">
		<h3>Edit Profile</h3>
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
	<form action='editProfileProcess.php' method='post' >
	  
	  <div class='form-group'>
		<label for='email'>Email</label>
		<input type='email' class='form-control' id='email' name='email' aria-describedby='emailHelp' value='".$row['email']."' required>
		<small id='emailHelp' class='form-text text-muted'>We'll never share your email with anyone else.</small>
	  </div>
	  
	  <div class='form-group'>
		<label for='about_me'>About Me</label>
		<input type='text' class='form-control' name='about_me' id='about_me' value='".$row['about_me']."' required>
	  </div>  
	  
	  
	  
	  
	<div class='form-group'>
    <label for='color' >Profile Color</label>
	<select id='color' name='color' class='form-control'  required>
      <option>POWDERBLUE</option>
      <option>SALMON</option>
      <option>DARKSALMON</option>
      <option>LIGHTSALMON</option>
      <option>LIGHTPINK</option>
      <option>PALEVIOLETRED</option>
      <option>GOLD</option>
      <option>LEMONCHIFFON</option>
      <option>MOCCASIN</option>
      <option>KHAKI</option>
    </select>
	</div>
	  

	  
	  <button type='submit' class='btn btn-primary'>Change My Details</button>
	  
	</form>

	<br/>
	<br/>
	<br/>
	
	<b>profilepic:</b> <br/> <img src='./profile/" . $row['profilepic'] . "' width='200px' height='200px' />
	<br/><br/>
		<form action='editProfilePicture.php'>
			<button type='submit' class='btn btn-primary'>Change Profile Picture</button>
		</form>
    </div>
	
	
    <div class='col'>
      <br/>
    </div>
  </div>";

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