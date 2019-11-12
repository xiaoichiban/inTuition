<?php

$id = null;
$subs = "blank.vtt";

// print_r($_GET);
if(isset($_GET["id"])) {
	$id = $_GET["id"];
	// echo "$id";
}


if(isset($_GET["subs"])) {
	$subs = $_GET["subs"];
	
	if ($subs==''){
		$subs = "blank.vtt";
	}
	// echo "$subs";
}
else{
	$subs = "blank.vtt";
}


if($id == null || $id =='' ){
	return;
}






//poster='loads3.gif'


echo "
<center>
<br/>
<a href= 'videoList.php' > << Back << </a>
<br/>
<button onclick='goBack()'>Go Back</button> 
<script> function goBack() { window.history.back(); } </script>
<br/>
<br/>

<video 
id='myVideo' 
name='myVideo'
controls
style='width:640px;height:360px;' 
 >

  <source src='video/$id'  />
  <track src='video/$subs' label='English subtitles' 
         kind='subtitles' srclang='en' default></track>
</video>

</center>
";
?>




