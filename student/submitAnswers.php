<html>

<head>
    <title>Answers Submitted</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="layout/timetablestyle.css">
    <link rel="apple-touch-icon" href="./layout/theme-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../lightbulb.ico">
    <link
        href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700"
        rel="stylesheet">
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

<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns">

    <?php

  include './layout/config.php';
  include 'session.php';
  include './layout/sidebar.php';

  $student = $_SESSION['login_user'];
  $quiz_id = $_GET['quizid'];

  $sql1 = "SELECT * FROM question WHERE quizid = '$quiz_id'; ";
  $result1 = mysqli_query($db, $sql1);

  $totalCorrect = 0; 

  while ($row1 = mysqli_fetch_row($result1)) {
    $questionid = $row1[0];
    $attemptedans = mysqli_real_escape_string($db, $_POST['qns' .$questionid. 'ans']); 
    
    if ($attemptedans == $row1[6]) { //if answer is correct 
      $sql = "INSERT INTO attempts (attemptedans, quizid, questionid, student, isCorrect)
      VALUES ('$attemptedans', '$quiz_id', '$questionid', '$student', '1')";

      $result = mysqli_query($db, $sql);

      $totalCorrect++; 
    } else {
      $sql = "INSERT INTO attempts (attemptedans, quizid, questionid, student, isCorrect)
      VALUES ('$attemptedans', '$quiz_id', '$questionid', '$student', '0')";

      $result = mysqli_query($db, $sql);
    }
  
  }

?>

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-4 col-12 mb-2">
                    <h3 class="content-header-title">Answers submitted</h3>
                </div>
            </div>

            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <?php 
                                  if ($result) {
                                    echo "Submitted answers successfully! <br>";
                                    echo $totalCorrect . "/" . mysqli_fetch_row(mysqli_query($db, "SELECT count(*) FROM question WHERE quizid = '$quiz_id';"))[0] . " correct" ;

                                  } else {
                                    echo "Error: " . $sql . "<br>" . $db->error;
                                  } 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type='button' class='btn btn-primary'><a style='color:white;'
                    href='viewquiz.php?quizid=<?= $quiz_id; ?>'>Back to quiz</a></button>

        </div> <!-- content wrapper -->
    </div> <!-- app content -->

<!-- BEGIN VENDOR JS-->
  <script src="./layout/theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN CHAMELEON  JS-->
  <script src="./layout/theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>
  <script src="./layout/theme-assets/js/core/app-lite.js" type="text/javascript"></script>
  <!-- END CHAMELEON  JS-->
</body>

</html>