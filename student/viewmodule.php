<html>
<head>
  <title>Dashboard</title>

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
  include('session.php');
  $username = $_SESSION['login_user'];
  $date = date('Y-m-d');
  $module_id = $_GET['module_id'];

  include './layout/sidebar.php';

  $sql = "SELECT * FROM module WHERE id = '$module_id'; ";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_row($result);
  if ($row[3] == 0){
    $day_label = "Sun";
  }
  elseif ($row[3] == 1) {
    $day_label = "Mon";
  }
  elseif ($row[3] == 2) {
    $day_label = "Tue";
  }
  elseif ($row[3] == 3) {
    $day_label = "Wed";
  }
  elseif ($row[3] == 4) {
    $day_label = "Thu";
  }
  elseif ($row[3] == 5) {
    $day_label = "Fri";
  }
  else{
    $day_label = "Sat";
  }

  //check if student is already enrolled
  $sqlcheck = "SELECT * FROM enroll WHERE mod_id = '$module_id' AND student = '$username' AND status = 'accepted';";
  $resultcheck = mysqli_query($db, $sqlcheck);
  if (mysqli_num_rows($resultcheck) != 1){
    $seecontent = false;
  }
  else{
    $seecontent = true;
  }
  if (mysqli_num_rows($result) != 1) {
    echo "invalid module $module_id";
  }
  else if ($row[6] == 'inactive'){
    echo "module is no longer active";
  }
  else {
    ?>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Module details</h3>
          </div>

        </div>

        <div class="content-body">

          <div class="row">
            <div class="col-12">
              <div class="card">

                <div class="card-content">
                  <div class="card-body">
                    <table class='table table-borderless' style="width:40%;">
                      <tbody><tr><td><b>Module Name: </b> </td><td><?php echo $row[1]; ?></td></tr>
                        <tr><td><b>Time: </b> </td><td><?php echo $day_label . " " . $row[4] . " - " . $row[5]; ?></td></tr>
                        <tr><td><b>Description: </b> </td><td><?php echo $row[2]; ?></td></tr>
                        <tr><td><b>Offered by: </b> </td><td><?php echo $row[6]; ?></td></tr>
                        <tr><td><b>Tutored by: </b> </td><td><?php echo $row[7]; ?></td></tr></tbody>
                      </table>

                      <?php
                      if ($seecontent){
                        echo "<button type='button' class='btn btn-primary' style='float:right;''><a style='color:white;' href = 'fileUploadedList.php?mod_id=$row[0]'>Module Uploaded Files</a></button>";
                      }
                      ?>
                      <br/>
                      <br/>
                    </div>
                  </div>
                </div>

              </div>
            </div>  <!-- end of class row -->

            <div class="row">
              <div class="col-12">
                <div class="card">

                  <div class="card-content">
                    <div class= "card-header">
                      <h5 class='card-title'>Videos</h5>
                    </div>
                    <div class="card-body">
                      <?php
                      $thistutor = $_SESSION['username'];
                      $sqlQuery = "SELECT * from video v  WHERE v.mod_id = '$module_id';";

                      $result = mysqli_query($db, $sqlQuery);
                      echo "<table class='table'><thead><tr><th><b>Name</b></th><th><b>Description</b</th><th><b>Filename</b></th><th><b>Subtitles</b></th><th><b>Uploaded</b></th><th></th></tr></thead><tbody>";
                      while ($row = mysqli_fetch_assoc($result)) {
                        $subs = $row['subtitles'];
                        $vid  = $row['filename'];
                        echo "<td>".$row['name'] . "</td>";
                        echo "<td>".$row['description'] . "</td>";
                        echo "<td>".$row['filename'] . "</td>";
                        echo "<td>".$row['subtitles'] . "</td>";
                        echo "<td>".$row['datetimestamp'] . " </td>";
                        echo "<td><a class='btn btn-info' href='viewVideo.php?id=$vid&subs=$subs'>
                        <b>WATCH</b></a> </td></tr>";
                      }
                      echo "</tbody></table><br/>";
                      ?>
                    </div>
                  </div>
                </div>

              </div>
            </div>  <!-- end of class row -->
            <div class="content-header-left col-md-4 col-12 mb-2">
              <h4 class="content-header-title" style="color: #464855;">Available quizzes</h4>
            </div>

            <?php
            if ($seecontent){
              $sql2 = "SELECT * FROM quiz WHERE moduleid = '$module_id';";
              $result2 = mysqli_query($db, $sql2);
              if (mysqli_num_rows($result2) == 0) {
                echo "<h5 class='pl-1'>There are no quizzes for this module.</h5>";
              } else {

                ?>

                <div class="row">
                  <?php
                  while ($row1 = mysqli_fetch_row($result2)) {

                    ?>
                    <div class="col-lg-4 col-md-12">
                      <a href = 'viewquiz.php?quizid=<?php echo $row1[0]; ?>'>
                        <div class="card pull-up ecom-card-1 bg-white">
                          <div class="card-header">
                            <h4 class="card-title" style='text-align:center;'><?php echo $row1[1] ?></h4>
                          </div>

                        </div>
                      </a>
                    </div>
                    <?php
                  } //end of while
                  ?>
                </div>  <!-- end of class row -->
                <?php

              }
            } //end of else

            $sql3 = "SELECT * FROM enroll WHERE mod_id = '$module_id' AND student = '$username'";
            $result3 = mysqli_query($db, $sql3);
            $row3 = mysqli_fetch_row($result3);
            if (mysqli_num_rows($result3) != 1) {
              echo "invalid module $module_id";
            }
            else {
              if ($row3[3] == 'pending'){
                echo "<br/>";
                echo "<div class='pl-1' style='align:center;'>";
                echo"<form action ='viewmodule.php?module_id=$row3[2]' method = 'post'>
                <input type = 'submit' class='btn btn-primary'  value = ' Deregister this module ' />
                </form>";
                echo "</div>";
              }
            }

            ?>
            <br/>
            <div class="pl-1">
              <button type='button' class='btn btn-primary'><a style='color:white;' href = 'studentdashboard.php'>Back</a></button>
            </div>
          </div> <!-- end of content body -->

        </div> <!-- end of content-wrapper -->
      </div> <!-- end of app content -->

      <?php

    } //end of ($row[6] == 'inactive') else.

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
  <?php
  $username = $_SESSION['login_user'];
  $date = date('Y-m-d');
  $module_id = $_GET['module_id'];

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "DELETE FROM enroll WHERE student = '$username' AND mod_id = '$module_id' AND status = 'pending';";
    $result = mysqli_query($db,$sql);

    if (!$result) {
      echo '<script>alert("An error occurred. Deregistration failed.")</script>';
      echo '<script>window.location.href = "viewmodule.php?module_id=' . $module_id .'";</script>';
    }
    else{
      echo "<script>alert('Deregistration successful.')</script>";
      echo '<script>window.location.href = "studentdashboard.php";</script>';
    }
  }
  ?>
