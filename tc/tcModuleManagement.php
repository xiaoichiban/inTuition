<table border='2' width='100%'>
  <th> <h2>Tution Centre Module Management</h2></th>
  <tr><td>
  <a href="tcdashboard.php"><b><font color='green'> << BACK <<</font> </b></a>
  <br><br>
  <a href="createModule.php"><b><font color='green'> + Create New Module + </font> </b></a>
  </td></tr>
</table>
<br><br><br>

<!-- Module search function -->
<form action="tcModuleManagement.php" method="GET">
  <input type="text" name="search" />
  <input type="submit" value="Search for module" />
</form>

<table border='1'>
  <tr>
    <th width='10%'>Module ID</th>
    <th width='30%'>Name</th>
    <th width='30%'>Description</th>
    <th width='30%'>Tution Centre</th>
    <th  width='15%'>Tutor</th>
    <th  width='10%'>Status</th>
    <th  width='20%'>Details</th>
  </tr>

  <!-- Search for active module method-->
  <?php
    include '../config.php';
    include '../session.php';
    $tc = $_SESSION['login_user'];

    if(isset($_GET['search']) != "") {
      $search_value = $_GET['search'];

      $sql="SELECT * from module where tc = '$tc' AND description LIKE '%$search_value%'";
      // $sql= "SELECT * from module where tc = '$tc'";

      $result = mysqli_query($db, $sql);

      while ($row = mysqli_fetch_row($result)) {
      echo"<tr>";
      $thisID = $row[0];
      echo"<td>"; echo "$row[0]"; echo"</td>";
      echo"<td>"; echo "$row[1]"; echo"</td>";
      echo"<td>"; echo "$row[2]"; echo"</td>";
      echo"<td>"; echo "$row[3]"; echo"</td>";
      echo"<td>"; echo "$row[4]"; echo"</td>";
      echo"<td>"; echo "$row[6]"; echo"</td>";
      echo"<td>"; echo "<a href='viewmodule.php?module_id=$thisID'> View Module </a>"; echo"</td>";
      echo"</tr>";
      }
    }

    else {
      $sql= "SELECT * from module where tc = '$tc';";

      $result = mysqli_query($db, $sql);

      while ($row = mysqli_fetch_row($result)) {
      echo"<tr>";
      $thisID = $row[0];
      echo"<td>"; echo "$row[0]"; echo"</td>";
      echo"<td>"; echo "$row[1]"; echo"</td>";
      echo"<td>"; echo "$row[2]"; echo"</td>";
      echo"<td>"; echo "$row[3]"; echo"</td>";
      echo"<td>"; echo "$row[4]"; echo"</td>";
      echo"<td>"; echo "$row[6]"; echo"</td>";
      echo"<td>"; echo "<a href='viewmodule.php?module_id=$thisID'> View Module </a>"; echo"</td>";
      echo"</tr>";
      }
    }
  ?>
