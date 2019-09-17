

<?PHP




  if($_POST) {
	session_start();
	include("config.php");
	
	
    if($_POST['captcha'] != $_SESSION['digit']) 
	{
		echo("The CAPTCHA code entered was incorrect!");
		echo("Password Reset Failed");
	}
	

	
	if($_POST['captcha'] == $_SESSION['digit']) {
		

	$myusername = $_POST['username'];
    $myemail = $_POST['email']; 

    $sql = "SELECT username FROM account WHERE username = '$myusername' and email = '$myemail';";

    $result = mysqli_query($db,$sql);

    $row = mysqli_fetch_assoc($result);

    $count = mysqli_num_rows($result);

		
      if($count == 1) {
	  
	  	// place the code for resetting password here

		$length = 10;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}


		 $sqlchangepasswd = "UPDATE account set password='$randomString' WHERE username = '$myusername';";
		 $resultant = mysqli_query($db,$sqlchangepasswd);
		
		
				
		echo $myusername;
		echo("<br>");
		echo("PASSWORD HAS BEEN RESET TO:");
		echo("<br>");
		echo $randomString;
		echo("<br>");
		
	  
		echo "<br> <br> <a href='login.html'> LOGIN </a>";
		
		///////////////////////////////////////////////////////////////
		
      }
		

	
	      if($count != 1) {
			  
			  echo "<br> <br> <h3>RESET FAILED [Nonexistent Account] OR [WRONG INFO] </h3>";
			  echo "<br> <br> <a href='login.html'> LOGIN </a>";
		  
		  
		  }
	
	

	
	}
	
	
    session_destroy();

  }
?>