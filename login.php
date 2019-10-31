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
	  
      
      $myusername = mysqli_escape_string($db,$_POST['username']);
      $mypassword = mysqli_escape_string($db,$_POST['password']); 
	  

      $sql = "SELECT username,status,account_type 
	  FROM account WHERE username = '$myusername' and password = '$mypassword';";

      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_assoc($result);
      $count = mysqli_num_rows($result);
	  $status = $row['status'];
	  $account_type = $row['account_type'];

	  // If result matched $myusername and $mypassword, table row must be 1 row
	  // CASE : BANNED OR DEACTIVATED
      if($count != 1) {
		echo "<h3 align='center'><font color='red'>LOGIN FAILED</font></h3>";
		echo "<h3 align='center'><a href='login.html' > BACK </a></h3>";
		return;
      }
	  
	  
	  
	  // If result matched $myusername and $mypassword, table row must be 1 row
	  // CASE : BANNED OR DEACTIVATED
      if($count == 1 && $status!='active') {
		echo "<h3 align='center'><font color='red'>LOGIN FAILED</font></h3>";
		echo "<h3 align='center'>Login Failed >> Your Account has been Deactivated or Banned</h3>";
		echo "<h3 align='center'><a href='login.html' > BACK </a></h3>";
		return;
      }
	  
	  
		
	  // If result matched $myusername and $mypassword, table row must be 1 row
	  // CASE : ACTIVE
      else if($count == 1 && $status=='active') {

		 $sqlgettime = "SELECT last_login FROM account WHERE username = '$myusername';";
		 $resulttime = mysqli_query($db, $sqlgettime);
		 $lastloginrow = mysqli_fetch_row($resulttime);
		 $last = $lastloginrow[0];
		 
		 
		 $_SESSION['login_user'] = $myusername;
		 $_SESSION['username'] = $myusername;
		 $_SESSION['last_login'] = $last;
		 $_SESSION['account_type'] = $account_type;
		 
		 date_default_timezone_set("Singapore");
		 $timenow = date("Y-m-d");
		 $sqltime = "UPDATE account set last_login='$timenow' WHERE username = '$myusername';";
		 $timeupdatevar = mysqli_query($db,$sqltime);
		 
		 
		 echo $_SESSION['login_user']."  ";
		 echo $_SESSION['last_login']."  ";
		 echo $_SESSION['account_type']."  ";
		 
		 if ($account_type == "student"){
			header("location: ./student/welcome.php");
		 }
		 else if ($account_type == "tc"){
			header("location: ./tc/welcome.php");
		 }
		 else if ($account_type == "tutor") {
			header("location: ./tutor/welcome.php");
		 }
		 else {
			 
			 
			//header("location: welcome.php");
			 
		 }
		 
		 
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
