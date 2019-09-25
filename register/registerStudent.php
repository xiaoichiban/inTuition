<?php 


include 'config.php';

  $username = "";
  $email = "";
  
  if (isset($_POST['register'])) {
  	$username = $_POST['username'];
  	$email = $_POST['email'];
  	$password = $_POST['password'];
  	$name = $_POST['name'];
  	$date = date("Y-m-d");

  	$sql_u = "SELECT * FROM public.account WHERE username='$username'";
  	$sql_e = "SELECT * FROM public.account WHERE email='$email'";
  	$res_u = mysqli_query($db, $sql_u);
  	$res_e = mysqli_query($db, $sql_e);

  	if (mysqli_num_rows($res_u) > 0) {
  	  $name_error = "Denied... username already taken"; 	
  	}else if(mysqli_num_rows($res_e) > 0){
  	  $email_error = "Denied... email already taken"; 	
  	}else{
           $query = "INSERT INTO public.account (username, password, name, email, date_registered) 
      	    	  VALUES ('$username', '$password', '$name', '$email',  '$date');";
           $results = mysqli_query($db, $query);
           echo 'Account Created !!';
           echo 'Please login here::  <a href="login.html"> LOGIN </a> ';
           exit();
  	}
  }
?>
















<html>
<head>
	<title>Register for Student</title>
	<link rel="stylesheet" href="style_01.css">
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>  
  
  	<!----
	--->

	<style>
		#frmCheckUsername {border-top:#F0F0F0 2px solid;background:#FAF8F8;padding:10px;}
		.demoInputBox{padding:7px; border:#F0F0F0 1px solid; border-radius:4px;}
		.status-available{color:#2FC332;}
		.status-not-available{color:#D60202;}
		

		
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
	
	
	var check = function() {
	  if (document.getElementById('password').value == document.getElementById('confirm_password').value) 
	  {
		document.getElementById('message').style.color = 'green';
		document.getElementById('message').innerHTML = '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &#9989; good passwords match ';
	  }
	  else {
		document.getElementById('message').style.color = 'red';
		document.getElementById('message').innerHTML = '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &#10060; passwords not matching';
	  }
	}
	</script>

	  
	  
  
  
  
  
  
</head>
<body>
  <form method="post" action="register.php" id="register_form">
  	<h1>Register</h1>
	
	

	<div id="frmCheckUsername" <?php if (isset($name_error)): ?> class="form_error" 	<?php endif ?> >
	  <input type="text" placeholder="Username" name="username" id="username" class="demoInputBox" onBlur="checkAvailability()" value="<?php echo $username; ?>"  required >
		
		<span id="user-availability-status"></span>   
		
		<?php if (isset($name_error)): ?>
	  	<span><?php echo $name_error; ?></span>
		<?php endif ?>
		
		
		<p><img src="LoaderIcon.gif" id="loaderIcon" style="display:none" /></p>	
	</div>
	
	
  	<div <?php if (isset($email_error)): ?> class="form_error" <?php endif ?> >
      <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>"  required >
      <?php if (isset($email_error)): ?>
      	<span><?php echo $email_error; ?></span>
      <?php endif ?>
  	</div>
	
	
  	<div>
  		<input type="password"  placeholder="Password" name="password" id="password" onkeyup="check();" required>
  	</div>
	
	<div>
  		<input type="password"  placeholder="Confirm Password" name="confirm_password" id="confirm_password" onkeyup="check();" required>
		<span id="message"></span>
  	</div>
	
	
	<div>
  		<input type="text"  placeholder="Name" name="name" required>
  	</div>
	

	
	
  	<div>
  		<button type="submit" name="register" id="reg_btn">Register</button>
  	</div>
	
	
  </form>
  </body>
</html>

