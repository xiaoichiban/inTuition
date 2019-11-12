

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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
  // session_start();
  include '../session.php';
  include '../config.php';
  include './layout/sidebar.php';
  ?>

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-wrapper-before"></div>
      <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
          <h3 class="content-header-title">Module Video</h3>
        </div>

      </div>
      <div class="content-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Delete Video</h4>
                <div class="card-content">
                  <div class="card-body">


                    <?php

                    $thisuser = $_SESSION['login_user'];
                    $thisusername = $_SESSION['username'];





                    if (isset($_GET['id'])) {

                      $id = $_GET['id'];



                      // check if exists
                      $sql = "SELECT * FROM video t WHERE t.id = '$id';";
                      $result = $db->query($sql);

                      // if does not exists
                      if ($result->num_rows == 0) {
                        echo "<h3> No Such Video. Nothing to Delete </h3>";
                        return;
                      }



                      // all is good
                      echo"<center><div class='container'>";
                      echo "<h3 style='color:red'>Are you sure you want to delete this video ?</h3><br/>";

                      /*
                      //$sql = "SELECT t.id , t.user_id, t.username,  t.tweetbody, t.category , t.photo , t.timestamp
                      //		FROM tweet t WHERE t.id = '$id' ";
                      //$result = $db->query($sql);
                      */


                      $row = $result->fetch_assoc();


                      echo "<p align='center'> <b>Module ID:</b> "
                      .$row["id"].
                      "<br/> <b>Description:</b> "
                      .$row["description"].
                      "<br/> <b>Name:</b> "
                      .$row["name"].
                      "<br/> <b>Date Uploaded:</b> "
                      .$row["datetimestamp"].
                      " ";






                      echo "
                      <div align='center'>
                      <form action='./deleteVideoProcess.php' method='post'>

                      <a class='btn btn-info' href='videoList.php'>No, Do Not Delete</a>

                      &nbsp;&nbsp;&nbsp;

                      <input type='hidden' id='id' name='id' value='$id'>
                      <button type='submit' name='Delete' value='Delete' class='btn btn-danger' >
                      <i class='fa fa-trash'></i>
                      Confirm Delete
                      </button>
                      </form>
                      </div>
                      ";

                      echo"</div></center>";

                    }


                    else {
                      echo "<h3 align='center'> Nothing to Show </h3>";
                    }

                    ?>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

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
