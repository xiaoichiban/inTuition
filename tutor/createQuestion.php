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
  include './layout/sidebar.php';
  $thisuser = $_SESSION['login_user'];
  $quiz_id = $_GET['quizid'];

  $sql = "SELECT * FROM quiz WHERE id = '$quiz_id'; ";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_row($result);
  if (mysqli_num_rows($result) != 1) {
    echo "invalid quiz $quiz_id";
  }
  else {

    ?>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-12 mb-2">
            <h3 style="font-weight: 700; color: white;">Add questions for <?= $row[1] ?></h3>
          </div>
        </div>

        <div class="content-body">
          <div class="row">
            <div class="col-12">
              <div class="card">

                <div class="card-content">
                  <div class="card-body">

                    <form action="createQuestionProcess.php" method="post">
                      <h6>Question title</h6>
                      <input type="text" class="form-control" style="width: 40%;" name="questiontitle" size="48">
                      <br><br>
                      <h6>Options</h6>
                      <input type="text" class="form-control" style="width: 40%; display:inline;" placeholder="Option a" name="optiona" size="48">
                      <br><br>
                      <input type="text" class="form-control" style="width: 40%; display:inline;" placeholder="Option b" name="optionb" size="48">
                      <br><br>
                      <input type="text" class="form-control" style="width: 40%; display:inline;" placeholder="Option c" name="optionc" size="48">
                      <br><br>
                      <input type="text" class="form-control" style="width: 40%; display:inline;" placeholder="Option d" name="optiond" size="48">
                      <br><br>
                      <input type="text" class="form-control" style="width: 40%; display:inline;" placeholder="Correct Answer" name="correctans" size="48">
                      <br><br>
                      <input type="hidden" name="quizid" value="<?= $quiz_id ?>" size="48">
                      <input type="submit" class="btn btn-primary" value="Create"/>
                    </form>

                  </div>
                </div>
              </div> <!-- end of card -->
            </div> <!-- end of col-12 -->
          </div> <!-- end of row -->
        </div> <!-- end of content body -->

        <?php

        $sql1 = "SELECT account_type FROM account WHERE username = '$thisuser';";
        $result1 = mysqli_query($db, $sql1);
        while ($row1 = mysqli_fetch_row($result1)) {
          $acctype = $row1[0];
          if ($acctype == 'tc'){
            echo "<h3><button class='btn btn-primary'><a style='color:white;' href = 'viewtcmodules.php'>Back</a></button></h3>";
          }
          else if ($acctype == 'tutor'){
            echo "<h3><button class='btn btn-primary'><a style='color:white;' href = 'viewquiz.php?quizid=$quiz_id'>Back</a></button></h3>";
          }
          else{
            echo "<h3><button class='btn btn-primary'><a style='color:white;' href = 'viewstudentmodules.php'>Back</a></button></h3>";
          }
        }

      } // close the else
      ?>

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
