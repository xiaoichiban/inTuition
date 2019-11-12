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
          <ul class="nav navbar-nav float-right">

            <?php
            $user_id=$_SESSION['user_id'];
            $username=$_SESSION['username'];
            $login_user=$_SESSION['login_user'];
            $sql = "SELECT * FROM notification WHERE receiver = '$username' AND isRead = '0';";
            $result = mysqli_query($db, $sql);
            if (mysqli_num_rows($result) > 0){
              $sql1 = "SELECT COUNT(*) FROM notification WHERE receiver='$username' and isRead = '0' GROUP BY receiver;";
              $result1 = mysqli_query($db,$sql1);
              $row1 = mysqli_fetch_row($result1);
              echo "<li class='dropdown dropdown-notification nav-item'><a class='nav-link nav-link-label' href='#' data-toggle='dropdown'><i class='la la-bell' style='color:white;'><span class='badge'>$row1[0]</span></i></a>
              <div class='dropdown-menu dropdown-menu-right'>
              <div class='arrow_box_right'>";
              echo "";
              while ($row = mysqli_fetch_row($result)){
                echo "<a class='dropdown-item'>". $row[1] . "</a>";
              }
              echo "<a class='dropdown-item' href='viewnotifications.php'>See all notifications</a>";
            }
            else{
              echo "<li class='dropdown dropdown-notification nav-item'><a class='nav-link nav-link-label' href='#' data-toggle='dropdown'><i class='la la-bell' style='color:white;'></i></a>
              <div class='dropdown-menu dropdown-menu-right'>
              <div class='arrow_box_right'><a class='dropdown-item' href='viewnotifications.php'>See all notifications</a>";
            }
            ?>
          </div>
        </div>
      </li>
    </ul>
  </div>
</div>
</div>
</nav>

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
  <div class="navbar-header">
    <ul class="nav navbar-nav flex-row">
      <li class="nav-item mr-auto"><a class="navbar-brand" href="studentdashboard.php"><img class="brand-logo" alt="Chameleon admin logo" src="./layout/theme-assets/images/logo/intuition_logo.png"/>
        <h3 class="brand-text">inTuition</h3></a></li>
        <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
      </ul>
    </div>
    <div class="main-menu-content menu-accordion ps ps--active-y">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="<?= ($activePage == 'studentdashboard') ? 'active':'nav-item'; ?>"><a href="studentdashboard.php"><i class="ft-home"></i><span class="menu-title" data-i18n="">Home</span></a>
        </li>
        <li class="<?= ($activePage == 'searchmodules') ? 'active':'nav-item'; ?>"><a href="searchmodules.php"><i class="ft-search"></i><span class="menu-title" data-i18n="">Search modules</span></a>
        </li>
        <li class="<?= ($activePage == '../chatwall/chatwall') ? 'active':'nav-item'; ?>"><a href="../chatwall/chatwall.php" target="_blank"><i class="ft-message-circle"></i><span class="menu-title" data-i18n="">Chat</span></a>
        </li>
		
        <li class="nav-item"><a href="webrtc.php"><i class="ft-message-circle"></i>
		<span class="menu-title" data-i18n="">WebRTC</span></a>
        </li>
		
		<li class="nav-item"><a href="../forum/forum.php"><i class="ft-message-circle"></i>
		<span class="menu-title" data-i18n="">Forum</span></a>
        </li>
		
        <li class="<?= ($activePage == 'viewProfile') ? 'active':'nav-item'; ?>"><a href="viewProfile.php?username=<?php echo $username?>"><i class="ft-user"></i><span class="menu-title" data-i18n="">My Profile</span></a>
        </li>
        <li class="<?= ($activePage == 'complain') ? 'active':'nav-item'; ?>"><a href="complain.php"><i class="ft-help-circle"></i><span class="menu-title" data-i18n="">Feedback</span></a>
        </li>
        <li class="<?= ($activePage == 'viewtimetable') ? 'active':'nav-item'; ?>"><a href="viewtimetable.php"><i class="ft-clock"></i><span class="menu-title" data-i18n="">My Timetable</span></a>
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
