<?php

include('session.php');
$string = $_SERVER['QUERY_STRING'];
$token = strtok($string, "=");

$token = strtok(" ");
$user =  $token;
echo "<br><br><br>";

$sql = "SELECT username  , about_me ,  email , avatar_path , status FROM account where user_id = '$user'; ";


//$sql =  "SELECT * FROM account WHERE username = '$user';";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_array($result);


$username = $row[0];
$email = $row[2];
$status = $row[4];

?>

<hr/>
<center>
<h3>Edit User Profile
<i class='fas fa-hamburger' style='font-size:20px'></i>
</h3>


<b style='color:blue'> <?php echo $username?> <br>
 <?php echo $email?></b>

<br><br>
<form action="modUserProcess.php" method="POST">

<input type="hidden"  name="username" value="<?php echo $username ?>"> <br><br>

current status:  <input type="text" disabled required name="status" value="<?php echo $status?>">  <br><br>

Change Status TO
  <select name="status">
    <option value="active">active</option>
    <option value="banned">banned</option>
    <option value="deactivated">deactivated</option>
  </select>
  <br>
  
  
  <br><br>
  <input type="submit">
</form>

<hr/>
      <h3><a href = "welcome.php">Back</a></h3>
	  
	  </center>