<?php
include './layout/config.php';
include './layout/session.php';
include './layout/sidebar.php';

$thisuser = $_SESSION['login_user'];
$date = date('Y-m-d');
$module_id = $_GET['module_id'];


?>
<html>
<head>
  <title><?php $sql1 = "SELECT * FROM module WHERE id = '$module_id'; ";  $result1 = mysqli_query($db, $sql1);  $row1 = mysqli_fetch_row($result); echo $row1[1]?></title>
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
  <?php
  include './layout/sidebar.php';
  ?>

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-wrapper-before"></div>
      <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
          <h3 class="content-header-title">Tutor Management</h3>
        </div>

      </div>

      <div class="content-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Module Details</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
              </div>
              <div class="card-content collapse show">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Module ID</th><th scope="col"><?php echo $module_id?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Search for active module method-->
                      <?php

                      $tc = $_SESSION['login_user'];
                      $sql = "SELECT * FROM module WHERE id = '$module_id'; ";
                      $result = mysqli_query($db, $sql);
                      $row = mysqli_fetch_row($result);
                      if (mysqli_num_rows($result) != 1) {
                        echo "invalid module $module_id";
                      }
                      else if ($row[6] == 'inactive'){
                        echo "module is no longer active";
                      }
                      else {
                        echo
                        "<tr><th>module_name</th><th>" . $row[1] . "</th></tr>" .
                        "<tr><th>description</th><th>" . $row[2] . "</th></tr>" .
                        "<tr><th>tutored by</th><th>" . $row[4] . "</th></tr>" .
                        "<tr><th>number of students</th><th>" . mysqli_fetch_row(mysqli_query($db, "SELECT COUNT(*) FROM enroll where mod_id = '$module_id' AND status = 'accepted';"))[0] . "</th></tr>" .
                        "</table>";
                      }

                      $sql = "SELECT * FROM enroll WHERE mod_id = '$module_id' AND status = 'accepted' ORDER BY student";
                      $result = mysqli_query($db, $sql);
                      $row = mysqli_fetch_row($result);

                      echo
                      "<h3 style='padding:15'><b>List of students enrolled<b></h3>
                        <form method='post' action='removeStudentProcess.php'>
                        <table class='table table-striped'>
                          <tr>
                          <th>Student name</th>
                          <th>Date of Enrollment</th>
                          <th></th>
                          <tr/>" .
                        "<tr><th>" . $row[1] . "</th>" .
                        "<th>" . $row[4] . "</th>" .
                        "<th><input type='hidden' name='mod_id' value='$module_id'><input type='hidden' name='username' value='$row[1]'>
                        <input type='submit' class='btn-dark' onclick='return confirm('Remove student $row[1] from Module $module_id?')' name='submit' value='Remove'></th></tr>
                      </table>
                      </form>";
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <a class='btn btn-primary' href = 'tcdashboard.php'>Back</a>
    </div>
  </div>
</body>
</html>
