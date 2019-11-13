<html>
<head>
  <title>View Attempt</title>

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
<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns">

  <?php
  include('session.php');
  include ('./layout/sidebar.php');

$studentName = $_GET['student'];
$date = $_GET['date'];

$attemptSql = "SELECT * FROM attempts WHERE student = '$studentName' and datetimestamp = '$date'; ";
$attemptResult = mysqli_query($db, $attemptSql);
$attemptResult1 = mysqli_query($db, $attemptSql);
$attemptRow = mysqli_fetch_row($attemptResult);

$quizid = $attemptRow[2];

if (mysqli_num_rows($attemptResult) < 1) {
  echo "Invalid attempt on $date";
}
else {

  $correctAnsSql = "SELECT count(*) FROM attempts WHERE student = '$studentName' and datetimestamp = '$date' and isCorrect = 1;" ;
  $correctAnsResult = mysqli_query($db, $correctAnsSql);
  $correctAnsRow = mysqli_fetch_row($correctAnsResult);
  $totalCorrectAns = $correctAnsRow[0];

  $totalQnsSql = "SELECT count(*) FROM question WHERE quizid = '$quizid';";
  $totalQnsResult = mysqli_query($db, $totalQnsSql);
  $totalQnsRow = mysqli_fetch_row($totalQnsResult);
  $totalQns = $totalQnsRow[0];

?>

<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title"><?= $studentName ?>'s attempt</h3>
          </div>
        </div>

        <div class="content-body">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Attempted on <?= $date; ?></h4>
                  <h4 class="card-title">Score: <?= $totalCorrectAns; ?>/<?= $totalQns; ?></h4>
                  <div class="card-content">
                    <div class="card-body pt-0">
                      <?php

  $qnscounter = 0;
  echo "<br>";

  while ($row = mysqli_fetch_row($attemptResult1)) {
    echo "<b>Question " . ++$qnscounter ."</b>";
    echo "<br>";

    $qnsSql = "SELECT * FROM question WHERE id = '$row[3]'; ";
    $qnsResult = mysqli_query($db, $qnsSql);
    $qnsRow = mysqli_fetch_row($qnsResult);

    echo $qnsRow[1]; //questiontitle
    echo "<br>";
    ?>
    <input type="radio" name="qns<?= $row[0]?>ans" value="a" <?php echo ($row[1] == 'a') ?  "checked" : "disabled" ;  ?> /> <?= $qnsRow[2] ?>
    <br>
    <input type="radio" name="qns<?= $row[0]?>ans" value="b" <?php echo ($row[1] == 'b') ?  "checked" : "disabled" ;  ?> /> <?= $qnsRow[3] ?>
    <br>
    <input type="radio" name="qns<?= $row[0]?>ans" value="c" <?php echo ($row[1] == 'c') ?  "checked" : "disabled" ;  ?> /> <?= $qnsRow[4] ?>
    <br>
    <input type="radio" name="qns<?= $row[0]?>ans" value="d" <?php echo ($row[1] == 'd') ?  "checked" : "disabled" ;  ?> /> <?= $qnsRow[5] ?>
    <br>
    <?
    echo "<br>";

    if ($row[1] == $qnsRow[6]) {
      echo "<span style='color: green;'>Correct.</span><br><br>";
    } else {
      echo "<span style='color: red;'>Wrong.</span> &nbsp; The correct answer is: ";
      $correctAnsStr = '';
      if ($qnsRow[6] == 'a') {
        $correctAnsStr = $qnsRow[2];
      } else if ($qnsRow[6] == 'b') {
        $correctAnsStr = $qnsRow[3];
      } else if ($qnsRow[6] == 'c') {
        $correctAnsStr = $qnsRow[4];
      } else if ($qnsRow[6] == 'd') {
        $correctAnsStr = $qnsRow[5];
      }
      echo "<span style='color: red;'>$correctAnsStr</span><br>";
      echo "<br>";
    }

  }
}

                      ?>
                    </div>
                  </div>
                </div> <!-- end of card-header -->
              </div> <!-- end of card -->
            </div> <!-- end of col-12 -->
          </div> <!-- end of row -->

          <a class='btn btn-primary' href = 'viewAllStudentsAttempts.php?quizid=<?=$quizid?>'>Back to all attempts</a>
        </div> <!-- content-body -->

      </div> <!-- content-wrapper -->
    </div> <!--app content -->

<!-- BEGIN VENDOR JS-->
  <script src="./layout/theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN CHAMELEON  JS-->
  <script src="./layout/theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>
  <script src="./layout/theme-assets/js/core/app-lite.js" type="text/javascript"></script>
  <!-- END CHAMELEON  JS-->
</body>
</html>
