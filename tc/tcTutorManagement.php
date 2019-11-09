<table border='2' width='100%'>
  <th> <h2>Tution Centre Tutor Management</h2></th>
  <tr><td>
  <a href="tcdashboard.php"><b><font color='green'> << BACK <<</font> </b></a>
  <br><br>
  <a href="createTutor.php"><b><font color='green'> + Add Tutor + </font> </b></a>
  </td></tr>
</table>
<br><br><br>

<!-- Module search function -->
<form action="tcTutorManagement.php" method="GET">
  <input type="text" name="search" />
  <input type="submit" value="Search" />
</form>

<table border='1'>
  <tr>
    <th width='10%'>Tutor ID</th>
    <th width='20%'>Tutor username</th>
    <th width='25%'>Profile</th>
  </tr>

  <!-- Search for active module method-->
  <?php
    include '../config.php';
    include '../session.php';
    $tc = $_SESSION['login_user'];

    if(isset($_GET['search'])  != "") {
      $search_value = $_GET['search'];

      $sql="SELECT * from tutor where tc_owner = '$tc' AND username LIKE '%$search_value%'";

      $result = mysqli_query($db, $sql);

      while ($row = mysqli_fetch_row($result)) {
      echo"<tr>";
      $username = $row[1];
      echo"<td>"; echo "$row[0]"; echo"</td>";
      echo"<td>"; echo "$row[1]"; echo"</td>";
      echo"<td>"; echo "<a href='viewProfile.php?username=$username'> View Profile </a>"; echo"</td>";
      echo"</tr>";
      }
    }

    else {
      $sql="SELECT * from tutor where tc_owner = '$tc'";

      $result = mysqli_query($db, $sql);

      while ($row = mysqli_fetch_row($result)) {
      echo"<tr>";
      $username = $row[1];
      echo"<td>"; echo "$row[0]"; echo"</td>";
      echo"<td>"; echo "$row[1]"; echo"</td>";
      echo"<td>"; echo "<a href='viewProfile.php?username=$username'> View Profile </a>"; echo"</td>";
      echo"</tr>";
      }
    }
  ?>
