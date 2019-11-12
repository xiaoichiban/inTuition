<html>
<head>
  <title>Tutor Upload Video</title>

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
<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-blue-cyan" data-col="2-columns">

<?php 
session_start();
include './layout/config.php';
include './layout/sidebar.php';

?>




<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-wrapper-before"></div>
      <div class="content-header">
        <div class="content-header-left col-md-4 col-12 mb-2">
          <h3 class="content-header-title"> Upload Videos</h3>
        </div>

        <div class="content-body">

          <div class="row">







<center>

<form action="uploadVideoProcess.php" method="post" enctype="multipart/form-data">

	
	
	<?php
	
		$thistutor = $_SESSION['username'];
		$sqlQuery = "SELECT m.id from module m where m.tutor = '$thistutor' ";
		$result = mysqli_query($db, $sqlQuery);
		$count = mysqli_num_rows($result);
		
		$hidden = '';
		
		// remove later
		// $count = 0;
		// For Testing
		
		if ($count < 1){
			
			echo "<br/><br/><br/><br/><br/><p> You have no modules here; nothing to upload </p>";
			echo "<br/><input type='text' disabled hidden id='mod_id' name='mod_id' required>";
			$hidden = 'hidden';
			
		}
		
		
		else {
			echo "<br/><br/><br/><br/><br/><label for='mod_id'>Module ID</label><br/>";
			echo "<select id='mod_id' name='mod_id' required class='form-control'>";
			
			while ($row = mysqli_fetch_assoc($result)) {
			  $id = $row['id'];
			  echo "<option value='$id'>$id</option>";
			}
			echo "</select>";


			
		}
		

	?>
	
	
	<br/>
	<br/>
	<br/>
	<br/>
	
	    
	<label for="vidname"<?php echo $hidden; ?> >Video name</label>
	<br/>
	<input type="text"  <?php echo $hidden; ?>
	id="vidname" name="vidname" maxlength="20" class="form-control" required> </input>

	<br/>
	<br/>
	
	<label for="videscript" <?php echo $hidden; ?> >Video Description</label>
	<br/>
	<input <?php echo $hidden; ?> type="text"  
	id="videscript" name="videscript" maxlength="50" class="form-control" required> </input>

	<br/>
	<br/>
	
	
	
	
	
	


	<br/>
	<br/>

	
  	
	<div class="form-group">
	<script src="./js/jslib.js"></script>
	<label class="file-upload btn btn-primary" <?php echo $hidden; ?> >
		Select Video to upload: <br/>
		<input type="file" class="form-control-file"  <?php echo $hidden; ?>
			accept='video/mp4' name="fileToUpload" id="fileToUpload" 
			onchange="checkFileSize(this)">
	</label>	
	</div>	
			
	<br/>
	<br/>

	
	
	
	<div class="form-group" <?php echo $hidden; ?>  >
		Select Subtitles to upload (optional) : <br/>
		<input type="file" class="form-control-file"   <?php echo $hidden; ?>
			accept='.vtt' name="subsToUpload" id="subsToUpload" >
	</div>	
			
	<br/>

	
	
	<div align='center'>
	<button type="submit" name="submit" class="btn btn-success" <?php echo $hidden; ?> >Submit</button>
	</div>
	
	
	<br/>
	<br/>
	
</form>




</center>


    </div>

	</div>
	</div>
	
	</div>
	</div>
	
	
	
	

</div>
</div>

</body>
</html>