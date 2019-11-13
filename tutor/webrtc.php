<?php
session_start();
include './layout/config.php';

?>

<html>
<head>
  <title>Web Chat</title>
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
</head>
<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-blue-cyan" data-col="2-columns">
  <?php
  include './layout/sidebar.php';
  ?>

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-wrapper-before"></div>
      <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
          <h3 class="content-header-title">WebRTC</h3>
        </div>

      </div>

      <div class="content-body">
        <br/>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
			         <div class="card-content">
                  <div class="card-body">
                  <h3 class="card-title">WebRTC services</h3>

                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">

                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Service Name</th>
                        <th scope="col">Description</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Search for active module method-->

                      <tr>
                        <th scope="col">1</th>
                        <th scope="col">
						<a href="https://localhost/pets/webrtc2/" target="_blank"> PHP </a>  </th>
                        <th scope="col">(Local) Basic 1-1</th>
                      </tr>

					  <tr>
                        <th scope="col">2</th>
                        <th scope="col">
						<a href="http://localhost:9988" target="_blank"> PHP ext </a>  </th>
                        <th scope="col">(Local)Based on Workerman</th>
                      </tr>

					  <tr>
                        <th scope="col">3</th>
                        <th scope="col">
						<a href="https://localhost:8443" target="_blank"> Node JS </a>  </th>
                        <th scope="col">(Local)Node JS</th>
                      </tr>

					  <tr>
                        <th scope="col">4</th>
                        <th scope="col">
						<a href="https://appr.tc/r/<?php echo rand(10000,99999999); ?>"
						target="_blank"> APP RTC</a>  </th>
                        <th scope="col">(External) 3rd Party</th>
                      </tr>


                      <?php

                      ?>
                    </tbody>
                  </table>
                </div>
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
  <!-- BEGIN CHAMELEON  JS-->
  <script src="./layout/theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>
  <script src="./layout/theme-assets/js/core/app-lite.js" type="text/javascript"></script>
  <!-- END CHAMELEON  JS-->
</body>
</html>
