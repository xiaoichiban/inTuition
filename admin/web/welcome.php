<?php
   include('session.php');
   $thisuser = $_SESSION['login_user'];
   $loginlast = $_SESSION['last_login'];
?>
<html>
   
   <head>
      <title>INTUITION</title>
   </head>
      
<body>

<center>

<table border='2' width='40%'>

<tr> <br/> </tr>

<tr>
<th> <h3>
Home @ Admin
<i class='fas fa-hamburger' style='font-size:20px'></i>
</h3></th>
</tr>

<tr> <br/> </tr>

</table>
</center>
   


	<div align='center'>
	
      <h5> Logged In As ::  <?php  echo $thisuser; ?> </h5> 
      <h5> Last Login ::  <?php   echo $loginlast; ?>  </h5> 
      <h3>=====================================</h3> 
      <h3><a href="searchUsers.php">Manage Users</a></h3>
      <h3>******************************************</h3> 
      <h3><a href="announceCreate.php">Create Announcement</a></h3>
      <h3><a href="announceManage.php">Manage Announcement</a></h3>
      <h3>******************************************</h3> 
      <h3><a href="forumMain.php">Manage Forum</a></h3>
      <h3>******************************************</h3> 
      <h3><a href = "logout.php">Sign Out</a></h3>
      <h3>=====================================</h3> 
	  
	</div>  
   </body>
   
</html>