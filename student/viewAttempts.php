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
include('../session.php');
include ('./layout/sidebar.php');

$thisuser = $_SESSION['login_user'];
$date = $_GET['date'];

$attemptSql = "SELECT * FROM attempts WHERE student = '$thisuser' and datetimestamp = '$date'; ";
$attemptResult = mysqli_query($db, $attemptSql);
$attemptResult1 = mysqli_query($db, $attemptSql);
$attemptRow = mysqli_fetch_row($attemptResult);

$quizid = $attemptRow[2];

if (mysqli_num_rows($attemptResult) < 1) {
  echo "Invalid attempt on $date";
}
else {
?>

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
      <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
          <h3 class="content-header-title">Attempted details</h3>
        </div>
      </div>

      <div class="content-body">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Attempted on <?= $date; ?></h4>
                <h4 class="card-title">Score: <?= $date; ?></h4>
                <div class="card-content">
                  <div class="card-body">

                  </div>
                </div>
              </div> <!-- end of card-header --> 
            </div> <!-- end of card -->
          </div> <!-- end of col-12 --> 
        </div> <!-- end of row -->

  </div> <!-- end of content wrapper -->
</div> <!-- end of app-content --> 



<?php

  echo "<h3>Attempts details</h3>";
  echo "Attempted on: $date <br>"; 

  $correctAnsSql = "SELECT count(*) FROM attempts WHERE student = '$thisuser' and datetimestamp = '$date' and isCorrect = 1;" ;
  $correctAnsResult = mysqli_query($db, $correctAnsSql);
  $correctAnsRow = mysqli_fetch_row($correctAnsResult);
  $totalCorrectAns = $correctAnsRow[0];

  $totalQnsSql = "SELECT count(*) FROM question WHERE quizid = '$quizid';";
  $totalQnsResult = mysqli_query($db, $totalQnsSql);
  $totalQnsRow = mysqli_fetch_row($totalQnsResult);
  $totalQns = $totalQnsRow[0];

  echo "Score: $totalCorrectAns/$totalQns";

  echo "<div class='container'>"; 
  echo "<h3>Questions </h3>";
  $qnscounter = 0;

  while ($row = mysqli_fetch_row($attemptResult1)) {
    echo "Question " . ++$qnscounter; 
    echo "<br>";

    $qnsSql = "SELECT * FROM question WHERE id = '$row[3]'; ";
    $qnsResult = mysqli_query($db, $qnsSql);
    $qnsRow = mysqli_fetch_row($qnsResult);

    echo $qnsRow[1]; //questiontitle
    echo "<br>";
    ?> 
    <input type="radio" name="qns<?= $row[0]?>ans" value="a" <?php echo ($row[1] == 'a') ?  "checked" : "disabled" ;  ?> /> <?= $qnsRow[2] ?>
    <input type="radio" name="qns<?= $row[0]?>ans" value="b" <?php echo ($row[1] == 'b') ?  "checked" : "disabled" ;  ?> /> <?= $qnsRow[3] ?>
    <input type="radio" name="qns<?= $row[0]?>ans" value="c" <?php echo ($row[1] == 'c') ?  "checked" : "disabled" ;  ?> /> <?= $qnsRow[4] ?>
    <input type="radio" name="qns<?= $row[0]?>ans" value="d" <?php echo ($row[1] == 'd') ?  "checked" : "disabled" ;  ?> /> <?= $qnsRow[5] ?>
    <br>
    <?
    echo "<br>";

    if ($row[1] == $qnsRow[6]) {
      echo "Correct.";
    } else {
      echo "Wrong. The correct answer is: ";
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
      echo $correctAnsStr;
    }

    echo "<br><br>";
  }
  echo "<h3><a href = 'viewquiz.php?quizid=".$quizid."'>Back to quiz</a></h3>";
  
  echo "</div>";
}   //end of else
?>