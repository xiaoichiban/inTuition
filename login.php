<?php
// mysqli_();
   include("config.php");
   session_start();
     
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_escape_string($db,$_POST['username']);
      $mypassword = mysqli_escape_string($db,$_POST['password']); 
	  

      $sql = "SELECT username,status FROM account WHERE username = '$myusername' and password = '$mypassword';";

      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_assoc($result);
      $count = mysqli_num_rows($result);
      
	  $status = $row['status'];

	  
	  
	  // If result matched $myusername and $mypassword, table row must be 1 row
	  // CASE : BANNED OR DEACTIVATED
      if($count == 1 && $status!='active') {
		echo "<h3 align='center'><font color='red'>LOGIN FAILED</font></h3>";
		echo "<h3 align='center'>Login Failed >> Your Account has been Deactivated or Banned</h3>";
		echo "<h3 align='center'><a href='login.html' > BACK </a></h3>";
		
      }
	  
	  
		
	  // If result matched $myusername and $mypassword, table row must be 1 row
	  // CASE : ACTIVE
      else if($count == 1 && $status=='active') {

		 $sqlgettime = "SELECT last_login FROM account WHERE username = '$myusername';";
		 $resulttime = mysqli_query($db, $sqlgettime);
		 $lastloginrow = mysqli_fetch_row($resulttime);
		 $last = $lastloginrow[0];
		 $_SESSION['login_user'] = $myusername;
		 $_SESSION['last_login'] = $last;
		 //echo $_SESSION['login_user'];
		 //echo $_SESSION['last_login'];
		 date_default_timezone_set("Singapore");
		 $timenow = date("Y-m-d");
		 $sqltime = "UPDATE account set last_login='$timenow' WHERE username = '$myusername';";
		 $timeupdatevar = mysqli_query($db,$sqltime);
         header("location: welcome.php");
      }
	  
	  
	  else {
			echo "<h3 align='center'><font color='red'>LOGIN FAILED</font></h3>";
			echo "<h3 align='center'>Login Failed >> For Some Reason ... ... </h3>";
			echo "<h3 align='center'><a href='login.html' > BACK </a></h3>";
      }
	  
	  

   }
   
   
   // NOT POST METHOD
   else {
	   	echo "<h3 align='center'><font color='red'>LOGIN FAILED</font></h3>";
		echo "<h3 align='center'>Login Failed >> BAD_REQUEST_METHOD </h3>";
		echo "<h3 align='center'><a href='login.html' > BACK </a></h3>";
   }
   
   
   
?>
