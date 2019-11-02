<?php 
include 'config.php';

  $username = "";
  $email = "";
  
  if (isset($_POST['username'])) {
  	$username = $_POST['username'];
  	$email = $_POST['email'];
  	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
  	$date = date("Y-m-d");
	
	
	$name = $_POST['name_field'];
	
	$credit_card_num = $_POST['credit_card_num'];
	$valid_till = $_POST['valid_till'];
	$credit_card_name = $_POST['credit_card_name'];
	$cvv = $_POST['cvv'];
	
	

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
		
		   $password = password_hash($password, PASSWORD_DEFAULT);
		
           $query = "INSERT INTO account (username, name, password, email, 
											date_registered , last_login, account_type ) 
      	    VALUES ('$username', '$name', '$password',  '$email',  '$date' ,  '$date' , 'tc');";
			
			// echo $query;
			
           $results = mysqli_query($db, $query);
		   
		   
		   $query77 = "INSERT INTO tc (username, credit_card_num, valid_till, credit_card_name  , cvv) 
      	    	  VALUES ('$username', '$credit_card_num',  '$valid_till',  '$credit_card_name' , '$cvv');";
			
			// echo $query;
			
           $results77 = mysqli_query($db, $query77);
		   
		   
		   
		   
		   
		   
		   
		   
           echo '<meta http-equiv="refresh" content="4;url=./" />';
           echo '<br/> <br/> <br/> <h3 align="center">Account Created !! <br/> You will be Redirected in 3 seconds</h3>';
           echo '<p align="center"><img src="./image/load.gif" /></p>';
           exit();
  	}
  }
  
  else{
	  
	  echo "!!!!!!!!!!!!!!!!";
	  
  }
  
?>
