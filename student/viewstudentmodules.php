<?php
include 'config.php';
include 'session.php';
?>
<html>
  <head>
    <title>My Modules</title>
  </head>
  <body>

    <?php
    $username = $_SESSION['login_user'];
    $sql1 = "SELECT account_type FROM account WHERE username = '$username';";
    $result1 = mysqli_query($db, $sql1);
    while ($row1 = mysqli_fetch_row($result1)) {
      $acctype = $row1[0];
      if ($acctype == "student"){
        $sql2 = "SELECT * FROM module WHERE id IN (SELECT mod_id FROM enroll WHERE student = '$username');";
        $result2 = mysqli_query($db, $sql2);
        echo "<table style='width:100%' border='1'>" .
        "<tr><th></th>" .
        "<th>module_id</th>" .
        "<th>module_name</th>" .
        "<th>description</th>" .
        "<th>offered by</th>" .
        "<th>tutored by</th>" .
        "<th>enrolled</th></tr>";
        while ($row = mysqli_fetch_row($result2)) {
          $module_details = mysqli_query($db, "SELECT * FROM module m WHERE m.id = '$row[0]'");
          $module_row = mysqli_fetch_row($module_details);
          $enroll_details = mysqli_query($db, "SELECT * FROM enroll e WHERE e.mod_id = '$row[0]'");
          $enroll_row = mysqli_fetch_row($enroll_details);
          echo "<tr>
          <th><a href = 'viewmodule.php?module_id=".$row[0]."'>View</a></th>
          <th>". $row[0]."</th>
          <th>". $row[1]."</th>
          <th>". $row[2]."</th>
          <th>". $row[3]."</th>
          <th>". $row[4]."</th>
          <th>". $enroll_row[3]."</th>
          </tr></table>";
        }
      }

    }

    echo "<h3><a href = 'studentdashboard.php'>Back</a></h3>";
     ?>
  </body>
</html>
