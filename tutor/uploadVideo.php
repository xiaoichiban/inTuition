<?php
//include('layout.php');
?>

<!DOCTYPE html>
<html>
<body>

<div class="container-fluid">
<div class="row">

<div class='col-sm'><br/></div>

	

<div class='col-sm'>

<center>

<form action="uploadVideoProcess.php" method="post" enctype="multipart/form-data">
    
	<label for="vidname">Video name</label>
	<br/>
	<input type="text"  id="vidname" name="vidname" maxlength="20" class="form-control" required> </input>

	<br/>
	<br/>
	
	<label for="videscript">Video Description</label>
	<br/>
	<input type="text"  id="videscript" name="videscript" maxlength="50" class="form-control" required> </input>

	<br/>
	<br/>
	

	
  	
	<div class="form-group">
	<script src="./js/jslib.js"></script>
	<label class="file-upload btn btn-primary">
		Select Video to upload: <br/>
		<input type="file" class="form-control-file"  
			accept='video/mp4' name="fileToUpload" id="fileToUpload" 
			onchange="checkFileSize(this)">
	</label>	
	</div>	
			
	<br/>
	<br/>
	
	
	
	
	
	
	
	<br/>
	<br/>
	
	
	
	
	
	
	
	
	<br/>
	
	
	
	<div class="form-group">
		Select Subtitles to upload (optional) : <br/>
		<input type="file" class="form-control-file"  
			accept='.vtt' name="subsToUpload" id="subsToUpload" >
	</div>	
			
	<br/>
	
	

	

	<br/>
	<br/>
	
	
	<div align='center'>
	<button type="submit" name="submit" class="btn btn-success">Submit</button>
	</div>
	
	
	<br/>
	<br/>
	
</form>




</center>


    </div>

    <div class='col-sm'>
      <br/>
    </div>



</div>
</div>

</body>
</html>