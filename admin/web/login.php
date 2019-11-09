<?php
   session_start();
   include("config.php");
     
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_escape_string($db,$_POST['username']);
      $mypassword = mysqli_escape_string($db,$_POST['password']); 
	  
	   //echo $myusername;
	   echo "<br> <br>";
	   //echo $mypassword;

      $sql = "SELECT username FROM admin_account WHERE username = '$myusername' and password = '$mypassword';";
	   //echo $sql;
      $result = mysqli_query($db,$sql);
	   //echo $result;
      $row = mysqli_fetch_array($result,mysqli_fetch_assoc);
      //$active = $row['active']; 
      $count = mysqli_num_rows($result);
      
	  //echo $count;
     

		
		
	  // If result matched $myusername and $mypassword, table row must be 1 row
      if($count == 1) {
         // session_register("myusername");

		 $sqlgettime = "SELECT last_login FROM admin_account WHERE username = '$myusername';";
		 $resulttime = mysqli_query($db, $sqlgettime);
		 $lastloginrow = mysqli_fetch_row($resulttime);
		 $last = $lastloginrow[0];
		 
		 $_SESSION['login_user'] = $myusername;
		 $_SESSION['last_login'] = $last; 
		 $_SESSION['admin'] = 'admin';
		 
		 echo $_SESSION['login_user'];
		 echo $_SESSION['last_login'];
		 echo $_SESSION['admin'];
		 
		 date_default_timezone_set("Singapore");
		 $timenow = date("Y-m-d");
		 $sqltime = "UPDATE admin_account set last_login='$timenow' WHERE username = '$myusername';";
		 $timeupdatevar = mysqli_query($db,$sqltime);
		 
         
         header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
		 echo "Login Failed";
		 
				echo "<br> <br> <a href='welcome.php'> BACK </a>";
      }
   }
?>
