<?php 
include 'config.php';

  $username = "";
  $email = "";
  
  if (isset($_POST['username'])) {
  	$username = $_POST['username'];
  	$email = $_POST['email'];
  	$password = $_POST['password'];
	
	
  	$name = $_POST['name_field'];
	
	$confirm_password = $_POST['confirm_password'];
  	$date = date("Y-m-d");
	

  	$sql_u = "SELECT * FROM account WHERE username='$username'";
  	$sql_e = "SELECT * FROM account WHERE email='$email'";
  	$res_u = mysqli_query($db, $sql_u);
  	$res_e = mysqli_query($db, $sql_e);

	
	if ( $confirm_password != $password) {
      echo '<meta http-equiv="refresh" content="0.3; url=./registerPage.php?status=failedPassword" />';
  	}
  	else if (mysqli_num_rows($res_u) > 0) {
      echo '<meta http-equiv="refresh" content="0.3; url=./registerPage.php?status=failedUsername" />';
  	}
	else if(mysqli_num_rows($res_e) > 0){
      echo '<meta http-equiv="refresh" content="0.3; url=./registerPage.php?status=failedEmail" />';
  	}
	else{
			
			// Password Hashing
		   $password = password_hash($password, PASSWORD_DEFAULT);
		
		
			// Insert into Account
           $query = "INSERT INTO account (username, name, password, email, date_registered,  last_login ) 
      	    	  VALUES ('$username', '$name', '$password',  '$email',  '$date' ,  '$date');";
           $results = mysqli_query($db, $query);
		   
		   
			// Insert into Account
		   $query777 = "INSERT INTO student (username) VALUES ('$username');";
           $results777 = mysqli_query($db, $query777);
		   
		   
		   
           echo '<meta http-equiv="refresh" content="4;url=./" />';
           echo '<br/> <br/> <br/> <h3 align="center">Account Created !! <br/> 
		   You will be Redirected in 3 seconds</h3>';
           echo '<p align="center"><img src="./image/load.gif" /></p>';
           exit();
  	}
  }
  
  else{
	  
	  echo "!!!!!!!!!!!!!!!!";
	  
  }
  
?>
