<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $oldpass = $_POST['oldpass'];
      $newpass = $_POST['newpass']; 
	  $confirmnewpass = $_POST['confirmnewpass']; 
	  $thisuser = $_SESSION['login_user'];
	  
	  $sql = "SELECT username FROM account WHERE username = '$thisuser' and password = '$oldpass';";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_assoc($result);
      //$active = $row['active'];
      $count = mysqli_num_rows($result);
	  
	  //echo $count;
	  //echo "<br>";
	  //echo $newpass;
	  //echo "<br>";
	  //echo $confirmnewpass;
	  //echo "<br>";
	  //echo $thisuser;
	  //echo "<br>";
	  
      
// If result matched $myusername and $mypassword, table row must be 1 row
if($count == 1) {
         //echo "Correct Old Password";
         //echo "$count == 1";
	  
	  if($newpass == $confirmnewpass){

		  $sqlupdate = "UPDATE account SET password = '$newpass' WHERE username = '$thisuser';";
		  
		  //if ($db->query($sqlupdate) === TRUE) 	  {    } 
		  //else 	  {    echo "Error updating record: " . $db->error; }  
	  
		$result002 = mysqli_query($db, $sqlupdate);
		if (!$result002) { echo "An error occurred.\n";}
		else{	echo "Password updated successfully <br>"; 	}
	  
	  }
 
	 if($newpass == $confirmnewpass && $confirmnewpass == $oldpass){
			echo "Your Old Password And New Password ARE THE SAME ... Troll ..."; 
	  }

	 if($newpass != $confirmnewpass){
				echo "<br> <br>";
				echo "... Password Change Failed .. Please Try Again";
				echo "<br> <br>";
				echo "Your New Passwords don't match";
				echo "<br> <br>";
	  }

	echo "<br> <br> <a href='welcome.php'> BACK </a>";

}
		 
else {
		 echo "Password Change Failed ==>> Information Supplied Incorrect";
		 $error = "Passwords are invalid";
		 $error = "Password Change Failed ";
		 echo "<br> <br> <a href='welcome.php'> BACK </a>";
}
	  
	  
   }
	  
	  
	  
	  
	 
?>