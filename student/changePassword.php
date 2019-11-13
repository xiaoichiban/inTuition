

<?php
// session_start();

include '../session.php';
include '../config.php';

// include './layout/sidebar.php';
	
	
	
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

  <div class="form-group">
    <label for="oldpassword">Old Password</label>
    <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Enter Old Password">
  </div>
  
  <div class="form-group">
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
    
    <div class="form-group">
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
