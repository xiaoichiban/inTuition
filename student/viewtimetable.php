<?php
include 'config.php';
include 'session.php';
include 'layout/sidebar.php';
?>
<html>
<head>
  <title>My Modules</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
  <script>document.getElementsByTagName("html")[0].className += " js";</script>
  <link rel="stylesheet" href="layout/timetablestyle.css">
</head>
<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns">
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-wrapper-before"></div>
      <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
          <h3 class="content-header-title">My Timetable</h3>
        </div>

      </div>

      <div class="content-body">


        <h6><a href = 'studentdashboard.php'>Back</a></h6>
      </div>
    </div>  <!-- end of content-body -->
    <div class="cd-schedule cd-schedule--loading margin-top-lg margin-bottom-lg js-cd-schedule">
      <div class="cd-schedule__timeline">
        <ul>
          <li><span>08:00</span></li>
          <li><span>09:00</span></li>
          <li><span>10:00</span></li>
          <li><span>11:00</span></li>
          <li><span>12:00</span></li>
          <li><span>13:00</span></li>
          <li><span>14:00</span></li>
          <li><span>15:00</span></li>
          <li><span>16:00</span></li>
          <li><span>17:00</span></li>
          <li><span>18:00</span></li>
          <li><span>19:00</span></li>
          <li><span>20:00</span></li>
          <li><span>21:00</span></li>
          <li><span>22:00</span></li>
        </ul>
      </div> <!-- .cd-schedule__timeline -->

      <div class="cd-schedule__events">
        <ul>
          <?php
          $username = $_SESSION['login_user'];
          $sql1 = "SELECT account_type FROM account WHERE username = '$username';";
          $result1 = mysqli_query($db, $sql1);
          while ($row1 = mysqli_fetch_row($result1)) {
            $acctype = $row1[0];
            if ($acctype == "student"){
              $daynum = 0;

              while ($daynum <7){
                echo "<li class='cd-schedule__group'><div class='cd-schedule__top-info'>";
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
                echo "<span>$day_label</span></div><ul>";
                $day = "SELECT * FROM module WHERE id IN (SELECT mod_id FROM enroll WHERE student = '$username' AND class_day ='$daynum' AND status = 'accepted') ORDER BY class_day, class_startTime ASC;";
                $daymodules = mysqli_query($db, $day);
                if (mysqli_num_rows($daymodules) >0){
                  $i = 1;
                  while ($row = mysqli_fetch_row($daymodules)) {
                    $starthour = $row[4]/100;
                    $endhour = $row[5]/100;
                    echo "<li class='cd-schedule__event'><a data-start='$starthour:00' data-end='$endhour:00'  data-content='event-rowing-workout' data-event='event-$i' href='#0'>
                    <em class='cd-schedule__name'>$row[1]</em></a></li>";
                    if ($i = 4){
                      $i = 1;
                    }
                    else{
                      $i = $i+1;
                    }
                  }
                }
                echo "</ul></li>";
                $daynum = $daynum + 1;
              }
            }
          }
          ?>

        </ul>
      </div>


      <div class="cd-schedule-modal">
        <header class="cd-schedule-modal__header">
          <div class="cd-schedule-modal__content">
            <span class="cd-schedule-modal__date"></span>
            <h3 class="cd-schedule-modal__name"></h3>
          </div>

          <div class="cd-schedule-modal__header-bg"></div>
        </header>

        <div class="cd-schedule-modal__body">
          <div class="cd-schedule-modal__event-info"></div>
          <div class="cd-schedule-modal__body-bg"></div>
        </div>

        <a href="#0" class="cd-schedule-modal__close text-replace">Close</a>
      </div>

      <div class="cd-schedule__cover-layer"></div>
    </div> <!-- .cd-schedule -->
  </div>
   <!-- end of content-wrapper -->
</div>
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

<script src="layout/timetableutil.js"></script> <!-- util functions included in the CodyHouse framework -->
<script src="layout/timetablemain.js"></script>

</body>
</html>
