<?php
session_start();
include './layout/sidebar.php';
?>

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

<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-blue-green" data-col="2-columns">

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-wrapper-before"></div>
      <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
          <h3 class="content-header-title">Create A Module</h3>
        </div>
      </div>

      <div class="content-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
    
                <form action="createModuleProcess.php" method="post">
                  <b><h4>Name</h4></b>
                  <br>
                  <input type="text" style="width: 50%; display: inline;" class="form-control" name="name" size="48">
                  <br>
                  <br><br><br>
                  <b><h4>Description</h4></b>
                  <br>
                  <textarea style="width: 50%; display: inline;" class="form-control" placeholder="Short Module Description" rows="4" cols="50" name="description"></textarea>
                  <br>
                  <br><br><br>
                  <b><h4>Class Day</h4></b>
                  <br>
                  <input type="text" style="width: 50%; display: inline;" class="form-control" placeholder="Class Day" name="day" size="48">
                  <br>
                  <br><br><br>
                  <b><h4>Class Start Time</h4></b>
                  <br>
                  <input type="text" style="width: 50%; display: inline;" class="form-control" placeholder="Class start timing" name="start" size="48">
                  <br>
                  <br><br><br>
                  <b><h4>Class End Time</h4></b>
                  <br>
                  <input type="text" style="width: 50%; display: inline;" class="form-control" placeholder="Class end timing" name="end" size="48">
                  <br>
                  <br><br><br>
                  <b><h4>Module Tutor</h4></b>
                  <br>
                  <input type="text" style="width: 50%; display: inline;" class="form-control" placeholder="Tutor name" name="tutor" size="48">
                  <br>
                  <br><br><br>
                  <b><h4>Status</h4></b>
                  <br>
                  <input type="text" style="width: 50%; display: inline;" class="form-control" placeholder="default is active" name="status" size="48">
                  <br><br>
                  <div class="row pl-1">
                    <div class="card" style="background: none;">
                        <input type="submit" class="btn btn-primary" value="Create" />
                    </div>
                  </div>
                </form>

              </div> <!-- card header --> 
            </div> <!-- card --> 
          </div> <!-- col-12 --> 
        </div> <!-- row --> 

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
