<?php
include 'config.php';
include 'session.php';
?>
<html>
  <head>
    <title>My Modules</title>
    <link rel="apple-touch-icon" href="./layout/theme-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="./layout/theme-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="./layout/theme-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="./layout/theme-assets/vendors/css/charts/chartist.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN CHAMELEON  CSS-->
    <link rel="stylesheet" type="text/css" href="./layout/theme-assets/css/app-lite.css">
    <!-- END CHAMELEON  CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="./layout/theme-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="./layout/theme-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="./layout/theme-assets/css/pages/dashboard-ecommerce.css">
  </head>
  <body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns">
    <?= 
      include './layout/sidebar.php';

    ?>
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
        $module_name = $row[1];
        echo "<tr><th>". $module_name."</th>
        <th>". $row[6]."</th>";
        $sql_check = "SELECT * FROM module WHERE name = '$module_name' AND name IN (SELECT name FROM module WHERE id IN (SELECT mod_id FROM enroll WHERE student = '$username'));";
        $result_check = mysqli_query($db, $sql_check);
        if (mysqli_num_rows($result_check)==0){
          echo"<th><a href = 'registermodule.php?module_name=$module_name'>Register</a></th>";
        }
        else{
          $sql3 = "SELECT * FROM module WHERE id IN (SELECT id FROM module WHERE name = '$module_name' AND id IN (SELECT mod_id FROM enroll WHERE student = '$username'));";
          $result3 = mysqli_query($db, $sql3);
          while($row3 = mysqli_fetch_row($result3)){
            echo"<th><a href = 'viewmodule.php?module_id=".$row3[0]."'>View</a></th>";
          }
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
          $module_name = $row[1];
          echo "<tr><th>". $module_name."</th>
          <th>". $row[6]."</th>";
          $sql_check = "SELECT * FROM module WHERE name = '$module_name' AND name IN (SELECT name FROM module WHERE id IN (SELECT mod_id FROM enroll WHERE student = '$username'));";
          $result_check = mysqli_query($db, $sql_check);
          if (mysqli_num_rows($result_check)==0){
            echo"<th><a href = 'registermodule.php?module_name=$module_name'>Register</a></th>";
          }
          else{
            $sql3 = "SELECT * FROM module WHERE id IN (SELECT id FROM module WHERE name = '$module_name' AND id IN (SELECT mod_id FROM enroll WHERE student = '$username'));";
            $result3 = mysqli_query($db, $sql3);
            while($row3 = mysqli_fetch_row($result3)){
              echo"<th><a href = 'viewmodule.php?module_id=".$row3[0]."'>View</a></th>";
            }
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
