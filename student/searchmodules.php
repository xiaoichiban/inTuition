<?php
include 'config.php';
include 'session.php';
?>
<html>
  <head>
    <title>My Modules</title>
  </head>
  <body>
    <form action="searchmodules.php" method="GET">
      <input type="text" name="search" />
      <input type="submit" value="Search for module" />
    </form>

    <?php
    $username = $_SESSION['login_user'];
    if(isset($_GET['search']) != "") {
      $search_value = $_GET['search'];

      $sql="SELECT * from module where name LIKE '%$search_value%' GROUP BY name, tc;";
      // $sql= "SELECT * from module where tc = '$tc'";

      $result = mysqli_query($db, $sql);

      echo "<table style='width:100%' border='1'>" .
      "<tr><th>module_name</th>" .
      "<th>offered by</th>";
      while ($row = mysqli_fetch_row($result)) {
        echo "<tr><th>". $row[1]."</th>
        <th>". $row[6]."</th>";
        $sql_check = "SELECT * FROM module WHERE name IN (SELECT m.name FROM module m, enroll e WHERE m.id = e.mod_id AND e.student = '$username');";
        $result_check = mysqli_query($db, $sql_check);
        if (mysqli_num_rows($result_check)==0){
          echo"<th><a href = 'registermodule.php?module_name=".$row[1]."'>Register</a></th>";
        }
        else{
          $sql3 = "SELECT * FROM module WHERE id IN (SELECT m.id FROM module m, enroll e WHERE m.id = e.mod_id AND m.name = '$row[1]' AND e.student = '$username');";
          $result3 = mysqli_query($db, $sql3);
          $row3 = mysqli_fetch_row($result3);
          echo"<th><a href = 'viewmodule.php?module_id=".$row3[0]."'>View</a></th>";
        }
        echo"</tr>";
      }
      echo "</table>";
    }

    else {
    $sql1 = "SELECT account_type FROM account WHERE username = '$username';";
    $result1 = mysqli_query($db, $sql1);
    while ($row1 = mysqli_fetch_row($result1)) {
      $acctype = $row1[0];
      if ($acctype == "student"){
        $sql2 = "SELECT * FROM module GROUP BY name, tc;";
        $result2 = mysqli_query($db, $sql2);
        echo "<table style='width:100%' border='1'>" .
        "<tr><th>module_name</th>" .
        "<th>offered by</th>";
        while ($row = mysqli_fetch_row($result2)) {
          echo "<tr><th>". $row[1]."</th>
          <th>". $row[6]."</th>";
          $sql_check = "SELECT * FROM module WHERE name IN (SELECT m.name FROM module m, enroll e WHERE m.id = e.mod_id AND e.student = '$username');";
          $result_check = mysqli_query($db, $sql_check);
          if (mysqli_num_rows($result_check)==0){
            echo"<th><a href = 'registermodule.php?module_name=".$row[1]."'>Register</a></th>";
          }
          else{
            $sql3 = "SELECT * FROM module WHERE id IN (SELECT m.id FROM module m, enroll e WHERE m.id = e.mod_id AND m.name = '$row[1]' AND e.student = '$username');";
            $result3 = mysqli_query($db, $sql3);
            $row3 = mysqli_fetch_row($result3);
            echo"<th><a href = 'viewmodule.php?module_id=".$row3[0]."'>View</a></th>";
          }
          echo"</tr>";
        }
        echo "</table>";
      }

    }
  }

    echo "<h3><a href = 'studentdashboard.php'>Back</a></h3>";
     ?>
  </body>
</html>
