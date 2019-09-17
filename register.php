<?php 
  $db = mysqli_connect('host=localhost dbname=test user=postgres password=root port=5432');
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
  <title>Register</title>
  <link rel="stylesheet" href="style_01.css">
</head>
<body>
  <form method="post" action="register.php" id="register_form">
  	<h1>Register</h1>
  	<div 
	<?php if (isset($name_error)): ?> 
	class="form_error" 
	<?php endif ?> >
	  <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
	  <?php if (isset($name_error)): ?>
	  	<span><?php echo $name_error; ?></span>
	  <?php endif ?>
  	</div>
  	<div <?php if (isset($email_error)): ?> class="form_error" <?php endif ?> >
      <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>">
      <?php if (isset($email_error)): ?>
      	<span><?php echo $email_error; ?></span>
      <?php endif ?>
  	</div>
  	<div>
  		<input type="password"  placeholder="Password" name="password">
  	</div>
	
	
	<div>
  		<input type="text"  placeholder="Name" name="name">
  	</div>
	
	
	<div>
  		<input type="date"  placeholder="Date of Birth" name="date">
  	</div>
	
	
  	<div>
  		<button type="submit" name="register" id="reg_btn">Register</button>
  	</div>
	
	
  </form>
  </body>
</html>

