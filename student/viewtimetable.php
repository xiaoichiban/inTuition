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
      $daynum = 0;
      echo "<table style='width:100%' border='1'>" .
      "<tr><th></th><th>0800</th><th>0900</th><th>1000</th><th>1100</th><th>1200</th><th>1300</th><th>1400</th><th>1500</th><th>1600</th><th>1700</th><th>1800</th><th>1900</th><th>2000</th><th>2100</th><th>2200</th></tr>";
      while ($daynum <7){
        $day = "SELECT * FROM module WHERE id IN (SELECT mod_id FROM enroll WHERE student = '$username') AND class_day = '$daynum' ORDER BY class_startTime ASC;";
        $daymodules = mysqli_query($db, $day);
        if ($daynum == 0){
          $day_label = "Sunday";
        }
        elseif ($daynum == 1) {
          $day_label = "Monday";
        }
        elseif ($daynum == 2) {
          $day_label = "Tuesday";
        }
        elseif ($daynum == 3) {
          $day_label = "Wednesday";
        }
        elseif ($daynum == 4) {
          $day_label = "Thursday";
        }
        elseif ($daynum == 5) {
          $day_label = "Friday";
        }
        else{
          $day_label = "Saturday";
        }
        echo "<tr><th>$day_label</th>";
        $i = 8;
        if (mysqli_num_rows($daymodules)==0){
          while ($i < 23){
            echo "<th></th>";
            $i = $i + 1;
          }
        }
        else{
          while ($row = mysqli_fetch_row($daymodules)) {
            while ($i < 23){
              $num_hours = ((int)$row[5] - (int)$row[4]) /100;
              if ($row[4]/100 == $i){
                echo "<th colspan='$num_hours'>". $row[1]."</th>";
                $i = $i + $num_hours -1;
              }
              else{
                echo "<th></th>";
              }

              $i = $i + 1;
            }

          }
        }

        echo "</tr>";
        $daynum = $daynum + 1;
      }

      echo "</table>";
    }

  }

  echo "<h3><a href = 'studentdashboard.php'>Back</a></h3>";
  ?>
</body>
</html>
