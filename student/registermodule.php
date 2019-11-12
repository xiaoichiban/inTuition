<html>
<head>
  <title>Feedback</title>

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
  include './layout/config.php';
  include './layout/sidebar.php';

  ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-wrapper-before"></div>
      <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
          <h3 class="content-header-title">Register</h3>
        </div>

      </div>

      <div class="content-body">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Register for Module <?php $module_name = $_GET['module_name']; echo $module_name;?></h4>
                <div class="card-content">
                  <div class="card-body">
                    <?php
                    $module_name = $_GET['module_name'];

                    $sql2 = "SELECT * FROM module WHERE name = '$module_name'; ";
                    $result2 = mysqli_query($db, $sql2);
                    echo "<table class = 'table table-borderless' style='width:100%'>" .
                    "<thead><tr><th><strong>Tutored by</strong></th>" .
                    "<th><strong>Time</strong></th>" .
                    "<th></th></tr></thead>";
                    while ($row = mysqli_fetch_row($result2)) {
                      if ($row[3] == 0){
                        $day_label = "Sunday";
                      }
                      elseif ($row[3] == 1) {
                        $day_label = "Monday";
                      }
                      elseif ($row[3] == 2) {
                        $day_label = "Tuesday";
                      }
                      elseif ($row[3] == 3) {
                        $day_label = "Wednesday";
                      }
                      elseif ($row[3] == 4) {
                        $day_label = "Thursday";
                      }
                      elseif ($row[3] == 5) {
                        $day_label = "Friday";
                      }
                      else{
                        $day_label = "Saturday";
                      }
                      echo
                      "<tr><th>" . $row[7] . "</th>" .
                      "<th>" . $day_label . " " . $row[4] . " to " . $row[5] . "</th>" .
                      "<th><form action = 'registermoduleprocessing.php?module_id=$row[0]' method = 'post'>
                      <input type = 'submit' class = 'btn btn-primary' value = ' Register '/>
                      </form></th></tr>";
                    }
                    echo "</table>";
                    ?>
                    <hr/>


                    <a class='btn btn-primary' href = 'studentdashboard.php'>Back</a>
                  </div>
                </div>
              </div>
            </div>
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
