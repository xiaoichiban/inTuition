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

<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true" data-img="../theme-assets/images/backgrounds/02.jpg">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">       
          <li class="nav-item mr-auto"><a class="navbar-brand" href="index.html"><img class="brand-logo" alt="Chameleon admin logo" src="./layout/theme-assets/images/logo/intuition_logo.png"/>
              <h3 class="brand-text">inTuition</h3></a></li>
          <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
        </ul>
      </div>
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
          <li class="<?= ($activePage == 'studentdashboard') ? 'active':'nav-item'; ?>"><a href="studentdashboard.php"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
          </li>
          <li class="<?= ($activePage == 'searchmodules') ? 'active':'nav-item'; ?>"><a href="searchmodules.php"><i class="ft-home"></i><span class="menu-title" data-i18n="">Search modules</span></a>
          </li>
          <li class="<?= ($activePage == 'index') ? 'active':'nav-item'; ?>"><a href="viewstudentmodules.php"><i class="ft-pie-chart"></i><span class="menu-title" data-i18n="">My Modules</span></a>
          </li>
          <li class="<?= ($activePage == 'index') ? 'active':'nav-item'; ?>"><a href=""><i class="ft-droplet"></i><span class="menu-title" data-i18n="">Chat</span></a>
          </li>
          <li class="<?= ($activePage == 'index') ? 'active':'nav-item'; ?>"><a href=""><i class="ft-layers"></i><span class="menu-title" data-i18n="">My Profile</span></a>
          </li>
          <li class="<?= ($activePage == 'complain') ? 'active':'nav-item'; ?>"><a href="complain.php"><i class="ft-box"></i><span class="menu-title" data-i18n="">Feedback</span></a>
          </li>
          <li class="<?= ($activePage == 'viewtimetable') ? 'active':'nav-item'; ?>"><a href="viewtimetable.php"><i class="ft-bold"></i><span class="menu-title" data-i18n="">My Timetable</span></a>
          </li>
          <li class="nav-item"><a href="logout.php"><i class="ft-credit-card"></i><span class="menu-title" data-i18n="">Logout</span></a>
          </li>
          <li class="nav-item pl-2">
            <?php
              echo "Logged in As: ";
              $user_id=$_SESSION['user_id'];
              $username=$_SESSION['username'];
              echo "$username<br />";
              $login_user=$_SESSION['login_user'];
              $sql = "SELECT * FROM notification WHERE receiver = '$username' AND isRead = '0';";
              $result = mysqli_query($db, $sql);
              if (mysqli_num_rows($result) > 0){
                $sql1 = "SELECT COUNT(*) FROM notification WHERE receiver='$username' and isRead = '0' GROUP BY receiver;";
                $result1 = mysqli_query($db,$sql1);
                $row1 = mysqli_fetch_row($result1);
                echo "Notifications(".$row1[0].")";
                while ($row = mysqli_fetch_row($result)){
                  echo "<h5>" . $row[1] . "</h5>";
                  $tempstore[] = $row[0];
                }
                foreach ($tempstore as $value) {
                  $sql2 = "UPDATE notification SET isRead = '1' WHERE id = '$value' AND receiver = '$username'";
                  $result2 = mysqli_query($db, $sql2);
                  if (!$result2){
                    echo "unsuccessful";
                  }
                }
              }
              else{
                echo "Notifications";
              }
            ?>

          </li>
        </ul>

      </div>
      <div class="navigation-background"></div>
    </div>


</body>
</html>