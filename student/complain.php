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
          <h3 class="content-header-title">Feedback</h3>
        </div>

      </div>

      <div class="content-body">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Feedback Form</h4>
                <div class="card-content">
                  <div class="card-body">
                    <form action="complain.php" method="post" enctype="multipart/form-data">
                        <div class='basic-inputs'>
                            <br/>
                            <fieldset class="form-group">
                                <h5 class="mt-2">Title: &nbsp;</h5>
                                <input type="text" name="title" id="title" class="form-control" id="placeholderInput" placeholder="Enter Title..." required>
                            </fieldset>
                            <fieldset class="form-group">
                                <h5  class="mt-2">Feedback: &nbsp;</h5>
                                <input type="text" name="problem" id="problem" class="form-control" id="placeholderInput" placeholder="Enter Feedback..." required>
                            </fieldset>
                            <fieldset class="form-group">
                              <h5  class="mt-2">Submit to: &nbsp;</h5>
                                <select class="custom-select" name="tc" id="tc" required>
                                    <?php
                                    $username = $_SESSION['login_user'];
                                    $sql = "SELECT * FROM account WHERE username IN (SELECT tc FROM module WHERE id IN (SELECT mod_id FROM enroll WHERE student ='$username'));";
                                    $result = mysqli_query($db, $sql);
                                    $numResults = 0;
                                    if (mysqli_num_rows($result) >0){
                                      $numResults = $numResults + 1;
                                      while ($row = mysqli_fetch_row($result)){
                                        if ($numResults == 1){
                                          echo "<option value ='$row[1]' selected='selected'>$row[1]</option>";
                                        }
                                        else{
                                          echo "<option value ='$row[1]'>$row[1]</option>";
                                        }

                                      }
                                    }

                                    ?>
                                </select>
                            </fieldset>
                            <br/>
                        </div>
                        <div align='center'>
                            <br/>
                            <input type="submit" value="Submit" name="submit" class="btn btn-primary btn-min-width mr-1 mb-1">
                        </div>
                    </form>


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

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username'];
    $title = $_POST['title'];
    $problem = $_POST['problem'];
    $tc = $_POST['tc'];
    $sql = "INSERT INTO complain(title, content, complainer, receiver, status)"
            . "VALUES('$title', '$problem', '$username', '$tc', 'new');";
    $results = mysqli_query($db, $sql);
    if ($results) {
        echo "<script type = 'text/javascript'> alert ('Thank you for your report!!')</script>";
    } else {
        echo "<script type = 'text/javascript'> alert ('Error in Submission!!')</script>";
    }
    echo '<script>window.location.href = "studentdashboard.php";</script>';
    exit();
}
?>
