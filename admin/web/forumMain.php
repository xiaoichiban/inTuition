<?php 
include 'session.php';

// gets value sent over search form

$searcher = '%';

if (isset($_GET['query'])){
	$searcher = $_GET['query']; 
}


$query = "SELECT id,creator,datetimestamp,topic,body FROM thread WHERE body LIKE '%$searcher%' OR topic LIKE '%$searcher%' ORDER BY datetimestamp DESC;" ;

  if ($searcher=='*' || $searcher==null || $searcher==''){
	  $query = "SELECT id,creator,datetimestamp,topic,body,status FROM thread ORDER BY datetimestamp DESC;;";
  }

$result = mysqli_query($db, $query);
?>




<center>

<table border='2' width='80%'>
<th> <h2>WELCOME ADMINISTRATOR TO INTUITION FORUM !!!</h2></th>
<tr><td>
<a href="welcome.php"><b><font color='green'> << BACK HOME <<</font> </b></a>
</td></tr>
</table>

</center>



<br><br><br>




<form action="forum.php" method="GET">
	<input type="text" name="query" />
	<input type="submit" value="Search" />
</form>

<table border='1'>
  <tr>
    <th width='10%'>Thread Creator</th>
	<th width='15%'>Date-Time</th>
	<th width='10%'>Topic</th>
	<th  width='25%'>Content</th>
	<th  width='3%'>VIEW</th>
	<th  width='3%'>DELETE</th>
	<th  width='3%'>BAN</th>
  </tr>
  
<?php 
  while ($row = mysqli_fetch_row($result)) {
  echo"<tr>";
	$thisID = $row[0];
    echo"<td>$row[1]</td>";
    echo"<td>$row[2]</td>";
	echo"<td>$row[3]</td>";
	echo"<td>$row[4]</td>";
	echo"<td><a href='forumView.php?id=$thisID'> ^VIEW^ </a></td>";
	echo"<td><a href='forumDelete.php?$thisID'> <font color='red'>*DELETE* </a></font></td>";
	echo"<td><a href='forumBan.php?$thisID'> <font color='red'>*BAN* </a></font></td>";
  echo"</tr>";
}
?>
</table>