<?php
include './layout/config.php';
include './layout/session.php';
?>

<html>
<head>
  <title>My Modules</title>
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
</head>
<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns">
  <?php
  include './layout/sidebar.php';
  ?>

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-wrapper-before"></div>
      <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
          <h3 class="content-header-title">Tutor Management</h3>
        </div>

      </div>

      <div class="content-body">
        <div class="row pl-1">
          <div class="card" style="background: none;">
            <!-- Module search function -->
            <form action="tcTutorManagement.php" method="GET">
              <input type="text" style="width: 50%; display: inline;" name="search" placeholder="Enter tutor username" class="form-control"/>
              <input type="submit" class="btn btn-primary" value="Search for tutor" />
            </form>
          </div>
        </div>

        <div class="row pl-1">
          <div class="card" style="background: none;">
              <a class='btn btn-dark' style='color:white;' href = 'createTutor.php'>Create Tutor</a>
          </div>
        </div>

        <br/>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">All Mcy Tutors</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
              </div>
              <div class="card-content collapse show">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Tutor ID</th>
                        <th scope="col">Tutor Username</th>
                        <th scope="col">Created</th>
                        <th scope="col">Profile</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Search for active module method-->
                      <?php

                      $tc = $_SESSION['login_user'];

                      if(isset($_GET['search']) != "") {
                        $search_value = $_GET['search'];
                        // echo"$search_value";
                        $sql="SELECT * from tutor where tc_owner = '$tc' AND username LIKE '%$search_value%'";

                        $result = mysqli_query($db, $sql);

                        while ($row = mysqli_fetch_row($result)) {
                          $username = $row[1];
                          $sql1 = "SELECT * FROM account WHERE username = '$username' AND status ='active';";
                          $result1 = mysqli_query($db,$sql1);
                          while ($row1 = mysqli_fetch_row($result1)){
                            echo"<tr>";

                            echo"<th scope='row'>"; echo "$row[0]"; echo"</th>";
                            echo"<td>"; echo "$row[1]"; echo"</td>";
                            echo"<td>"; echo "$row1[9]"; echo"</td>";
                            echo"<td>"; echo "<a href='viewProfile.php?username=$username'> View Profile </a>"; echo"</td>";
                            echo"<td>"; echo "<a href='deleteTutorProcess.php?tutor_id=$row[0]'> Delete </a>"; echo"</td>";
                            echo"</tr>";
                          }

                        }
                      }

                      else {
                        $sql="SELECT * from tutor where tc_owner = '$tc'";
                        // echo"ELSE: None";
                        $result = mysqli_query($db, $sql);

                        while ($row = mysqli_fetch_row($result)) {
                          $username = $row[1];
                          $sql1 = "SELECT * FROM account WHERE username = '$username' AND status ='active';";
                          $result1 = mysqli_query($db,$sql1);
                          while ($row1 = mysqli_fetch_row($result1)){
                            echo"<tr>";

                            echo"<th scope='row'>"; echo "$row[0]"; echo"</th>";
                            echo"<td>"; echo "$row[1]"; echo"</td>";
                            echo"<td>"; echo "$row1[9]"; echo"</td>";
                            echo"<td>"; echo "<a href='viewProfile.php?username=$username'> View Profile </a>"; echo"</td>";
                            echo"<td>"; echo "<a href='deleteTutorProcess.php?tutor_id=$row[0]'> Delete </a>"; echo"</td>";
                            echo"</tr>";
                          }

                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <a class='btn btn-primary' href = 'tcdashboard.php'>Back</a>
    </div>
  </div>
</body>
</html>
