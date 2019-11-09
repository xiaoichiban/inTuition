

<?php
   include($_SERVER['DOCUMENT_ROOT'].'/session.php');
?>




<html">
   
   <head>
      <title> TEST PAGE</title>
   </head>
   
   <body>
   
   
	  <div align="center">
      <h1>TEST Session </h1> 
	  
	  <h2>+++++++++++++++++++++++++++++++++++++++++++++</h2> 
	  
	  
      <h2> Logged In As :: </h2> 
	  
      <h2> <font color="green"><?php echo $login_session; ?> </font></h2> 
	  
	  
	  
<?php
echo "<h3>All Session Variables</h3>";
foreach ($_SESSION as $key=>$val)
echo $key."==".$val."<br/>";
?> 
	  
	  <h2>+++++++++++++++++++++++++++++++++++++++++++++</h2> 

      <h3><a href = "welcome.php">Go Back</a></h3>
	  
	  
	  </div>
	  
	  
   </body>
   
</html>