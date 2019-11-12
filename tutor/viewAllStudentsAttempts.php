<html>
<head>
  <title>View quiz</title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="layout/timetablestyle.css">
  <link rel="apple-touch-icon" href="./layout/theme-assets/images/ico/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="./layout/theme-assets/images/ico/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="./layout/theme-assets/css/vendors.css">
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

include './layout/sidebar.php';

//view all students 
$attemptSql = "SELECT DISTINCT(student) FROM attempts WHERE quizid = '$quiz_id'; ";
$attemptResult = mysqli_query($db, $attemptSql);

$sql = "SELECT * FROM quiz WHERE id = '$quiz_id'; ";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_row($result);

$sql1 = "SELECT * FROM question WHERE quizid = '$quiz_id'; ";
$result1 = mysqli_query($db, $sql1);
$quizresult = mysqli_query($db, $sql1);
$questionrow = mysqli_fetch_row($quizresult);


?> 

<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Students' attempts on <?= $row[1] ?></h3>
          </div>
        </div>

        <div class="content-body">

          <div class="row">
            <?php 
            if (mysqli_num_rows($attemptResult) > 0) {
             
              while ($attemptRow = mysqli_fetch_row($attemptResult)) {
                $studentName = $attemptRow[0];

                $sql2 = "SELECT * FROM attempts WHERE student = '$studentName' GROUP BY datetimestamp ORDER BY student ASC; ";
                $result2 = mysqli_query($db, $sql2);
                $numAttempts = mysqli_fetch_row(mysqli_query($db, "SELECT COUNT(quizid) from attempts where student = '$studentName' and quizid = '$quiz_id' and questionid = '$questionrow[0]';"))[0];
              }
            
            ?>
            <div class="col-lg-4 col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Student: <?= $studentName ?></h4>
                  <div class="card-content">
                    <div class="card-body">
                      <?php
                        
                        echo
                          "<table style='width:100%; font-size:14px;' class='table-borderless'>" .
                          "<tr><th>Number of attempts</th><th>" . $numAttempts . "</th></tr>";

                          $attemptCounter = 0; 
                          while ($attemptrow = mysqli_fetch_row($result2)) {

                            $correctAnsSql = "SELECT count(*) FROM attempts WHERE student = '$studentName' and datetimestamp = '$attemptrow[6]' and isCorrect = 1;" ;
                            $correctAnsResult = mysqli_query($db, $correctAnsSql);
                            $correctAnsRow = mysqli_fetch_row($correctAnsResult);
                            $totalCorrectAns = $correctAnsRow[0];

                            $totalQnsSql = "SELECT count(*) FROM question WHERE quizid = '$quiz_id';";
                            $totalQnsResult = mysqli_query($db, $totalQnsSql);
                            $totalQnsRow = mysqli_fetch_row($totalQnsResult);
                            $totalQns = $totalQnsRow[0];

                            echo "<tr><th>Attempt ". ++$attemptCounter ." </th><th>Score: <a href='viewattempts.php?date=". $attemptrow[6] ."&student=". $studentName ." '>" . $totalCorrectAns . "/" . $totalQns . "</a></th></tr>";
                          }

                          echo "</table>";
                        
                        ?>
                    </div>
                  </div>
                </div> <!-- card header --> 
              </div> <!-- card --> 
            </div> <!-- col-12 --> 
           <?php 
              } else {
                echo "<div class='col-12'>";
                echo "<div class='card'>";
                echo "<div class='card-body'>";
                echo "<h4 class='card-title'>No students attempted this quiz yet.</h4>";                      
                echo "</div></div></div>";
              } //end of if 
            ?>

          </div> <!--row --> 

        </div> <!-- content body --> 

<?php

echo "<h3><a class='btn btn-primary' href = 'viewQuiz.php?quizid=".$quiz_id."'>Back to quiz</a></h3>";

?>

  </div> <!-- end of content-wrapper -->
</div> <!-- end of app-content -->



</body>
</html>