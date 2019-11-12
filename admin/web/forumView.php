
<center>
<table border='2' width='40%'>
<th> <h2>
ADMINISTRATOR @ FORUM 
<i class='fas fa-chess-queen'></i>
</h2></th>
<tr><td>
<a href="welcome.php"><b><font color='green'> << BACK HOME <<</font> </b></a>
<br><br>
</td></tr>
</table>
<br><br><br>




<?php
include 'config.php';
include 'session.php';
$string = $_SERVER['QUERY_STRING'];
$token = strtok($string, "=");
$token = strtok(" ");
$id =  $token;

$query = "SELECT creator,datetimestamp,topic,body FROM thread WHERE id='$id';" ;
$result = mysqli_query($db, $query);
$query2 = "SELECT poster,datetimestamp,body FROM reply WHERE threadid='$id';" ;
$result2 = mysqli_query($db, $query2);


echo"<table border='1'>
  <tr>
    <th width='10%' >   <font color='green'>Creator</font>   </th>
    <th width='20%' ><font color='green'>Date & Time</font></th>
    <th  width='70%' ><font color='green'>Content Body</font></th>
  </tr>";

while ($row = mysqli_fetch_row($result)) {

echo "<h3><font color='blue'>Content Body:: $row[2]   </font> </h3> <br>";  
  echo"<tr>";
    echo"<td>";echo "$row[0]";echo"</td>";
	echo"<td>";echo "$row[1]";echo"</td>";
	echo"<td>";echo "$row[3]";echo"</td>";
  echo"</tr>";
}





echo"<table border='1'>
  <tr>
    <th width='10%'>Responser</th>
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


echo"
<h3> REPLIES :: </h3><form method='post' action='forumReply.php'>
  <input type='hidden' name='id' value='$id'>
    <textarea name='reply' rows='3' cols='80'></textarea>
	<br>
    <input type='submit' value='Submit reply' />
</form>
	<br>	<br>"


?>


</center>




