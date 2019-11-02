<?php
// mysqli_();
include("config.php");
session_start();
 

	 
if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
	  

	  
	  
	  if(! isset($_POST['username']) || ! isset($_POST['password'])){
		echo "<h3 align='center'><font color='red'>LOGIN FAILED</font></h3>";
		echo "<h3 align='center'>Login Failed >> Your Account has been Deactivated or Banned</h3>";
		echo "<h3 align='center'><a href='login.html' > BACK </a></h3>";
		return;
	  }

	$thisUSERNAME = $_POST['username'];
	$sql  = "SELECT * FROM account WHERE username = '$thisUSERNAME';";
	$result = mysqli_query($db, $sql);
	$count = mysqli_num_rows($result);
	
	
	if($count > 0)
	{
		$row = mysqli_fetch_assoc($result);
		
		echo "   ".$_POST["password"];
		echo "   ".$row["password"];
		
			// Password correct
			if(password_verify($_POST["password"], $row["password"]) == true)
			{	
		
		
				$status = $row['status'];
				$account_type = $row['account_type'];
				$username_var = $row['username'];
				
				
				
				// If result matched $myusername and $mypassword, table row must be 1 row
				// CASE : BANNED OR DEACTIVATED
				  if($status!='active') {
					echo "<h3 align='center'><font color='red'>LOGIN FAILED</font></h3>";
					echo "<h3 align='center'>Login Failed >> Your Account has been Deactivated or Banned</h3>";
					echo "<h3 align='center'><a href='login.html' > BACK </a></h3>";
					return;
				  }
				
				
				
				
				
				
		
		
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['username'] = $username_var;
				$_SESSION['login_user'] = $username_var;
				
					
				
				
				// Setting all session variables
				// 
				$sub_query = "UPDATE account SET last_seen = now() WHERE username = '".$row['username']."' ";
				$statement = $connect->prepare($sub_query);
				$statement->execute();
				$_SESSION['login_details_id'] = $connect->lastInsertId();
				
				
				//header('location:index.php');
				
				
				
						 
				 if ($account_type == "student"){
					header("location: ./student/studentdashboard.php");
				 }
				 else if ($account_type == "tc"){
					header("location: ./tc/tcdashboard.php");
				 }
				 else if ($account_type == "tutor") {
					header("location: ./tutor/tutordashboard.php");
				 }
				 else {
					header("location: loginFailed.php");
				 }
						
				
				
				
				
				
			}
			// Password failed
			else { 
				echo "<h3 align='center'><font color='red'>LOGIN (Password) FAILED</font></h3>";
				echo "<h3 align='center'><a href='login.html' > BACK </a></h3>";
			}
		
	}
 
	  

   }
   
   
   // NOT POST METHOD
   else {
	   	echo "<h3 align='center'><font color='red'>LOGIN FAILED</font></h3>";
		echo "<h3 align='center'>Login Failed >> BAD_REQUEST_METHOD </h3>";
		echo "<h3 align='center'><a href='login.html' > BACK </a></h3>";
   }
   
   
   
?>
