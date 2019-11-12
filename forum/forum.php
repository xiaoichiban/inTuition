<?php 
include 'config.php';
include 'session.php';

// gets value sent over search form

$searcher = '';

if ( isset($_GET['query']) ) { $searcher = $_GET['query']; }

$query =  "SELECT id,creator,datetimestamp,topic,body FROM 
thread WHERE body LIKE '%$searcher%' OR topic LIKE '%$searcher%' ORDER BY datetimestamp DESC;" ;

$result = mysqli_query($db, $query);
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


<p id="info-message"> <img src='loads.gif' height='160px' width='160px'> </p>
<script>
  setTimeout(function(){
    document.getElementById('info-message').style.display = 'none';
    /* or
    var item = document.getElementById('info-message')
    item.parentNode.removeChild(item); 
    */
  }, 1500);
</script>









<form action="forum.php" method="GET">
	<input type="text" name="query" id="query" autofocus />
  <button type="submit" class="btn btn-success">SEARCH <i class="fa fa-search"></i></button>
</form>

<br/><br/>



<table class="table table-striped">
  <tr>
    <th width='10%'>Thread Creator</th>
	<th width='20%'>Date-Time</th>
	<th width='25%'>Topic</th>
	<th  width='30%'>Content</th><th  width='10%'> VIEW </th>
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


</center>