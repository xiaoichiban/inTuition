

<html>
<head>
	<title>Dashboard</title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="layout/timetablestyle.css">
	<link rel="apple-touch-icon" href="./layout/theme-assets/images/ico/apple-icon-120.png">
	<link rel="shortcut icon" type="image/x-icon" href="./layout/theme-assets/images/ico/favicon.ico">
	<link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
	<link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<!-- BEGIN VENDOR CSS-->
	<link rel="stylesheet" type="text/css" href="./layout/theme-assets/css/vendors.css">
	<link rel="stylesheet" type="text/css" href="./layout/theme-assets/vendors/css/charts/chartist.css">
	<!-- END VENDOR CSS-->
	<!-- BEGIN CHAMELEON  CSS-->
	<link rel="stylesheet" type="text/css" href="./layout/theme-assets/css/app-lite.css">
	<!-- END CHAMELEON  CSS-->
	<!-- BEGIN Page Level CSS-->
	<link rel="stylesheet" type="text/css" href="./layout/theme-assets/css/core/menu/menu-types/vertical-menu.css">
	<link rel="stylesheet" type="text/css" href="./layout/theme-assets/css/core/colors/palette-gradient.css">
	<link rel="stylesheet" type="text/css" href="./layout/theme-assets/css/pages/dashboard-ecommerce.css">
	<!-- END Page Level CSS-->
	<!-- BEGIN Custom CSS-->
	<!-- END Custom CSS-->
</head>
<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns">

<?php
// session_start();
include '../session.php';
include '../config.php';
include './layout/sidebar.php';
?>

	<div class="app-content content">
		<div class="content-wrapper">
			<div class="content-wrapper-before"></div>
			<div class="content-header row">
				<div class="content-header-left col-md-4 col-12 mb-2">
					<h3 class="content-header-title">Edit Profile</h3>
				</div>

			</div>
			<div class="content-body">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title"><?php echo $username ?> Profile</h4>
								<div class="card-content">
									<div class="card-body">

													<?php

													$dba = mysqli_connect("localhost", "admin", "admin", "petdb");

													if (!$dba) {
														die("Connection failed: " . mysqli_connect_error());
													}

													/* Attempt MySQL server connection. Assuming you are running MySQL
													server with default setting (user 'root' with no password) */

													// Attempt select query execution
													$targetUsername = $_SESSION['username'];
													$sql = "SELECT * FROM account WHERE username = '$targetUsername' ";
													if($result = mysqli_query($dba, $sql)){

														if(mysqli_num_rows($result) > 0){

															$row = mysqli_fetch_array($result);


															echo "
															<div class='container'>

															<div class='row'>



															<div class='col'>
															<form action='editProfileProcess.php?username=$username' method='post' >

															<div class='form-group'>
															<label for='email'>Email</label>
															<input type='email' class='form-control' id='email' name='email' aria-describedby='emailHelp' value='".$row['email']."' required>
															<small id='emailHelp' class='form-text text-muted'>We'll never share your email with anyone else.</small>
															</div>

															<div class='form-group'>
															<label for='about_me'>About Me</label>
															<input type='text' class='form-control' name='about_me' id='about_me' value='".$row['about_me']."' required>
															</div>


															<button type='submit' class='btn btn-primary'>Change My Details</button>

															</form>

															<br/>
															<br/>
															<br/>

															<b>Current Profile Picture:</b> <br/> <img src='../profilepics/" . $row['avatar_path'] . "' width='200px' height='200px' />
															<br/><br/>
															<form action='editProfilePicture.php'>
															<button type='submit' class='btn btn-primary'>Change Profile Picture</button>
															</form>
															</div>


															<div class='col'>
															<br/>
															</div>
															</div>";

															// Free result set
															mysqli_free_result($result);

														}

														else{
															echo "No records matching your query were found.";
														}
													}
													else{
														echo "ERROR: Could not able to execute $sql. " . mysqli_error($dba);
													}

													// Close connection
													mysqli_close($dba);


													?>
													<a class='btn btn-primary' href = 'viewProfile.php?username=<?php echo $username ?>'>Back</a>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- BEGIN VENDOR JS-->
  <script src="./layout/theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="./layout/theme-assets/vendors/js/charts/chartist.min.js" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN CHAMELEON  JS-->
  <script src="./layout/theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>
  <script src="./layout/theme-assets/js/core/app-lite.js" type="text/javascript"></script>
  <!-- END CHAMELEON  JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script src="./layout/theme-assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>
  <!-- END PAGE LEVEL JS-->


</body>
</html>
