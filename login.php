<?php
/*

         _nnnn_                      
        dGGGGMMb     ,"""""""""""""".
       @p~qp~~qMb    | Linux Rules! |
       M|@||@) M|   _;..............'
       @,----.JM| -'
      JS^\__/  qKL
     dZP        qKRb
    dZP          qKKb
   fZP            SMMb
   HZM            MMMM
   FqM            MMMM
 __| ".        |\dS"qML
 |    `.       | `' \Zq
_)      \.___.,|     .'
\____   )MMMMMM|   .'
     `-'       `--' hjm


*/

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
		
		// echo "   ".$_POST["password"];
		// echo "   ".$row["password"];
		
	// Password correct
	if(password_verify($_POST["password"], $row["password"]) == true)
	{	


		$status = $row['status'];
		$account_type = $row['account_type'];
		$username_var = $row['username'];
		
		
		
				// If result matched $myusername and $mypassword, table row must be 1 row
				// CASE : BANNED OR DEACTIVATED
				if($status!='active') {
					echo "<br/><br/><h3 align='center'><font color='red'>LOGIN FAILED</font></h3>";
					echo "<h3 align='center'>Login Failed >> Your Account has been Deactivated or Banned</h3>";
					echo "<h3 align='center'><a href='login.html' > Try to Login Again</a></h3>";
					//exit;
					return;
				  }
				
				

				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['username'] = $username_var;
				$_SESSION['login_user'] = $username_var;
				$_SESSION['user_type'] = $row['account_type'];
				$_SESSION['account_type'] = $row['account_type'];
				
				// Setting all session variables
				$sub_query = "UPDATE account SET last_seen = now() WHERE username = '$username_var' ;";
				$result = mysqli_query($db, $sub_query);
				
				//$statement = $db->prepare($sub_query);
				//$statement->execute();
				//$_SESSION['login_details_id'] = $db->lastInsertId();
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
					// header("location: loginFailed.php");
					echo "<br/><br/><h3 align='center'><font color='red'>LOGIN FAILED</font></h3>";
					
				 }
						
				
						
						
	}
		// End of IF password_verify == true
		else { echo "<br/><br/><h3 align='center'><font color='red'>login unsuccessful</font></h3>";	}
	


	}
 	// Start of ELSE
	// Password failed
	else { echo "<br/><br/><h3 align='center'><font color='red'>LOGIN (Password) FAILED</font></h3>";	}
	  

}


// NOT POST METHOD
// DON't do anything
else {  echo " ";   }






?>






<html>
<head>
<title>Intuition Login</title>	
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<style>
body {font-family: Arial, Helvetica, sans-serif;}
form {border: 3px solid #f1f1f1;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover { opacity: 0.8;}

.cancelbtn { width: auto; padding: 10px 18px; background-color: #f44336; }

.imgcontainer { text-align: center; margin: 24px 0 12px 0;}

img.avatar { width: 40%;  border-radius: 50%;}

.container { padding: 16px;}

span.psw { float: right; padding-top: 16px;}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {  display: block;   float: none; }
  .cancelbtn {  width: 100%;  }
}
</style>

</head>


<body>
	
	
	
	
<!---<center><img src ="logo.jpg" style="height:70%;"></center>-->


<h2 align="center"><i><u>Intuition Login</u></i></h2>

  <div class="container">

<form action="login.php" method="POST">
  <div class="imgcontainer">
    <img src="logo.jpg" alt="Avatar" class="avatar">
</div>

  <div class="container">
  
  
  
<input type="text" placeholder="Enter Username" autofocus name="username" id="username" required>
<input type="password" placeholder="Enter Password" name="password" id="password" required>
<br/>
<br/>
<button type="submit" value="Login" name="login"  >Login</button>
<label> <input type="checkbox" checked="checked" name="remember"> Remember me </label>
 </div>


<div class="container" align="center">
<a href="register.html">Don't have an account? >> Register For an Account Now</a>
</div>


  <div class="container" style="background-color:#f1f1f1">
    <a href="resetPassword.php" type="button" class="btn btn-danger">Forgot Your Password?</a>
  </div>
</form>






<b><a href="resetPassword.php" style="font-family:Old Standard;font-size: 14px">RESET MY PASSWORD</a></b>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<b><a href="register.html" style="font-family:Old Standard;font-size: 14px">CREATE NEW ACCOUNT</a></b>



</div>

</body>




</html>

















