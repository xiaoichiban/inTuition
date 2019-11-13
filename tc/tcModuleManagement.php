<?php
include '../config.php';
include '../session.php';
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

<?php
  include './layout/sidebar.php';
?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-wrapper-before"></div>
      <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
          <h3 class="content-header-title">Module Management</h3>
        </div>
      </div>

      <div class="content-body">
        <!-- Module search function -->
        <div class="row pl-1">
          <div class="card" style="background: none;">
            <form action="tcModuleManagement.php" method="GET">
              <input type="text" style="width: 50%; display: inline;" placeholder="Enter Mod Description" name="search"  class="form-control"/>
              <input type="submit" class="btn btn-secondary"  value="Search for module" />
            </form>
          </div>
        </div>

        <div class="row pl-1">
          <div class="card" style="background: none;">
              <button type='button' class='btn btn-dark'><a style='color:white;' href = 'createModule.php'>Create Module</a></button>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">All My Modules</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
              </div>
              <div class="card-content collapse show">
                <div class="card-body">
                  <div class="table-responsive">
            <table class="table" style="font-size:14px;">
              <thead>
                <tr>
                  <th>Module ID</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Time </th>
                  <th>Tuition Centre</th>
                  <th>Tutor</th>
                  <th>Status</th>
                  <th>Details</th>
                  <!-- <th></th> -->
                </tr>
              </thead>
              <tbody>

                <!-- Search for active module method-->
                <?php

                $tc = $_SESSION['login_user'];

                if(isset($_GET['search']) != "") {
                  $search_value = $_GET['search'];

                  $sql="SELECT * from module where tc = '$tc' AND description LIKE '%$search_value%' AND status='active'";
                  // $sql= "SELECT * from module where tc = '$tc'";

                  $result = mysqli_query($db, $sql);

                  while ($row = mysqli_fetch_row($result)) {
                    echo"<tr>";
                    $thisID = $row[0];
                    if ($row[3] == 0){
                      $day_label = "Sun";
                    }
                    elseif ($row[3] == 1) {
                      $day_label = "Mon";
                    }
                    elseif ($row[3] == 2) {
                      $day_label = "Tue";
                    }
                    elseif ($row[3] == 3) {
                      $day_label = "Wed";
                    }
                    elseif ($row[3] == 4) {
                      $day_label = "Thu";
                    }
                    elseif ($row[3] == 5) {
                      $day_label = "Fri";
                    }
                    else{
                      $day_label = "Sat";
                    }
                    echo"<td>"; echo "$row[0]"; echo"</td>";
                    echo"<td>"; echo "$row[1]"; echo"</td>";
                    echo"<td>"; echo "$row[2]"; echo"</td>";
                    echo"<td>"; echo "$day_label" . " " . $row[4] . " - " . $row[5]; echo"</td>";
                    echo"<td>"; echo "$row[6]"; echo"</td>";
                    echo"<td>"; echo "$row[7]"; echo"</td>";
                    echo"<td>"; echo "$row[9]"; echo"</td>";
                    echo"<td>"; echo "<a href='viewmodule.php?module_id=$thisID'> View Module </a>"; echo"</td>";
                    // echo"<td>"; echo "<a href='deleteModuleProcess.php?mod_id=$row[0]'> Delete </a>"; echo"</td>";
                    echo"</tr>";
                  }
                }

                else {
                  $sql= "SELECT * from module where tc = '$tc' AND status='active';";

                  $result = mysqli_query($db, $sql);

                  while ($row = mysqli_fetch_row($result)) {
                    echo"<tr>";
                    $thisID = $row[0];
                    if ($row[3] == 0){
                      $day_label = "Sun";
                    }
                    elseif ($row[3] == 1) {
                      $day_label = "Mon";
                    }
                    elseif ($row[3] == 2) {
                      $day_label = "Tue";
                    }
                    elseif ($row[3] == 3) {
                      $day_label = "Wed";
                    }
                    elseif ($row[3] == 4) {
                      $day_label = "Thu";
                    }
                    elseif ($row[3] == 5) {
                      $day_label = "Fri";
                    }
                    else{
                      $day_label = "Sat";
                    }
                    echo"<td>"; echo "$row[0]"; echo"</td>";
                    echo"<td>"; echo "$row[1]"; echo"</td>";
                    echo"<td>"; echo "$row[2]"; echo"</td>";
                    echo"<td>"; echo "$day_label" . " " . $row[4] . " - " . $row[5]; echo"</td>";
                    echo"<td>"; echo "$row[6]"; echo"</td>";
                    echo"<td>"; echo "$row[7]"; echo"</td>";
                    echo"<td>"; echo "$row[9]"; echo"</td>";
                    echo"<td>"; echo "<a href='viewmodule.php?module_id=$thisID'> View Module </a>"; echo"</td>";
                    // echo"<td>"; echo "<a href='deleteModuleProcess.php?mod_id=$row[0]'> Delete </a>"; echo"</td>";
                    echo"</tr>";
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
                </div>
              </div>
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
