<html>
  <head>
    <title>Tutor Dashboard</title>
  </head>
  <body>
  
 <center>
  
<h2> <u> Links</u> </h2>
<p> <a href='uploadVideo.php'> Upload Video </a> </p>
<p> <a href='watchVideo.php'> Watch Video </a> </p>
<p> <a href='watchVideo2.php'> Watch Video 2</a> </p>
<p>  <a href="viewtutormodules.php">My Modules</a></p>
<p>  <a href="">Chat</a></p>
<p>  <a href="">My Profile</a></p>

<?php
session_start();
echo "Logged in As:<br/>";
echo "user_id=".$_SESSION['user_id']."<br/>";
echo "username=".$_SESSION['username']."<br/>";
echo "login_user=".$_SESSION['login_user']."<br/>";


?>  
  
 </center>
  
  </body>
</html>
