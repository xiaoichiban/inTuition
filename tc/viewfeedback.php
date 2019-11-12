<!-- To use this, just provide module id as mod_id in URI parameter -->
<html>
<head>
  <title>View Feedback</title>

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
<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-blue-green" data-col="2-columns">

<?php
include ('./layout/session.php');
include ('./layout/sidebar.php');
?>


<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Feedback Management</h3>
          </div>
        </div>

        <div class="content-body">

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title"></h4>
                  <div class="card-content">
                    <div class="card-body">
                      <?php
                        $username = $_SESSION['username'];
                        $sql2 = "SELECT * FROM complain WHERE receiver = '$username';";
                        $result2 = mysqli_query($db, $sql2);
                        echo
                        "<div class='table-responsive'>" .
                        "<table class='table' style='font-size:14px;'>" .
                        "<thead><tr>
                        <th>Student</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th></th>
                        </tr></thead>";

                        while ($row = mysqli_fetch_assoc($result2)) {
                          echo
                          "<tr>
                          <td>". $row['complainer']."</td>
                          <td>". $row['title']."</td>
                          <td>". $row['datetimestamp']."</td>
                          <td>". $row['status']."</td>
                          <td><a href = 'viewfeedbackdetails.php?feedback_id=".$row['id']."'>View</a></td>
                          </tr>";
                        }
                        echo "</table></div>";

                      ?>
                    </div>
                  </div> <!-- card content -->
                </div> <!-- card header -->
              </div>  <!-- card -->
            </div> <!-- col-12 -->
          </div> <!-- row -->
        </div> <!-- content body -->

        <a class='btn btn-secondary' href = 'tcdashboard.php'>Back</a>

      </div> <!-- content wrapper -->
    </div> <!-- app content -->


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
