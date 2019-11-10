<?php
require_once './vendor/autoload.php';
 
 
 // SAMPLE
 // http://localhost/pets/sendmail/send.php?username=lalalala&email=nottynottyowl@gmail.com
 
 
 
 
  if(! isset($_POST['username'])){
		echo "<h3 align='center'><font color='red'>Nothing Here </font></h3>";
		echo "<h3 align='center'><a href='../login.html' > BACK </a></h3>";
		return;
	  }
 
 
 
 
 function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
 
 
 
 
 
 
 
	$username = $_POST["username"];
	
	// Check if username exists
	$db = mysqli_connect("localhost", "admin", "admin", "petdb");
	if (!$db) {   die("Connection failed: " . mysqli_connect_error());}
	
	$thisUSERNAME = $_POST['username'];
	$sql  = "SELECT * FROM account WHERE username = '$thisUSERNAME';";
	$result = mysqli_query($db, $sql);
	$count = mysqli_num_rows($result);
	
	
	
	
	
	
	if($count < 1)
	{		
		echo "<h3 align='center'><font color='red'>Nothing Here </font></h3>";
		echo "<h3 align='center'><a href='../login.html' > BACK </a></h3>";
		return;
	}
	// Such a Username Exists
	else {
		$row = mysqli_fetch_assoc($result);
		$username_var = $row['username'];
		
		$email = $row['email'];
		
		
		$rawString = generateRandomString();
		
		
				
		$newhashedpassword = password_hash($rawString, PASSWORD_DEFAULT);
		$sql  = "UPDATE account SET  password='$newhashedpassword' WHERE username = '$username_var';";
		$result = mysqli_query($db, $sql);
		
		
		
		// Let us carry on
		try {
			
			
			// Create the SMTP Transport
			$transport = (new Swift_SmtpTransport('ssl://smtp.gmail.com', 465))
				->setUsername('noreplyapollo888@gmail.com')
				->setPassword('IS3106!!!');
		 
			// Create the Mailer using your created Transport
			$mailer = new Swift_Mailer($transport);
		 
			// Create a message
			$message = new Swift_Message();
		 
			// Set a "subject"
			$message->setSubject('Password Reset');
		 
			// Set the "From address"
			$message->setFrom(['noreplyapollo888@gmail.com' => 'Admin from Intuition App']);
		 
			// Set the "To address" [Use setTo method for multiple recipients, argument should be array]
			$message->addTo($email,'you');
		 
		 
			// Set the body
			$message->setBody(
			'<html><body>
			Dear '.$username_var.', Your Password has been reset to <b>'.$rawString.'</b> 
			<br/> <br/>
			If this action was not done by you, please contact the admin which is me. ty bye.
			<br/>
			 <img src="' .$message->embed(Swift_Image::fromPath('doge_1.jpg')).'" alt="Image" />
			 <br> <br>
			 Regards, the admin
			</body></html>','text/html'
			);
		 
		 
			// Send the message
			$result = $mailer->send($message);
			
			echo "<h3 align='center'><font color='green'>Your Password has been reset<br/>";
			echo "Please Check Your Email</font></h3>";
			echo "<h3 align='center'><a href='../login.html' > Login Here </a></h3>";
			
			
			
		} 
		
		catch (Exception $e) {
		  echo $e->getMessage();
		}
				
		
		
		
		
	}
	
	
	
	
 
 
 
 