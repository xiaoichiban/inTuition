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
    
	<label for="body">Video Description</label>
	<br/>
	<br/>
	<textarea rows="3" cols="30" id="body" name="body" maxlength="50" class="form-control" required> </textarea>

	
	<br/>
	<br/>
	
    <label for="category" >Category</label>
	<select id="category" name="category" class="form-control"  required>
      <option>general</option>
      <option>trollpost</option>
      <option>serious</option>
      <option>banter</option>
      <option>jokes</option>
    </select>
	
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
	<br/><br/>
	
	
	
	<div class="form-group">
		Select Subtitles to upload (optional) : <br/>
		<input type="file" class="form-control-file"  
			accept='.vtt' name="subsToUpload" id="subsToUpload" >
	</div>	
			
	<br/>
	
	
	
	
	
	
	<div class="form-group">
	<input type="url" class="form-control" name="url1" id="url1" placeholder="insert url of image (optional)" maxlength="190">	
	</div>	
	

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