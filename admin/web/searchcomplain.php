<table border='2' width='100%'>
<th> <h2>Manage Complains</h2></th>
<tr><td>
<a href="welcome.php"><b><font color='green'> << BACK HOME <<</font> </b></a>
<br>
</td></tr>
</table>
<br><br><br>


<?php	  
include('session.php');

date_default_timezone_set("Singapore");
$date=date('Y-m-d');

$result = mysqli_query($db, "SELECT * FROM complain ORDER BY complain_id DESC;");
if($result == true) {
	echo "<table style='width:100%' border='1'>";
        echo "<tr>
	  <th width='5%'>ID</th>
	  <th width='10%'>Title</th>
	  <th width='10%'>Content</th>
	  <th width='10%'>User</th>
	  <th width='10%'>Date</th>
	  <th width='10%'>Time</th>
	  <th width='10%'>Status</th>
	  <th width='10%'>Comments</th>
	  <th width='10%'>VIEW</th>
	  <th width='10%'>DELETE</th>
	  
	  
	  </tr>";
	while($row = mysqli_fetch_row($result)) {
      echo "<tr>
	  <td>". $row[0] . "</td>
	  <td>". $row[1] . "</td>
	  <td>". $row[2] . "</td>
	  <td>". $row[3] . "</td>
	  <td>". $row[4] . "</td>
	  <td>". $row[5] . "</td>
	  <td>". $row[6] . "</td>
	  <td>". $row[7] . "</td>
	  <th><a href = 'viewcomplain.php?complain_id=".$row[0]."'>Update & Comment</a></th>
	  <th><a href = 'deletecomplain.php?".$row[0]."'><font color='red'>*DELETE*</font></a></th>
	  </tr>";
   }
	echo "</table>";
}
else if( $result == false){

    echo "there are no complains";
}
else{
    echo "there are no complains";
}

?>