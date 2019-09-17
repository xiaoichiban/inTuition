<?php 

include('session.php');

$query = "SELECT *  FROM announcement ORDER BY id DESC;";

$result = mysqli_query($db, $query);
?>




<table border='2' width='100%'>
<th> <h2>Manage Announcement</h2></th>
<tr><td>
<a href="welcome.php"><b><font color='green'> << BACK HOME <<</font> </b></a>
<br>
</td></tr>
</table>
<br><br><br>





<table border='1'>
  <tr>
    <th>id</th>
    <th>datetime</th>
    <th>topic</th>
    <th>body</th>
    <th>action</th>
  </tr>
  
  
  <?php 

  while ($row = mysqli_fetch_row($result)) {
  echo"<tr>";
  $id = $row[0];
  
    echo"<td>$id</td>";
	
	
    echo"<td>$row[1]</td>";
    echo"<td>$row[2]</td>";
    echo"<td>$row[3]</td>";
	echo"<td><a href='announceDelete.php?$id'><font color='red'>*DELETE* </a></font></a></td>";
	
	
  echo"</tr>";
}
  ?>
  
  
 
</table>