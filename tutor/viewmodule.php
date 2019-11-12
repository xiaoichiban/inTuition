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
<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-blue-cyan" data-col="2-columns">

  <?php
  include('session.php');
  $thisuser = $_SESSION['login_user'];
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
                    <table class='table table-borderless' style="width:40%; font-size:14px;">
                      <tbody><tr><td><b>Module Name: </b> </td><td><?php echo $row[1]; ?></td></tr>
                        <tr><td><b>Time: </b> </td><td><?php echo $day_label . " " . $row[4] . " - " . $row[5]; ?></td></tr>
                        <tr><td><b>Description: </b> </td><td><?php echo $row[2]; ?></td></tr>
                        <tr><td><b>Offered by: </b> </td><td><?php echo $row[6]; ?></td></tr>
                        <tr><td><b>Tutored by: </b> </td><td><?php echo $row[7]; ?></td></tr></tbody>
                        <tr><td><b>Number of Students: </b> </td><td><?php echo mysqli_fetch_row(mysqli_query($db, "SELECT COUNT(*) FROM enroll where mod_id = '$module_id';"))[0]; ?></td></tr>
                      </tbody>
                    </table>

                    <?php
                    $sql1 = "SELECT account_type FROM account WHERE username = '$thisuser';";
                    $result1 = mysqli_query($db, $sql1);
                    while ($row1 = mysqli_fetch_row($result1)) {
                      $acctype = $row1[0];
                      if ($acctype == 'tc'){
                        echo "<h3><a href = 'viewtcmodules.php'>Back</a></h3>";
                      }
                      else if ($acctype == 'tutor'){
                        echo "<a class='btn btn-primary' style='float:right;' style='color:white;' href = 'fileUploadedList.php?mod_id=".$row[0]."'>Module Uploaded Files</a>";

                      }
                      else{
                        echo "<h3><a href = 'viewstudentmodules.php'>Back</a></h3>";
                      }
                    }
                    ?>
                    <br/>
                    <br/>
                  </div>
                </div> <!-- card content -->
              </div> <!-- card -->
            </div> <!-- col-12 -->
          </div> <!-- row -->


          <!-- start of videos part -->



          <?php
          $sql222 = "SELECT * FROM video WHERE mod_id = '$module_id'; ";
          $result222 = mysqli_query($db, $sql222);

          // $row222 = mysqli_fetch_assoc($result222);

          $vidcount = mysqli_num_rows($result222);

          if ($vidcount < 1) {
            echo "no videos available";
          }
          else{

            ?>

            <div class="content-header-left col-md-4 col-12 mb-2">
              <h3 class="content-header-title" style="color: #464855;">Videos</h3>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-content">
                    <div class="card-body">

                      <?php
                      echo "<p>Number of Videos: $vidcount</p>";

                      echo
                      "<div class='table-responsive'>".
                      "<table class='table table-borderless' style='font-size:14px;'>" .
                      "<tr>
                      <thead>
                      <th>ID</th>
                      <th>Filename</th>
                      <th>Subtitles</th>
                      <th>Description</th>
                      <th>Uploaded</th>
                      <th>Action</th>
                      <th></th>
                      </tr>
                      </thead>";


                      while ($row222 = mysqli_fetch_assoc($result222)) {
                        echo
                        "<tr>
                        <th scope='row'>". $row222['id']."</th>
                        <th scope='row'>". $row222['filename']."</th>
                        <th scope='row'>". $row222['subtitles']."</th>
                        <th scope='row'>". $row222['name']."<br/>". $row222['description']."</th>
                        <th scope='row'>". $row222['datetimestamp']."</th>
                        <th scope='row'>
                        <a class='btn btn-sm btn-info' href = 'viewVideo.php?id=".$row222['filename']."&subs=".$row222['subtitles']."'>View</a>
                        </th>
                        <th scope='row'>
                        <a class='btn btn-sm btn-secondary' href = 'deleteVideo.php?id=".$row222['id']."'>Remove</a>
                        </th>
                        </tr>";
                      }
                      echo "</table></div>";

                    }

                    ?>

                  </div>
                </div>
              </div> <!-- end of card -->
            </div> <!-- end of col-12 -->
          </div> <!-- end of row -->




          <!-- end of videos part -->


          <!-- start of ongoing quiz part -->

          <div id="ongoing" class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title" style="color: #464855;">Ongoing quizzes</h3>
          </div>

          <?php
          $sql2 = "SELECT * FROM quiz WHERE moduleid = '$module_id' AND status ='active';";
          $result2 = mysqli_query($db, $sql2);
          if (mysqli_num_rows($result2) == 0) {
            echo "<h6 class='pl-1'>There is no ongoing quizzes for this module.</h6>";
          } else {

            ?>

            <div class="row">
              <?php
              while ($row1 = mysqli_fetch_row($result2)) {

                ?>
                <div class="col-lg-4 col-md-12" style="text-align:center;">
                  <a href = 'viewquiz.php?quizid=<?php echo $row1[0]; ?>'>
                    <div class="card pull-up ecom-card-1 bg-white">
                      <div class="card-header">
                        <h4 class="card-title"><?php echo $row1[1] ?></h4>
                      </div>

                    </div>
                  </a>
                </div>
                <?php
              } //end of while
              ?>
            </div>  <!-- end of class row -->
            <?php
          } // end of else got quizzes
          ?>

          <!-- start of past quiz part -->

          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title" style="color: #464855;">Past quizzes</h3>
          </div>

          <?php
          $sql3 = "SELECT * FROM quiz WHERE moduleid = '$module_id' AND status ='expired';";
          $result3 = mysqli_query($db, $sql3);
          if (mysqli_num_rows($result3) == 0) {
            echo "<h6 class='pl-1'>There is no past quizzes for this module.</h6>";
          } else {

            ?>

            <div class="row">
              <?php
              while ($row3 = mysqli_fetch_row($result3)) {

                ?>
                <div class="col-lg-4 col-md-12" style="text-align:center;">
                  <a href = 'viewquiz.php?quizid=<?php echo $row3[0]; ?>'>
                    <div class="card pull-up ecom-card-1 bg-white">
                      <div class="card-header">
                        <h4 class="card-title"><?php echo $row3[1] ?></h4>
                      </div>

                    </div>
                  </a>
                </div>
                <?php
              } //end of while
              ?>
            </div>  <!-- end of class row -->
            <?php
          } // end of else got quizzes
          ?>

          <div style="text-align:center;">
            <a style="color:white;" class="btn btn-info"
              href = 'createQuiz.php?module_id=<?= $module_id; ?>'>Create quiz</a>
            </div>
            <br/>
            <br/>
            <button class='btn btn-primary'><a style='color:white;' href = 'tutordashboard.php'>Back</a></button>



            <br/><br/>

          </div> <!-- content wrapper -->



        </div> <!-- app content -->


        <?php
      } //end of else
      ?>


      <!-- BEGIN VENDOR JS-->
  <script src="./layout/theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN CHAMELEON  JS-->
  <script src="./layout/theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>
  <script src="./layout/theme-assets/js/core/app-lite.js" type="text/javascript"></script>
  <!-- END CHAMELEON  JS-->
    </body>
    </html>
