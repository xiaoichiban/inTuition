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
                <h4 class="card-title">Quiz details</h4>
                <div class="card-content">
                  <div class="card-body">

                      <?php
                        echo
                          "<table style='width:40%; font-size:14px;' class='table table-borderless'>" .
                          "<tr><th>Quiz title</th><th>" . $row[1] . "</th></tr>" .
                          "<tr><th>Number of student attempts</th><th>" . "<a href='viewAllStudentsAttempts.php?quizid=". $quiz_id ."'>". $countAttemptRow ."</a> out of $totalStudents students</th></tr></table>";

                          $qnscounter = 0;
                        } // end of else at the front

                        if (mysqli_num_rows(mysqli_query($db, "SELECT * from question WHERE quizid = '$quiz_id';")) == 0) {
                          echo "<button class='btn btn-primary'><a style='color:white;' href='createQuestion.php?quizid=$quiz_id'>Add questions</a></button>";
                          echo "&nbsp;";
                        } else if (mysqli_num_rows(mysqli_query($db, "SELECT * from attempts WHERE quizid = '$quiz_id';")) > 0) {
                          echo "<button class='btn btn-primary'><a style='color:white;' href='editQuiz.php?quizid=$quiz_id'>Edit quiz</a></button>";
                          echo "&nbsp;";
                        }else {
                          echo "<button class='btn btn-primary'><a style='color:white;' href='editQuiz.php?quizid=$quiz_id'>Edit quiz</a></button>";
                          echo "&nbsp;";
                          echo "<button class='btn btn-primary'><a style='color:white;' href='createQuestion.php?quizid=$quiz_id'>Add questions</a></button>";
                          echo "&nbsp;";
                        }

                        //check quiz's status
                        if ($row[3] == 'active') {
                          echo "<button class='btn btn-secondary'><a style='color:white;' href='setQuizStatus.php?quizid=$quiz_id&status=expired'>Deactivate</a></button>";
                        } else {
                          echo "<button class='btn btn-secondary'><a style='color:white;' href='setQuizStatus.php?quizid=$quiz_id&status=active'>Activate</a></button>";
                        }
                      ?>

                      </div>
                    </div>
                </div>
              </div> <!-- end of card -->
            </div> <!-- end of col-12 -->
          </div> <!-- end of row -->

          <div class="content-header-left col-md-4 col-12 mb-2">
          <h3 class="content-header-title" style="color: #464855;">Overall Performance</h3>
          </div>

          <div class="row">

          <div class="col-lg-3 col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title" style="color: #82B1FF;">Highest Score</h4>
                <div class="card-content"><br>
                  <?php

                  if ($countAttemptRow == 0) {
                    echo "<h4 class='card-title'>No attempts yet.";
                  } else {
                    $highestScore = mysqli_fetch_row(mysqli_query($db, "SELECT count(isCorrect) from attempts where quizid = '$quiz_id' and isCorrect = '1' group by datetimestamp order by count(isCorrect) DESC LIMIT 1;"))[0];
                    $totalQuestions = mysqli_num_rows($countQuestion);

                    if ($highestScore != null) {
                      echo "<h4 class='card-title'>$highestScore/$totalQuestions</h4>";
                    } else {
                      echo "<h4 class='card-title'>0/$totalQuestions</h4>";
                    }
                  }
                  ?>
                </div>
              </div>
            </div> <!-- end of card -->
          </div> <!-- end of col-12 -->


          <div class="col-lg-3 col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title" style="color: #7B1FA2;">Lowest Score</h4>
                <div class="card-content"><br>
                  <?php

                    if ($countAttemptRow == 0) {
                      echo "<h4 class='card-title'>No attempts yet.";
                    } else {
                      $numOfWrong = mysqli_fetch_row(mysqli_query($db, "SELECT count(isCorrect) from attempts where quizid = '$quiz_id' and isCorrect = '0' group by datetimestamp order by count(isCorrect) DESC LIMIT 1;"))[0];


                      if ($numOfWrong != null) {
                        $lowestScore = $totalQuestions - $numOfWrong;
                        echo "<h4 class='card-title'>$lowestScore/$totalQuestions</h4>";
                      } else {
                        echo "<h4 class='card-title'>0/0</h4>";
                      }
                    }
                  ?>
                </div>
              </div>
            </div> <!-- end of card -->
          </div> <!-- end of col-12 -->

          <div class="col-lg-3 col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title" style="color: #EF5350;">Hardest Question</h4>
                <div class="card-content"><br>
                  <?php

                    if ($countAttemptRow == 0) {
                      echo "<h4 class='card-title'>No attempts yet.</h4>";
                    } else if (mysqli_num_rows(mysqli_query($db, "SELECT * from question WHERE quizid = '$quiz_id';")) == 0) {
                      echo "<h4 class='card-title'>No questions yet.</h4>";
                    } else {

                      $hardestQnsId = mysqli_fetch_row(mysqli_query($db, "SELECT questionid, COUNT(*) from attempts where quizid = '$quiz_id' and isCorrect = '0' group by questionid order by count(*) desc LIMIT 1;"))[0];

                      $hardestQnsStr = mysqli_fetch_row(mysqli_query($db, "SELECT questiontitle FROM question WHERE id = '$hardestQnsId';"))[0];
                      echo "<h4 class='card-title'>$hardestQnsStr</h4>";

                      if ($hardestQnsId == null) {
                        echo "<h4 class='card-title'>Everyone got all questions right.</h4>";
                      }
                    }
                  ?>
                </div>
              </div>
            </div> <!-- end of card -->
          </div> <!-- end of col-12 -->

          <div class="col-lg-3 col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title" style="color: #0eaa5e;">Easiest Question</h4>
                <div class="card-content"><br>
                  <?php

                    if ($countAttemptRow == 0) {
                      echo "<h4 class='card-title'>No attempts yet</h4>";
                    } else if (mysqli_num_rows(mysqli_query($db, "SELECT * from question WHERE quizid = '$quiz_id';")) == 0) {
                      echo "<h4 class='card-title'>No questions yet.";
                    } else {
                      $easiestQnsId = mysqli_fetch_row(mysqli_query($db, "SELECT questionid, COUNT(*) from attempts where quizid = '$quiz_id' and isCorrect = '1' group by questionid order by count(*) desc LIMIT 1;"))[0];

                      $easiestQnsStr = mysqli_fetch_row(mysqli_query($db, "SELECT questiontitle FROM question WHERE id = '$easiestQnsId';"))[0];
                      echo "<h4 class='card-title'>$easiestQnsStr</h4>";

                      if ($easiestQnsId == null) {
                        echo "<h4 class='card-title'>Everyone got all questions wrong.</h4>";
                      }
                    }

                  ?>
                </div>
              </div>
            </div> <!-- end of card -->
          </div> <!-- end of col-12 -->

        </div> <!-- end of row -->



        <div class="content-header-left col-md-4 col-12 mb-2">
          <?php
            if ($countAttemptRow == 0) {
              echo "<h3 class='content-header-title' style='color: #464855;'>Questions</h3>";
            } else {
              echo "<h3 class='content-header-title' style='color: #464855;'>Question Statistics</h3>";
            }
          ?>

        </div>

          <div class="row">
            <?php
            if (mysqli_num_rows(mysqli_query($db, "SELECT * from question WHERE quizid = '$quiz_id';")) == 0) {
              echo "<h6 class='card-title pl-2'>There is no questions yet.</h6>";
            } else {
              while ($row2 = mysqli_fetch_row($overviewQuestion)) {

              $totalAttempts = mysqli_fetch_row(mysqli_query($db, "SELECT COUNT(questionid) FROM attempts where quizid = '$quiz_id' and questionid = '$row2[0]';"))[0];

              $correctCount = mysqli_fetch_row(mysqli_query($db, "SELECT count(questionid) from attempts WHERE quizid = '$quiz_id' and questionid= '$row2[0]' and isCorrect = '1'; "))[0];

              $wrongCount = mysqli_fetch_row(mysqli_query($db, "SELECT count(questionid) from attempts WHERE quizid = '$quiz_id' and questionid= '$row2[0]' and isCorrect = '0'; "))[0];

              $countOptionA = mysqli_fetch_row(mysqli_query($db, "SELECT count(*) from attempts where quizid = '$quiz_id' and questionid= '$row2[0]' and attemptedans = 'a'; "))[0];

              $countOptionB = mysqli_fetch_row(mysqli_query($db, "SELECT count(*) from attempts where quizid = '$quiz_id' and questionid= '$row2[0]' and attemptedans = 'b'; "))[0];

              $countOptionC = mysqli_fetch_row(mysqli_query($db, "SELECT count(*) from attempts where quizid = '$quiz_id' and questionid= '$row2[0]' and attemptedans = 'c'; "))[0];

              $countOptionD = mysqli_fetch_row(mysqli_query($db, "SELECT count(*) from attempts where quizid = '$quiz_id' and questionid= '$row2[0]' and attemptedans = 'd'; "))[0];

          ?>
          <div class="col-lg-4 col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Question <?= ++$qnscounter ?></h4>
                <h6 class="pt-1"><?= $row2[1] ?></h6>
                <div class="card-content"><br>
                  <?php
                    if ($countAttemptRow == 0) {
                      echo "<a class='btn btn-secondary' style='color:white; float:right;' href='deleteQuestion.php?id=$row2[0]'>Remove</a>";
                    } else {
                  ?>
                  <table class="table table-borderless" style="font-size:14px;">
                    <tr>
                      <th>Answered correctly</th>
                        <th><?= $correctCount ?> out of <?= $totalAttempts ?></th>
                      </tr>
                      <tr>
                        <th>Answered wrongly</th>
                        <th><?= $wrongCount ?> out of <?= $totalAttempts ?></th>
                      </tr>
                      <tr>
                        <th>Chose A</th>
                        <th><?= $countOptionA ?></th>
                      </tr>
                      <tr>
                        <th>Chose B</th>
                        <th><?= $countOptionB ?></th>
                      </tr>
                      <tr>
                        <th>Chose C</th>
                        <th><?= $countOptionC ?></th>
                      </tr>
                      <tr>
                        <th>Chose D</th>
                        <th><?= $countOptionD ?></th>
                      </tr>

                  </table>
                  <?php
                  }
                  ?>
                </div>
              </div>
            </div> <!-- end of card -->
          </div> <!-- end of col-12 -->
          <?php

            } // end of while
          } //end of if
          ?>
        </div> <!-- end of row -->
        <button class='btn btn-primary'><a style="color:white;" href = 'viewmodule.php?module_id=<?= $row[2] ?>'>Back</a></button>

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
