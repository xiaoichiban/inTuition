<html>

<body>
<?php
  $activePage = basename($_SERVER['PHP_SELF'], ".php");
  include('config.php');
  //include('session.php');
  $username = $_SESSION['username'];
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

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true" data-img="../theme-assets/images/backgrounds/02.jpg">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mr-auto"><a class="navbar-brand" href="tcdashboard.php"><img class="brand-logo" alt="Chameleon admin logo" src="./layout/theme-assets/images/logo/intuition_logo.png"/>
              <h3 class="brand-text">inTuition</h3></a></li>
          <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
      </div>
      <div class="main-menu-content">

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class="<?= ($activePage == 'tcdashboard') ? 'active':'nav-item'; ?>"><a href="tcdashboard.php"><i class="ft-home"></i><span class="menu-title" data-i18n="">Home</span></a>
          </li>
          <li class="<?= ($activePage == 'tcTutorManagement') ? 'active':'nav-item'; ?>"><a href="tcTutorManagement.php"><i class="ft-search"></i><span class="menu-title" data-i18n="">My Tutors</span></a>
          </li>
          
		  
		  <li class="<?= ($activePage == 'tcModuleManagement') ? 'active':'nav-item'; ?>"><a href="tcModuleManagement.php"><i class="la la-bars"></i><span class="menu-title" data-i18n="">Module List</span></a>
          </li>
          
		  
		  <li class="<?= ($activePage == 'studentEnrollment') ? 'active':'nav-item'; ?>">
		  <a href="studentEnrollment.php"><i class="ft-book"></i><span class="menu-title" data-i18n="">Enrollment</span></a>
          </li>
          
		  
		  <li class="nav-item"><a href="../chatwall/chatwall.php" target="_blank"><i class="ft-message-circle"></i><span class="menu-title" data-i18n="">Chat</span></a>
          </li>
		  
		  
		  <li class="<?= ($activePage == 'webrtc') ? 'active':'nav-item'; ?>"><a href="webrtc.php"><i class="ft-message-circle">
		  </i><span class="menu-title" data-i18n="">WebRTC</span></a>
          </li>
		  
		  		  
		  		  
		  <li class="nav-item"><a href="../forum/forum.php"><i class="ft-message-circle"></i>
		  <span class="menu-title" data-i18n="">Forum</span></a>
          </li>
		  
		
		  
		  
          <li class="<?= ($activePage == 'viewMyProfile') ? 'active':'nav-item'; ?>"><a href="viewMyProfile.php"><i class="ft-user"></i><span class="menu-title" data-i18n="">My Profile</span></a>
          </li>
          <li class="<?= ($activePage == 'index') ? 'active':'nav-item'; ?>"><a href="viewfeedback.php"><i class="ft-help-circle"></i><span class="menu-title" data-i18n="">Feedback</span></a>
          </li>
          <li class="nav-item"><a href="logout.php"><i class="ft-power"></i><span class="menu-title" data-i18n="">Logout</span></a>
          </li>
          <li class="nav-item pl-2">

          </li>
        </ul>

      </div>
      <div class="navigation-background"></div>
    </div>


</body>
</html>
