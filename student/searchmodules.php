
<?php
include './layout/config.php';
include ('session.php');
?>
<html>
  <head>
    <title>My Modules</title>
    <link rel="apple-touch-icon" href="./layout/theme-assets/images/ico/apple-icon-120.png"/>
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
    <?php


      include ('./layout/sidebar.php');
    ?>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Search Modules</h3>
          </div>

        </div>

        <div class="content-body">
          <div class="row pl-1">
            <div class="card" style="background: none;">
              <form action="searchmodules.php" method="GET">
                <input type="text" style="width: 50%; display: inline;" name="search" placeholder="Enter a module name" class="form-control"/>
                <input type="submit" class="btn btn-primary" value="Search for module" />
              </form>
            </div>
          </div>

        <div class="row">
          <?php
            $username = $_SESSION['login_user'];
            if(isset($_GET['search']) != "") {
              $search_value = $_GET['search'];
              // echo"$search_value";
              $sql="SELECT * from module where name LIKE '%".$search_value."%' GROUP BY name, tc;";
              // $sql= "SELECT * from module where tc = '$tc'";

              $result = mysqli_query($db, $sql);
          ?>


            <?php
              if(mysqli_fetch_row($result) == 0) {
                echo"<h3><b>No results for \"$search_value\"</h3>";
              }
              while ($row = mysqli_fetch_row($result)) {
            ?>
              <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-content">
                      <div class="card-body">

                            <?php
                              $module_name = $row[1];
                                echo "<h4 class='card-title'>Module name: $module_name</h4>";
                                echo "<p class='card-text'>Offered by: $row[6]</p>";

                                $sql_check = "SELECT * FROM module WHERE name = '$module_name' AND name IN (SELECT name FROM module WHERE id IN (SELECT mod_id FROM enroll WHERE student = '$username'));";
                                $result_check = mysqli_query($db, $sql_check);
                                if (mysqli_num_rows($result_check)==0){
                                  echo"<button type='button' class='btn btn-primary'><a style='color:white;' href = 'registermodule.php?module_name=$module_name'>Register</a></button>";
                                }
                                else{
                                  $sql3 = "SELECT * FROM module WHERE id IN (SELECT id FROM module WHERE name = '$module_name' AND id IN (SELECT mod_id FROM enroll WHERE student = '$username'));";
                                  $result3 = mysqli_query($db, $sql3);
                                  while($row3 = mysqli_fetch_row($result3)){
                                    echo"<th><a href = 'viewmodule.php?module_id=".$row3[0]."'>View</a></th>";
                                  }
                                }
                            ?>

                      </div>
                    </div>
                  </div>
              </div>


            <?php
            } //end of row

            } else {
              $sql1 = "SELECT account_type FROM account WHERE username = '$username';";
              $result1 = mysqli_query($db, $sql1);
              while ($row1 = mysqli_fetch_row($result1)) {

              $acctype = $row1[0];
              if ($acctype == "student"){
                $sql2 = "SELECT * FROM module GROUP BY name, tc;";
                $result2 = mysqli_query($db, $sql2);

                while ($row = mysqli_fetch_row($result2)) {

            ?>
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-content">
                      <div class="card-body">

                              <?php
                                $module_name = $row[1];
                                echo "<h4 class='card-title'>Module name: $module_name</h4>";
                                echo "<p class='card-text'>Offered by: $row[6]</p>";
                                echo "<p class='card-text'> $row[2]</p>";
                                $sql_check = "SELECT * FROM module WHERE name = '$module_name' AND name IN (SELECT name FROM module WHERE id IN (SELECT mod_id FROM enroll WHERE student = '$username'));";
                                $result_check = mysqli_query($db, $sql_check);
                                if (mysqli_num_rows($result_check)==0){
                                  echo "<button type='button' class='btn btn-primary'><a style='color:white;' href= 'registermodule.php?module_name=$module_name'>Register</a></button>";
                                }
                                else{
                                  $sql3 = "SELECT * FROM module WHERE id IN (SELECT id FROM module WHERE name = '$module_name' AND id IN (SELECT mod_id FROM enroll WHERE student = '$username'));";
                                  $result3 = mysqli_query($db, $sql3);
                                  while($row3 = mysqli_fetch_row($result3)){
                                    echo "<br>";
                                    echo "<a href = 'viewmodule.php?module_id=".$row3[0]."'>View</a>";
                                  }
                                }

                              ?>

                      </div>
                    </div>
                  </div>
              </div>

            <?php

              } // end of while
          } //end of if acctype == student
            } //end of row1 while loop
          } //end of else
            ?>

            </div>  <!-- end of row -->
            <a class='btn btn-primary' href = 'studentdashboard.php'>Back</a>
      </div> <!-- end of content-body -->
    </div> <!-- end of content-wrapper -->
  </div>  <!-- end of app-content -->

  <!-- BEGIN VENDOR JS-->
    <script src="./layout/theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="./layout/theme-assets/vendors/js/charts/chartist.min.js" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN CHAMELEON  JS-->
    <script src="./layout/theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>
    <script src="./layout/theme-assets/js/core/app-lite.js" type="text/javascript"></script>
    <!-- END CHAMELEON  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="./layout/theme-assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->


  </body>
</html>
