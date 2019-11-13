<?php
include './layout/config.php';
include './layout/session.php';
include './layout/sidebar.php';

$thisuser = $_SESSION['login_user'];
$date = date('Y-m-d');
$feedback_id = $_GET['feedback_id'];


?>
<html>
<head>
  <title><?php $sql1 = "SELECT * FROM module WHERE id = '$module_id'; ";  $result1 = mysqli_query($db, $sql1);  $row1 = mysqli_fetch_row($result); echo $row1[1]?></title>
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
<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-blue-green" data-col="2-columns">
  <?php
  include './layout/sidebar.php';
  ?>

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-wrapper-before"></div>
      <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
          <h3 class="content-header-title">Feedback Management</h3>
        </div>

      </div>

      <div class="content-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Feedback Details</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" style="font-size:14px;">
                    <thead>
                      <tr>
                        <th scope="col">Feedback ID</th><th scope="col"><?php echo $feedback_id?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Search for active module method-->
                      <?php

                      $tc = $_SESSION['login_user'];
                      $sql = "SELECT * FROM complain WHERE id = '$feedback_id'; ";
                      $result = mysqli_query($db, $sql);
                      $row = mysqli_fetch_row($result);
                      if ($row[7] == null){
                        $comment = "No comment is available";
                      }
                      else{
                        $comment = $row[7];
                      }
                      if (mysqli_num_rows($result) != 1) {
                        echo "invalid module $feedback_id";
                      }

                      else {
                        echo
                        "<tr><th>Title</th><th>" . $row[1] . "</th></tr>" .
                        "<tr><th>Complain</th><th>" . $row[2] . "</th></tr>" .
                        "<tr><th>Submitted by</th><th>" . $row[3] . "</th></tr>" .
                        "<tr><th>Time</th><th>" . $row[5] . "</th></tr>" .
                        "<tr><th>Status</th><th>" . $row[6] . "</th></tr>" .
                        "<tr><th>Comment</th><th>" . $comment . "</th></tr>" .
                        "</table>";
                      }

                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Update Comment</h4>
              </div>
              <div class="card-body">
                <form action="viewfeedbackdetails.php?feedback_id=<?php echo $feedback_id; ?>" method="post" enctype="multipart/form-data">
                  <div class='basic-inputs'>
                    <br/>
                    <fieldset class="form-group" >
                      <textarea name="comment" id="comment" class="form-control" id="placeholderInput" placeholder="Enter Comment..." required></textarea>
                    </fieldset>
                  </div>
                  <div align='center'>
                    <br/>
                    <input type="submit" value="Submit" name="submit" class="btn btn-dark btn-min-width mr-1 mb-1">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <a class='btn btn-secondary' href = 'viewfeedback.php'>Back</a>
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
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_SESSION['username'];
  $comment = $_POST['comment'];
  $feedback_id = $_GET['feedback_id'];
  $sql = "UPDATE complain SET comment ='$comment', status = 'seen' WHERE id = '$feedback_id';";
  $results = mysqli_query($db, $sql);
  echo '<script>window.location.href = "viewfeedback.php";</script>';
  exit();
}
else{
  $username = $_SESSION['username'];
  $feedback_id = $_GET['feedback_id'];
  $sql = "UPDATE complain SET status = 'seen' WHERE id = '$feedback_id';";
  $results = mysqli_query($db, $sql);
}
?>
