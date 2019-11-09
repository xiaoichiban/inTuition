<?php
include 'config.php';
include 'session.php';
?>
<html>
<head>
  <title>My Modules</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script>document.getElementsByTagName("html")[0].className += " js";</script>
  <link rel="stylesheet" href="layout/timetablestyle.css">
</head>
<body>
  <header class="cd-main-header text-center flex flex-column flex-center">
    <h1 class="text-xl">Schedule Template</h1>
  </header>

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
                while ($row = mysqli_fetch_row($daymodules)) {
                  $starthour = $row[4]/100;
                  $endhour = $row[5]/100;
                  echo "<li class='cd-schedule__event'><a data-start='$starthour:00' data-end='$endhour:00'  data-content='event-rowing-workout' data-event='event-2' href='#0'>
                  <em class='cd-schedule__name'>$row[1]</em></a></li>";
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

  <script src="layout/timetableutil.js"></script> <!-- util functions included in the CodyHouse framework -->
  <script src="layout/timetablemain.js"></script>

</body>
</html>
