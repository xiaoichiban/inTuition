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

	// include './layout/sidebar.php';
	?>

	<div class="app-content content">
		<div class="content-wrapper">
			<div class="content-wrapper-before"></div>
			<div class="content-header row">
				<div class="content-header-left col-md-4 col-12 mb-2">
					<h3 class="content-header-title">Profile</h3>
				</div>

			</div>
			<div class="content-body">
				<div class="row">
					<div class="col-10"><br></div>
					<div class="col-sm">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Change <?php echo $username ?> Password</h4>
								<div class="card-content">
									<div class="card-body">

										<?php
										if(isset($_POST['oldpassword']) && isset($_POST['newpassword']) && isset($_POST['confirmpassword'])){

											echo"<h3 align='center'>";

											$old = $_POST['oldpassword'];
											$new = $_POST['newpassword'];
											$cfm = $_POST['confirmpassword'];
											$thisusername = $_SESSION['login_user'];


											if ( $new != $cfm ){
												echo "<text  style='color:red'>PASSWORDS DO NOT MATCH !!</text>";
											}
											else if ( $old == $new ){
												echo "<text  style='color:red'>OLD and NEW are the same, nothing to change</text>";
											}

											else{

												$sql1 = "SELECT password FROM account WHERE username = '$thisusername' ;";
												$result1 = $db->query($sql1);
												$row = $result1->fetch_assoc();

												$realOldPassword = $row["password"];

												if(password_verify($old, $realOldPassword) == FALSE){
													echo "<text  style='color:red'>OLD PASSWORD DOES NOT MATCH !! </text>" ;
												}
												else {

													$newpassword = password_hash($new, PASSWORD_DEFAULT);
													$updateSQL = "UPDATE account SET password = '$newpassword'
													WHERE username = '$thisusername' ";
													$db->query($updateSQL);
													echo "<text  style='color:green'>Password Change is Successful ! </text>" ;
												}


											}



											echo"</h3>";

										}
										?>

										<center>
											<form action='changePassword.php' method='POST'>

												<div class="col-8 form-group">
													<label for="oldpassword">Old Password</label>
													<input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Enter Old Password">
												</div>

												<div class="col-8 form-group">
													<label for="newpassword">New Password</label>
													<input type="password" class="form-control" id="newpassword"
													name="newpassword" placeholder="Enter New Password" required>
												</div>


												<script>

												var check = function() {
													if (document.getElementById('newpassword').value == document.getElementById('confirmpassword').value
													&& document.getElementById('newpassword').value !== '')
													{
														document.getElementById('message').style.color = 'green';
														document.getElementById('message').innerHTML = '&#9989; good passwords match ';
													}
													else {
														document.getElementById('message').style.color = 'red';
														document.getElementById('message').innerHTML = '&#10060; passwords not matching';
													}
												}

												</script>

												<div class="col-8 form-group">
													<label for="confirmpassword">Confirm New Password</label>
													<input type="password" class="form-control" id="confirmpassword"
													name="confirmpassword" placeholder="Confirm Password Here" onkeyup="check();" required>
												</div>

												<span id="message"></span>

												<br/>
												<br/>


												<button type="submit" class="btn btn-primary">Change Password </button>

											</form>
										</center>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
