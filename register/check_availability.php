<?php
require_once("config.php");

if(!empty($_POST["username"])) {
  $query = "SELECT * FROM account WHERE username='" . $_POST["username"] . "'";
  
  //$user_count = $db->numRows($query);
  
  $user_count = 1;
  
  if ($result=mysqli_query($db,$query))
  {
	// Return the number of rows in result set
	$user_count = mysqli_num_rows($result);
	//printf("Result set has %d rows.\n",$rowcount);
	// Free result set
	mysqli_free_result($result);
  }
  

  if($user_count>0) {
      echo "<span class='status-not-available'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &#10060; Username Not Available.</span>";
  }else{
      echo "<span class='status-available'> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &#9989; Username Available.</span>";
  }
}
?>