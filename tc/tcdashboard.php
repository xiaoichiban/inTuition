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
  session_start();
  include './layout/config.php';
  include './layout/sidebar.php';

  ?>

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-wrapper-before"></div>
      <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
          <h3 class="content-header-title">Dashboard</h3>
        </div>

      </div>

      <div class="content-body">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">My Modules</h4>
                <div class="card-content">
                  <div class="card-body">

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Another card</h4>
                <div class="card-content">
                  <div class="card-body">
                    <div class="height-400">
                      hello!
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>  <!-- end of content-body -->
    </div>  <!-- end of content-wrapper -->
  </div>  <!-- end of app-content content -->







    <section class="buckets">
      <ul>
        <li>
          <div class="bucket">
            <h3 class="bucket-title">Grid is great</h3>
            <p>CSS Grid is a <br/> 2-D layout tool. </p>
          </div><!-- .bucket -->
        </li>
        <li>
          <div class="bucket">
            <h3 class="bucket-title">Grid is great</h3>
            <p>CSS Grid is a <br/> 2-D layout tool. </p>
          </div><!-- .bucket -->
        </li>
      </ul>
    </section><!-- .buckets -->














<section class='splash'>
<div class='splash-content'>
<h2 class='content-title'>Magical content restructuring with CSS Grid stacks</h2>
<div class='splash-text'>


<?php
echo "Logged in As:<br/>";
echo "user_id=".$_SESSION['user_id']."<br/>";
echo "username=".$_SESSION['username']."<br/>";
echo "login_user=".$_SESSION['login_user']."<br/>";
?>


<!-- SideBar + Footers -->

<?php
echo"</div><!-- .splash-text --></div><!-- .splash-content --></section><!-- .splash -->";
include('./layout/layout2.php');

?>
