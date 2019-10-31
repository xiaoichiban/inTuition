<!--
//register.php
!-->

<?php



include('database_connection.php');

if(isset($_SESSION['user_id']))  {	header('location:index.php'); }


$message = '';


if(isset($_POST["register"]))
{
	$username = trim($_POST["username"]);
	$password = trim($_POST["password"]);
	$email = trim($_POST["email"]);
	$check_query = "SELECT * FROM account WHERE username = :username";
	$statement = $connect->prepare($check_query);
	$check_data = array(':username'	=> $username);
	if($statement->execute($check_data))	
	{
		if($statement->rowCount() > 0)
		{
			$message .= '<p><label>Username already taken</label></p>';
		}
		else
		{
			if(empty($username)){ $message .= '<p><label>Username is required</label></p>';	}
			if(empty($password)) { $message .= '<p><label>Password is required</label></p>'; }
			else
			{
				if($password != $_POST['confirm_password']){$message .= '<p><label>Password do not match</label></p>';}
			}
			if($message == '')
			{
				$data = array(
					':username'		=>	$username,
					':password'		=>	password_hash($password, PASSWORD_DEFAULT),
					':email'		=>	$email
				);

				$query = "INSERT INTO account (username, password, email , profilepic) VALUES (:username, :password, :email , 'default.png')";
				$statement = $connect->prepare($query);
				if($statement->execute($data))
				{
					$message = "<label>Registration Completed</label>";
				}
			}
		}
	}
}

?>

<html>  
    <head>  
        <title>Chat Application using PHP Ajax Jquery</title>  
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

		<style>
		.has-success { background:green; }
		.has-error { background:red;}
		</style>
		
		
		<script>
		function checkAvailability() {
			$("#loaderIcon").show();
			jQuery.ajax({
			url: "check_availability.php",
			data:'username='+$("#username").val(),
			type: "POST",
			success:function(data){
				$("#user-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error:function (){}
			});
		}
		
		
		function checkPasswordMatch() {
		var password = $("#password").val();
		var confirmPassword = $("#confirm_password").val();

		if (password == "" || confirmPassword == ""){
			
			}
		else if (password != confirmPassword){
			$("#divCheckPasswordMatch").html("<font color='red'><b>&#10060; Passwords do NOT match!</b></font>");
		}	
			
		else{
			$("#divCheckPasswordMatch").html("<font color='green'><b>&#9989; Passwords match.</b></font>");
			}
		}

		$(document).ready(function () { $("#password, #confirm_password").keyup(checkPasswordMatch); });


		
		
		
		
		</script>
		
		
		
    </head>  
    <body>  
        <div class="container">
			<br />
			
			<h3 align="center">Registration for 7chan</a></h3><br />
			<br />
			<div class="panel panel-default">
  				<div class="panel-heading">Registration for 7chan</div>
				<div class="panel-body">
					<form method="post">
						<span class="text-danger"><?php echo $message; ?></span>
						
						<div id="form-group">
							<label>Enter Username</label>
							<input type="text" name="username" id="username" class="form-control" onBlur="checkAvailability()" required  />
							<span id="user-availability-status"></span>
						</div>
						
						
						<div class="form-group">
							<label>Enter Password</label>
							<input type="password" name="password" id="password" required class="form-control" />
						</div>
						
						
						<div class="form-group">
							<label>Re-enter Password</label>
							<input type="password" name="confirm_password" id="confirm_password" required class="form-control" onChange="checkPasswordMatch();" />
						</div>
						
						<div class="registrationFormAlert" id="divCheckPasswordMatch">  
						</div>
						
						
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" required class="form-control" />
						</div>
												
						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" required class="form-control" />
						</div>
						
						<div class="form-group">
							<input type="submit" name="register" class="btn btn-info" value="Register" />
						</div>
						<div align="center">
							<a href="login.php">Login</a>
						</div>
					</form>
				</div>
			</div>
		</div>
    </body>  
</html>
