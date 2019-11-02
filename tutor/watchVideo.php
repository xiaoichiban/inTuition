<?php

// TODO

// Get the video some how



$videoVar = '1572629571.mp4';






echo "
<!DOCTYPE html>
<html>
<body>

<div align='center'>
<video width='600' height='380' controls>
  <source src='./video/$videoVar' type='video/mp4'>
  Your browser does not support the video tag.
</video>
<br/>
<br/>
";
?>


<br/>

<video controls style="width:640px;height:360px;" poster="poster.png">
  <source src="video/devstories.webm"  type='video/webm;codecs="vp8, vorbis"' />
  <track src="video/devstories-en.vtt" label="English subtitles" 
         kind="subtitles" srclang="en" default></track>
</video>


<br/>





<video controls style="width:640px;height:360px;" poster="poster.png">
  <source src="video/devstories.webm"  type='video/webm;codecs="vp8, vorbis"' />
  <track src="video/blank.vtt" label="English subtitles" 
         kind="subtitles" srclang="en" default></track>
</video>




<br/>
<a href= 'index.php' > << Back << </a>
</div>



</body>
</html>













