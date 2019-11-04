

<?php 
  if (isset($_GET['status'])) {
  	$statusCode = $_GET['status'];
	
	if($statusCode == 'failedUsername'){
		
		echo '<br/> <br/> <br/> <h3 align="center" style="color:red"> Failed Username <br/> already taken <br/> Please Try Again </h3>';	
		
	}
	else if($statusCode == 'failedPassword'){
		
		echo '<br/> <br/> <br/> <h3 align="center" style="color:red"> Failed Password <br/> do not match <br/> Please Try Again </h3>';	
	}	
	else if($statusCode == 'failedEmail'){
		
		echo '<br/> <br/> <br/> <h3 align="center" style="color:red"> Failed email <br/> already taken <br/> Please Try Again  </h3>';	
	}
	else{
		echo '<br/> <br/> <br/> <h3 align="center" style="color:red"> Failed Registration <br/> Please Try Again </h3>';	
	}

  }
?>





<html>
<head>
	<title>Register for InTuition Account</title>
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
			wait(1500);
			$("#loaderIcon").hide();
		},
		error:function (){}
		});
	}
	
	
	var check = function() {
	  if (document.getElementById('password').value == document.getElementById('confirm_password').value && document.getElementById('password').value !== '') 
	  {
		document.getElementById('message').style.color = 'green';
		document.getElementById('message').innerHTML = '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &#9989; good passwords match ';
	  }
	  else {
		document.getElementById('message').style.color = 'red';
		document.getElementById('message').innerHTML = '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &#10060; passwords not matching';
	  }
	}
	
	
	
	function wait(ms){
	   var start = new Date().getTime();
	   var end = start;
	   while(end < start + ms) {
		 end = new Date().getTime();
	  }
	}

	</script>

	  
	  
  
  
  
  
  
</head>



<body style='background-image: url("https://previews.123rf.com/images/elovich/elovich1704/elovich170400326/75383397-craft-paper-texture-rustic-vintage-background.jpg");'>
  
  
  
  <form method="post" action="register_02.php" id="register_form">
  	<h1>Register @ InTuition As Tuition Center</h1>
	
	

	<div id="frmCheckUsername" >
	  <input type="text" placeholder="Username" 
	  name="username" id="username" class="demoInputBox" 
	  onBlur="checkAvailability()" value=""  required >
		
		<span id="user-availability-status"></span>   
		
		
		<p align="center"><img src="./image/loadbar.gif" id="loaderIcon" height="50px" width="50px" style="display:none" /></p>
	</div>
	
	
	<div>
      <input type="text" name="name_field" id="name_field" placeholder="Name" value=""  required >
  	</div>
	
	
  	<div >
      <input type="email" name="email" id="email" placeholder="Email" value=""  required >
  	</div>
	
	
	
	
	
		
	<div >
      <input type="text" name="address" id="address" placeholder="address" value=""  required >
  	</div>
	
	
	
	
	
	<div >
      <input type="number" name="postal" id="postal" 
	  placeholder="postal" 
	  maxlength="6"
	  value=""  required >
  	</div>
	
	
	<div >
      <input type="number" name="longitude" id="longitude" placeholder="longitude" min="0" step="0.0000001" value="1.2958919"  required >
  	</div>
	
	<div >
      <input type="number" name="latitude" id="latitude" placeholder="latitude" min="0" step="0.0000001" value="103.7805317"  required >
  	</div>
	
	<br/>
	<br/>
	
	
  	<div>
  		<input type="password"  placeholder="Password" name="password" id="password" onkeyup="check();" required>
  	</div>
	
	<div>
  		<input type="password"  placeholder="Confirm Password" name="confirm_password" id="confirm_password" onkeyup="check();" required>
		<span id="message"></span>
  	</div>
	
	
	
	<br/>
	<br/>
	
	
	
	 <div >
      <input 
	  type="text" 
	  name="credit_card_num" 
	  id = "credit_card_num"
	  placeholder="credit card num" 
	  value=""  
	  maxlength="16"
	  pattern="\d*"
	  required >
  	</div>
	
	
	
	 <div >
      <input 
	  type="text" 
	  name="valid_till" 
	  id = "valid_till"
	  placeholder="valid till (MM/YY)" 
	  value=""  
	  maxlength="4"
	  pattern="\d*"
	  required >
  	</div>
	
	<div >
      <input 
	  type="text" 
	  name="cvv" 
	  id = "cvv"
	  placeholder="CVV" 
	  value=""  
	  maxlength="3"
	  pattern="\d*"
	  required >
  	</div>
	
	
	
	
	
	 <div>
      <input 
	  type="text" 
	  name="credit_card_name" 
	  id="credit_card_name" 
	  placeholder="Card Holder's Name" 
	  value=""  
	  required >
  	</div>

	
	<br/>
	<br/>
	
  	<div>
  		<button type="submit" name="registerButton" id="reg_btn">Register</button>
  	</div>
	
	
  </form>
  
  </body>
</html>

