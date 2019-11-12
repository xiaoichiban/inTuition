<?php 
include 'config.php';
include 'session.php';
?>

<table border='0' width='100%' background="./../background.png" style="color:white;">

<th>
<td>
<br/>
</td>
</th>


<th> <h2>INTUITION FORUM</h2></th>
<tr>
<td>

</td>
</tr>

<tr>
<td>
<br/>
</td>
</tr>


</table>



<br/>

<a width="200px" class="btn btn-dark" href="../router.php">
<b><font> BACK TO MAIN APP</font> </b></a>
&nbsp; &nbsp;
<a width="200px" class="btn btn-success" href="forum.php">
<b><font color='white'> <i class="fa fa-fighter-jet" aria-hidden="true"></i> Main </font> </b></a>
&nbsp; &nbsp;
<a width="200px" class="btn btn-success" href="createNewThread.php">
<b><font color='white'><i class="fa fa-plus-circle" aria-hidden="true"></i> newThread </font> </b></a>





<center>



<br/>


<?php
$string = $_SERVER['QUERY_STRING'];
$token = strtok($string, "=");
$token = strtok(" ");
$id =  $token;

$query = "SELECT creator,datetimestamp,topic,body FROM thread WHERE id='$id';" ;
$result = mysqli_query($db, $query);

$query2 = "SELECT poster,datetimestamp,body FROM reply WHERE threadid='$id';" ;
$result2 = mysqli_query($db, $query2);



if (mysqli_num_rows($result) < 1){
	
	echo"<br/><center> No Such Forum , Try Another One</center>";
	return;
}



$row = mysqli_fetch_row($result);

	
echo"<table class='table' border='1'><tr><th width='10%' ><font color='green'>Creator</font>   </th>
<th width='20%' ><font color='green'>Date & Time</font></th></tr>";
echo "<h3><font color='blue'>Topic:: $row[2]   </font> </h3> <br>";  
echo"$row[3]";
echo"<tr>";
echo"<td>";echo "$row[0]";echo"</td>";
echo"<td>";echo "$row[1]";echo"</td>";
echo"</tr>";
echo "</table><br/><br/>";








echo"<table class='table' border='1'>
  <tr>
    <th width='10%'>Responder</th>
    <th width='20%'>Date & Time</th>
    <th  width='70%'>Reply</th>
  </tr>";

while ($row2 = mysqli_fetch_row($result2)) {

		echo "<h3>$row[2]</h3>";  
		echo"<tr>";
		echo"<td>";echo "$row2[0]";echo"</td>";
		echo"<td>";echo "$row2[1]";echo"</td>";
		echo"<td>";echo "$row2[2]";echo"</td>";
		echo"</tr>";
}
echo"</table>";

echo"
<div><br/><br/><h3> REPLIES :: </h3><form method='post' action='replyforum.php'>
  <input type='hidden' name='id' value='$id'>
    <textarea name='reply' rows='3' cols='80'></textarea>
	<br/>
    <input type='submit' value='Submit reply' /> </form> </div>"


?>


</center>


<br/>
<br/>
<br/>





