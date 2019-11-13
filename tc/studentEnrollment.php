<html>
<head>
  <title>Enrollment</title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" href="./layout/theme-assets/images/ico/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="../lightbulb.ico">
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
  include('../session.php');
  include './layout/sidebar.php';

  $tc = $_SESSION['login_user'];
  ?>

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-wrapper-before"></div>
      <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
          <h3 class="content-header-title">Student Enrollments</h3>
        </div>

      </div>

      <div class="content-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Pending Enrollment</h4>
                <div class="card-content">
                  <div class="card-body">

                    <?php
                    $sql = "SELECT * FROM enroll WHERE status ='pending' ORDER BY mod_id, student;";
                    $result = mysqli_query($db, $sql);
                    if (mysqli_num_rows($result) < 1) {
                      echo "No Outstanding Student Enrollment";
                    }
                    else {
                      echo "
                      <div class='table-responsive'>
                      <table class='table' style='font-size:14px;'>
                      <tr>
                      <th>Module</th>
                      <th>Class</th>
                      <th>Student</th>
                      <th>Status</th>
                      <th></th>
                      <tr/>";
                      while ($row = mysqli_fetch_row($result)) {
                        $sql1 = "SELECT * FROM module WHERE id ='$row[2]';";
                        $result1 = mysqli_query($db, $sql1);
                        $row1 = mysqli_fetch_row($result1);
                        echo
                        "<form method='post' action='registerStudentProcess.php'>
                        <tr><th>" . $row1[1] . "</th>" .
                        "<th>" . $row1[5] . " - " . $row1[4] . "</th>" .
                        "<th>" . $row[1] . "</th>" .
                        "<th style='color:orange;'>" . $row[3] . "</th>" .
                        "<th><input type='hidden' name='mod_id' value='$row[2]'><input type='hidden' name='username' value='$row[1]'>
                        <input type='submit'class='btn btn-dark' onclick='return confirm('Accept student $row[1] to Module $row[2]?')' name='submit' value='Accept'></th></tr>
                        </form>";

                        // echo $row[2] . " and " . $row[1];
                      }
                      echo "</table></div>";
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <a class='btn btn-secondary' href = 'tcdashboard.php'>Back</a>
    </div>
  </div>

  <!-- BEGIN VENDOR JS-->
  <script src="./layout/theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN CHAMELEON  JS-->
  <script src="./layout/theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>
  <script src="./layout/theme-assets/js/core/app-lite.js" type="text/javascript"></script>
  <!-- END CHAMELEON  JS-->

</body>
</html>
