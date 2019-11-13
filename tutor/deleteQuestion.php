<html>
<head>
  <title>Dashboard</title>

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
$thisusername = $_SESSION['username'];

include './layout/sidebar.php';

if (isset($_GET['id'])) {

  $id = $_GET['id'];

  // check if exists
  $sql = "SELECT * FROM question WHERE id = '$id';";
  $result = $db->query($sql);

  // if does not exists
  if ($result->num_rows == 0) {
    echo "<h3>There is no such question. Nothing to delete.</h3>";
    return;
  }
  // all is good
  ?>

  <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">

        </div>

        <div class="content-body">

          <div class="row">
            <div class="col-12">
              <div class="card">

                <div class="card-content">
                  <div class="card-body">
                    <div class="height-300">
                    <?php
                      echo"<center class='p-5'>";
                      echo "<h3>Are you sure you want to delete this question?</h3>";

                      $row = $result->fetch_assoc();

                      echo "<br><h4 align='center'><i>"
                      .$row["questiontitle"]."</i></h4>";


                      echo "
                        <br>
                        <div align='center'>
                        <form action='./deleteQuestionProcess.php' method='post'>

                        <a class='btn btn-secondary' href='javascript:history.back(1)'>Do Not Delete</a>

                        &nbsp;&nbsp;&nbsp;

                        <input type='hidden' id='id' name='id' value='$id'>
                        <button class='btn btn-danger' type='submit' name='Delete' value='Delete' class='btn btn-danger'>
                        <i class='fa fa-trash'></i>
                        Confirm Delete
                        </button>
                        </form>
                        </div>
                      ";

                      echo"</center>";

                    }

                    else {
                      echo "<h3 align='center'>There is nothing to show.</h3>";
                    }


                  ?>
                </div>
                  </div>
                </div>
              </div> <!-- card -->
            </div> <!-- col-12 -->
          </div> <!-- row -->
        </div> <!-- content body -->


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
