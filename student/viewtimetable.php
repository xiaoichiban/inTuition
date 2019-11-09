<html>
<head>
  <title>My Timetable</title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="layout/timetablestyle.css">
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
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <!-- END Custom CSS-->
</head>
<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns">

  <?php
  include 'session.php';
  include 'config.php';
  include './layout/sidebar.php';

  ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-wrapper-before"></div>
      <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
          <h3 class="content-header-title">My Timetable</h3>
        </div>

      </div>

      <div class="content-body">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="card-content">
                  <div class="card-body">
                    <?php
                    $username = $_SESSION['login_user'];
                    $sql1 = "SELECT account_type FROM account WHERE username = '$username';";
                    $result1 = mysqli_query($db, $sql1);
                    $colorsnum = 0;
                    while ($row1 = mysqli_fetch_row($result1)) {
                      $acctype = $row1[0];
                      if ($acctype == "student"){
                        $daynum = 0;
                        echo "<div class='table-responsive'><table style='width:100%; overflow:auto; empty-cells:show;' class='table'>" .
                        "<tr><th></th><th>0800</th><th>0900</th><th>1000</th><th>1100</th><th>1200</th><th>1300</th><th>1400</th><th>1500</th><th>1600</th><th>1700</th><th>1800</th><th>1900</th><th>2000</th><th>2100</th><th>2200</th></tr>";
                        while ($daynum <7){
                          $day = "SELECT * FROM module WHERE id IN (SELECT mod_id FROM enroll WHERE student = '$username') AND class_day = '$daynum' ORDER BY class_startTime ASC;";
                          $daymodules = mysqli_query($db, $day);
                          if ($daynum == 0){
                            $day_label = "Sun";
                          }
                          elseif ($daynum == 1) {
                            $day_label = "Mon";
                          }
                          elseif ($daynum == 2) {
                            $day_label = "Tue";
                          }
                          elseif ($daynum == 3) {
                            $day_label = "Wed";
                          }
                          elseif ($daynum == 4) {
                            $day_label = "Thu";
                          }
                          elseif ($daynum == 5) {
                            $day_label = "Fri";
                          }
                          else{
                            $day_label = "Sat";
                          }
                          echo "<tr><th style='font-weight: bold;'>$day_label</th>";
                          $i = 8;
                          if (mysqli_num_rows($daymodules)==0){
                            while ($i < 23){
                              echo "<th></th>";
                              $i = $i + 1;
                            }
                          }
                          else{
                            $numResults = mysqli_num_rows($daymodules);
                            $cellcounter = 0;
                            while ($numResults >0) {
                              $row = mysqli_fetch_row($daymodules);
                              if ($colorsnum == 0){
                                $colorclass = '#FF8A80';
                              }
                              else if ($colorsnum == 1){
                                $colorclass = '#FFEE58';
                              }
                              else if ($colorsnum == 2){
                                $colorclass = '#efbbff';
                              }
                              else if ($colorsnum == 3){
                                $colorclass = '#80DEEA';
                              }
                              else if ($colorsnum == 4){
                                $colorclass = '#1DE9B6';
                              }
                              else if ($colorsnum == 5){
                                $colorclass = '#edca98';
                              }
                              else if ($colorsnum == 6){
                                $colorclass = '#ffb74c';
                              }
                              $tempnum;
                              if ($numResults > 0 && $i == 23){
                                $i = $tempnum;
                              }

                              while ($i < 23){
                                $num_hours = ((int)$row[5] - (int)$row[4]) /100;
                                if ($row[4]/100 == $i){
                                  echo "<th colspan='$num_hours' style='background-color:$colorclass; color:black;'><p style='font-weight:bold;'>". $row[1]."</p><p>" . $row[4] . " - " . $row[5] . "</p></th>";
                                  $i = $i + $num_hours;
                                  $cellcounter = $cellcounter + $num_hours;
                                  $tempnum = $i;
                                  $i = 22;

                                }
                                else{
                                  echo "<th></th>";
                                  $cellcounter = $cellcounter +1;
                                }

                                $i = $i + 1;
                              }
                              if ($colorsnum < 6){
                                $colorsnum = $colorsnum + 1;
                              }
                              else{
                                $colorsnum = 0;
                              }
                              $numResults = $numResults -1;
                            }
                            if ($cellcounter != 15){
                              $cellcounter = 15 - $cellcounter;
                            }
                            while ($cellcounter > 0){
                              echo "<th></th>";
                              $cellcounter = $cellcounter -1;
                            }
                          }

                          echo "</tr>";
                          $daynum = $daynum + 1;

                        }

                        echo "</table></div>";
                      }

                    }
                    ?>

                  </div>
                </div>
              </div>
            </div>
            <h6><a href = 'studentdashboard.php'>Back</a></h6>
          </div>
        </div>

      </div>  <!-- end of content-body -->
    </div>  <!-- end of content-wrapper -->
  </div>  <!-- end of app-content content -->

  ?>


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
