<html>
  <head>
    <title>Dashboard</title>
  </head>
  <body>
  <center>
    <p><a href="searchmodules.php">Search Modules</a></p>
    <p><a href="viewstudentmodules.php">My Modules</a></p>
    <p><a href="">Chat</a></p>
    <p><a href="">My Profile</a></p>
    <p><a href="viewtimetable.php">My Timetable</a></p>
    <p><a href="logout.php">Logout</a></p>
	
	<br/>
	
	
	
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
