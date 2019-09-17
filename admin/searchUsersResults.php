<table border='2' width='100%'>
<th> <h2>Manage Users</h2></th>
<tr><td>
<a href="welcome.php"><b><font color='green'> << BACK HOME <<</font> </b></a>
<br>
</td></tr>
</table>
<br><br><br>


<table border='1'>
  <tr>
    <th>username</th>
    <th>name</th>
    <th>last_seen</th>
    <th>about</th>
    <th>email</th>
    <th>Registered ON</th>
    <th>status</th>
    <th>avatar</th>
  </tr>
  
  
  <?php 
  
  
  include('session.php');
  
  $search = $_POST['search'];
  
  $query = "SELECT * FROM account WHERE username ILIKE '%$search%' OR email ILIKE '%$search%';" ;
  
  if ($search=='*' || $search==null || $search==''){
	  $query = "SELECT *  FROM account;";
  }


$result = mysqli_query($db, $query);

  while ($row = mysqli_fetch_row($result)) {
  echo"<tr>";
  $user = $row[0];
  
    echo"<td>";
  echo $user;
    echo"</td>";
	
    echo"<td>";
  echo "$row[1]";
    echo"</td>";
	
	
	echo"<td>";
  echo "$row[3]";
    echo"</td>";
	
	
	echo"<td>";
  echo "$row[5]";
    echo"</td>";
	
	echo"<td>";
  echo "$row[6]";
    echo"</td>";
	
	echo"<td>";
  echo "$row[7]";
    echo"</td>";
	
	echo"<td>";
  echo "$row[8]";
    echo"</td>";
	
	
	echo"<td>";
  echo "<a href='modUser.php?user=$user'> EDIT USER</a>";
    echo"</td>";
	
	
  echo"</tr>";
}
  ?>
  
  
 
</table>