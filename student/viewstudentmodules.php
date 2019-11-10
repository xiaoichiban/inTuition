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
  session_start();
  include './layout/config.php';
  include './layout/sidebar.php';

  ?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-wrapper-before"></div>
      <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
          <h3 class="content-header-title">My Modules</h3>
        </div>

      </div>

      <div class="content-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Enrolled Modules</h4>
                <div class="card-content">
                  <div class="card-body">
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
                        "<th>Module</th>" .
                        "<th>Description</th>" .
                        "<th>Offered by</th>" .
                        "<th>Tutored by</th>" .
                        "<th>Enrolled</th></tr>";
                        while ($row = mysqli_fetch_row($result2)) {
                          $module_details = mysqli_query($db, "SELECT * FROM module m WHERE m.id = '$row[0]'");
                          $module_row = mysqli_fetch_row($module_details);
                          $enroll_details = mysqli_query($db, "SELECT * FROM enroll e WHERE e.mod_id = '$row[0]'");
                          $enroll_row = mysqli_fetch_row($enroll_details);
                          echo "<tr>
                          <th><a href = 'viewmodule.php?module_id=".$row[0]."'>View</a></th>
                          <th>". $row[1]."</th>
                          <th>". $row[2]."</th>
                          <th>". $row[6]."</th>
                          <th>". $row[7]."</th>
                          <th>". $enroll_row[4]."</th></tr>";
                        }
                        echo "</table>";
                      }

                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <a href = 'studentdashboard.php'>Back</a>
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
