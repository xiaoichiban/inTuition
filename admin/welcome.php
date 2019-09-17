<?php
   include('session.php');
   $thisuser = $_SESSION['login_user'];
   $loginlast = $_SESSION['last_login'];
?>
<html">
   
   <head>
      <title>TASK MASTER</title>
   </head>
      
<body>
   
<table border='2' width='100%'>
<th> <h2>Welcome Home Admin !!</h2></th>
<tr>
</tr>
</table>
   


	<div align='center'>
	
      <h3> Logged In As ::  <?php  echo $thisuser; ?> </h3> 
      <h3> Last Login ::  <?php   echo $loginlast; ?>  </h3> 
      <h2>=====================================</h2> 
      <h3><a href="searchUsers.php">Manage Users</a></h3>
      <h2>******************************************</h2> 
      <h3><a href=""><s>Search Tasks By Tag</s></a></h3>
      <h3><a href=""><s>Search Tasks By Name/Description</s></a></h3>
      <h2>******************************************</h2> 
      <h3><a href="announceCreate.php">Create Announcement</a></h3>
      <h3><a href="announceManage.php">Manage Announcement</a></h3>
      <h2>******************************************</h2> 
      <h3><a href="forumMain.php">Manage Forum</a></h3>
      <h2>******************************************</h2> 
      <h3><a href="searchcomplain.php">Manage Complains</a></h3>
      <h2>******************************************</h2> 
      <h3><a href = "logout.php">Sign Out</a></h3>
	  
	</div>  
   </body>
   
</html>