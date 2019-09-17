<?php 
include 'config.php';
include 'session.php';

// gets value sent over search form
$searcher = $_GET['query']; 
$query =  "SELECT id,creator,datetimestamp,topic,body FROM thread WHERE body LIKE '%$searcher%' OR topic LIKE '%$searcher%' ORDER BY datetimestamp DESC;" ;

$result = mysqli_query($db, $query);
?>





<table border='2' width='100%'>
<th> <h2>WELCOME TO TASK MASTER FORUM !!!</h2></th>
<tr><td>
<a href="welcome.php"><b><font color='green'> << BACK HOME <<</font> </b></a>
<br><br>
<a href="createNewThread.php"><b><font color='green'> + Create New Thread + </font> </b></a>
</td></tr>
</table>
<br><br><br>










<form action="forum.php" method="GET">
	<input type="text" name="query" />
	<input type="submit" value="Search" />
</form>

<table border='1'>
  <tr>
    <th width='10%'>Thread Creator</th>
	<th width='20%'>Date-Time</th>
	<th width='25%'>Topic</th>
	<th  width='30%'>Content</th><th  width='10%'>=========</th>
  </tr>
  
<?php 
  while ($row = mysqli_fetch_row($result)) {
  echo"<tr>";
	$thisID = $row[0];
    echo"<td>"; echo "$row[1]"; echo"</td>";
    echo"<td>"; echo "$row[2]"; echo"</td>";
	echo"<td>"; echo "$row[3]"; echo"</td>";
	echo"<td>"; echo "$row[4]"; echo"</td>";
	echo"<td>"; echo "<a href='viewforum.php?id=$thisID'> VIEW THREAD </a>"; echo"</td>";
  echo"</tr>";
}
?>
</table>