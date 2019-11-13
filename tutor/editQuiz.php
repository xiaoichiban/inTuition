<html>
<head>
  <title>View quiz</title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
  $quiz_id = $_GET['quizid'];

  include ('./layout/sidebar.php');


  $sql = "SELECT * FROM quiz WHERE id = '$quiz_id'; ";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_row($result);

  $sql1 = "SELECT * FROM question WHERE quizid = '$quiz_id'; ";
  $result1 = mysqli_query($db, $sql1);
  $countQuestion = mysqli_query($db, $sql1);
  $overviewQuestion = mysqli_query($db, $sql1);
  $countQuestionRow = mysqli_fetch_row($countQuestion);

  $countAttemptsSql = "SELECT count(*) FROM attempts WHERE quizid = '$quiz_id' and questionid = '$countQuestionRow[0]' GROUP BY student; ";
  $countAttemptsResult = mysqli_query($db, $countAttemptsSql);
  $countAttemptRow = mysqli_num_rows($countAttemptsResult);

  $totalStudents = mysqli_fetch_row(mysqli_query($db, "SELECT COUNT(*) FROM enroll where mod_id = '$row[2]';"))[0];

  if (mysqli_num_rows($result) != 1) {
    echo "invalid quiz $quiz_id";
  }
  else {
    ?>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title"><?php echo $row[1]; ?></h3>
          </div>
        </div>

        <div class="content-body">


          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Edit quiz</h4>
                  <div class="card-content">
                    <div class="pl-1">
                      <form action="editQuizProcess.php?quizid=<? echo $quiz_id; ?>" method="post">
                        <br />
                        <h6>Quiz title</h6>
                        <input type="text" class="form-control" style="width:50%;" name="quiztitle" size="48" value="<?= $row[1] ?>">
                        <br />

                        <?php

                        $counter = 0;

                        while ($row1 = mysqli_fetch_row($result1)) {

                          echo "<br><h6>Question " . ++$counter . "</h6>";
                          ?>

                          Question title
                          <br>
                          <input type="text" class="form-control" style="width:50%;" name="questiontitle<?= $row1[0] ?>" size="48" value="<?= $row1[1] ?>">
                          <br><br>
                          Option a:
                          <input type="text" class="form-control" style="width:50%;" name="qns<?= $row1[0] ?>a" size="48" value="<?= $row1[2] ?>">
                          <br>
                          Option b:
                          <input type="text" class="form-control" style="width:50%;" name="qns<?= $row1[0] ?>b" size="48" value="<?= $row1[3] ?>">
                          <br>
                          Option c:
                          <input type="text" class="form-control" style="width:50%;" name="qns<?= $row1[0] ?>c" size="48" value="<?= $row1[4] ?>">
                          <br>
                          Option d:
                          <input type="text" class="form-control" style="width:50%;" name="qns<?= $row1[0] ?>d" size="48" value="<?= $row1[5] ?>">
                          <br>
                          Correct answer:
                          <input type="text" class="form-control" style="width:50%;" name="correctans<?= $row1[0] ?>" size="48" value="<?= $row1[6] ?>">
                          <br><br>
                          <input type="hidden" name="quizid" value="<?= $quiz_id ?>" size="48">
                          <input type="hidden" name="questionid" value="<?= $row1[0] ?>" size="48">

                          <?php
                        } //end of while loop
                      } //end of valid quiz
                      ?>

                      <input class="btn btn-primary" type="submit" value="Edit"/>
                    </form>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="pl-1">
            <button class='btn btn-default'><a href = 'viewquiz.php?quizid=<?= $quiz_id ?>'>Back</a></button>
          </div>
        </div>

      </div> <!-- end of content-wrapper -->
    </div> <!-- end of app-content -->


    <!-- BEGIN VENDOR JS-->
  <script src="./layout/theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN CHAMELEON  JS-->
  <script src="./layout/theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>
  <script src="./layout/theme-assets/js/core/app-lite.js" type="text/javascript"></script>
  <!-- END CHAMELEON  JS-->

  </body>
  </html>
