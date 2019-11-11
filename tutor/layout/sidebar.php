<html>

<body>
<?php
  $activePage = basename($_SERVER['PHP_SELF'], ".php");
?>

<nav class="header-navbar navbar-expand-md navbar navbar-without-dd-arrow fixed-top">
  <div class="navbar-wrapper">
        <div class="navbar-container content">
          <div class="collapse navbar-collapse show" id="navbar-mobile">
            <ul class="nav navbar-nav mr-auto float-left">
              <li class="nav-item d-block d-md-none"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                <i class="ft-menu"></i></a></li>
              </li>
            </ul>
          </div>
        </div>
      </div>
</nav>

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mr-auto"><a class="navbar-brand" href="tutordashboard.php"><img class="brand-logo" alt="Chameleon admin logo" src="./layout/theme-assets/images/logo/intuition_logo.png"/>
              <h3 class="brand-text">inTuition</h3></a></li>
          <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
      </div>
      <div class="main-menu-content menu-accordion ps ps--active-y">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class="<?= ($activePage == 'tutordashboard') ? 'active':'nav-item'; ?>"><a href="tutordashboard.php"><i class="ft-home"></i><span class="menu-title" data-i18n="">Home</span></a>
          </li>
          <li class="<?= ($activePage == 'uploadVideo') ? 'active':'nav-item'; ?>"><a href="uploadVideo.php"><i class="ft-home"></i><span class="menu-title" data-i18n="">Upload Video</span></a>
          </li>
          <li class="<?= ($activePage == 'videoList') ? 'active':'nav-item'; ?>"><a href="videoList.php"><i class="ft-pie-chart"></i><span class="menu-title" data-i18n="">Video List</span></a>
          </li>
          <li class="<?= ($activePage == 'index') ? 'active':'nav-item'; ?>"><a href=""><i class="ft-droplet"></i><span class="menu-title" data-i18n="">Chat</span></a>
          </li>
          <li class="<?= ($activePage == 'viewProfile') ? 'active':'nav-item'; ?>"><a href="viewProfile.php?username=<?php echo $username?>"><i class="ft-layers"></i><span class="menu-title" data-i18n="">My Profile</span></a>
          </li>
		  
		  <li class="nav-item"><a href="../chatwall/chatwall.php" target="_blank"><i class="ft-message-circle"></i><span class="menu-title" data-i18n="">Chat</span></a>
          </li>
		  <li class="nav-item"><a href="webrtc.php"><i class="ft-message-circle"></i><span class="menu-title" data-i18n="">WebRTC</span></a>
          </li>
		  
          <li class="nav-item"><a href="logout.php"><i class="ft-credit-card"></i><span class="menu-title" data-i18n="">Logout</span></a>
          </li>
          
        </ul>

      </div>
      <div class="navigation-background"></div>
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
