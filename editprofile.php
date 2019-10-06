<?php


include('session.php');

$sql = "SELECT name, email FROM account where username = '$login_session';";
$result = mysqli_query($db, $sql);
$count = mysqli_num_rows($result);

if ($count > 0) {
    echo "<br>";
	echo "<br>";
	echo "<h2> My Details </h2>";
    // output data of each row
    
	$row = mysqli_fetch_assoc($result);
        echo 
	   '
	   <table border="1" cellpadding="0" cellspacing="0" align="centre" width="300" bgcolor="#eeeeff">
		<form name="display" method="POST" action="editprofileprocess.php">
		<tr><td>Name:</td>
		<td><input type="text" name="name" value=' . $row['name']. '></td></tr>
		<tr><td>Email:</td>
		<td><input type="text" name="email" value=' . $row['email']. '></td></tr>
		<tr>
		<td>
		 <input type="submit" name="submit" value="Save Changes"/>
		 </td>
		 </tr>
		</form>
	   </table>
	   ';

	echo "<br>";
    echo "<br> <a href='welcome.php'> BACK </a>";
    echo "<br>";
    
} else {
    echo "0 results";
	echo "<br>";
    echo "<br> <a href='welcome.php'> BACK </a>";
    echo "<br>";
}
$db->close();
?>



      <h3><a href = "welcome.php">Back</a></h3>