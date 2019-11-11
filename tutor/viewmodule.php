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
<body class="vertical-layout vertical-menu 2-columns menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-blue-cyan" data-col="2-columns">

<?php
include('session.php');
$thisuser = $_SESSION['login_user'];
$date = date('Y-m-d');
$module_id = $_GET['module_id'];

include './layout/sidebar.php';

$sql = "SELECT * FROM module WHERE id = '$module_id'; ";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_row($result);
if (mysqli_num_rows($result) != 1) {
  echo "invalid module $module_id";
}
else if ($row[6] == 'inactive'){
  echo "module is no longer active";
}
else {

?>

<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-wrapper-before"></div>
      <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
          <h3 class="content-header-title">Module details</h3>
        </div>
      </div>

      <div class="content-body">

        <div class="row">
          <div class="col-12">
            <div class="card">
                
              <div class="card-content">
                <div class="card-body">
                  <b>Module ID: </b> <?php echo $row[0]; ?>
                    <br>
                    <b>Module name: </b> <?php echo $row[1]; ?>
                    <br>
                    <b>Description: </b> <?php echo $row[2]; ?>
                    <br>
                    <b>Offered by: </b> <?php echo $row[6]; ?>
                    <br>
                    <b>Tutored by: </b> <?php echo $row[7]; ?>
                    <br>
                    <b>No. of students: </b> <?php echo mysqli_fetch_row(mysqli_query($db, "SELECT COUNT(*) FROM enroll where mod_id = '$module_id';"))[0]; ?>
                    <br><br>

                    <?php
                      $sql1 = "SELECT account_type FROM account WHERE username = '$thisuser';";
                      $result1 = mysqli_query($db, $sql1);
                      while ($row1 = mysqli_fetch_row($result1)) {
                        $acctype = $row1[0];
                        if ($acctype == 'tc'){
                          echo "<h3><a href = 'viewtcmodules.php'>Back</a></h3>";
                        }
                        else if ($acctype == 'tutor'){
                          echo "<button class='btn btn-primary'><a style='color:white;' href = 'fileUploadedList.php?mod_id=".$row[0]."'>Module Uploaded Files</a></button>";
                          
                        }
                        else{
                          echo "<h3><a href = 'viewstudentmodules.php'>Back</a></h3>";
                        }
                      }
                    ?>

                </div>
              </div> <!-- card content --> 
            </div> <!-- card --> 
          </div> <!-- col-12 -->
        </div> <!-- row --> 
		
		
		
		
		<!-- start of videos part --> 
		
		
		
<?php
$sql222 = "SELECT * FROM video WHERE mod_id = '$module_id'; ";
$result222 = mysqli_query($db, $sql222);

// $row222 = mysqli_fetch_assoc($result222);

$vidcount = mysqli_num_rows($result222);

if ($vidcount < 1) {
	echo "no videos available";
}
else{
	echo "<p>Number of Videos in this module: $vidcount</p>";
	echo "";
	
	echo 
	"<table class='table' style='width:80%' border='1'>" .
	"<tr>
	<thead class='thead-dark'>
	<th>Action</th>
	<th>id</th>
	<th>mod_id</th>
	<th>filename & subtitles</th>
	<th>name & description</th>
	<th>datetime created</th>
	<th>delete</th>
	</tr>
	</thead>";


	while ($row222 = mysqli_fetch_assoc($result222)) {
		echo 
		"<tr>
		<th scope='row'>
		<font style='color:blue;'>
		<a href = 'viewVideo.php?id=".$row222['filename']."&subs=".$row222['subtitles']."'>
		View </font> </a>
		</th>
		<th scope='row'>". $row222['id']."</th>
		<th scope='row'>". $row222['mod_id']."</th>
		<th scope='row'>". $row222['filename']."<br/>". $row222['subtitles']."</th>
		<th scope='row'>". $row222['name']."<br/>". $row222['description']."</th>
		<th scope='row'>". $row222['datetimestamp']."</th>
		<th scope='row'>
		<font style='color:blue;'>
		<a href = 'deleteVideo.php?id=".$row222['id']."'>
		Delete </font> </a>
		</th>
		</tr>";
	}
	echo "</table>";
	
	
}

?>
		


		
		
		
		<!-- end of videos part --> 
		
		
		


<br/>
<br/>		
		
		
		
		
		
		
		
		
		
		<!-- start of quiz part --> 

        <div class="content-header-left col-md-4 col-12 mb-2">
          <h3 class="content-header-title" style="color: #464855;">Available quizzes</h3>
        </div>

        <?php 
          $sql2 = "SELECT * FROM quiz WHERE moduleid = '$module_id';";
          $result2 = mysqli_query($db, $sql2);
          if (mysqli_num_rows($result2) == 0) {
            echo "<h3 class='pl-1'>There are no quizzes for this module.</h3>";
          } else {
            
      ?>

        <div class="row">
          <?php 
            while ($row1 = mysqli_fetch_row($result2)) {

          ?>
          <div class="col-lg-4 col-md-12">
            <a href = 'viewquiz.php?quizid=<?php echo $row1[0]; ?>'>
              <div class="card pull-up ecom-card-1 bg-white">
                <div class="card-header">
                <h4 class="card-title"><?php echo $row1[1] ?></h4>
              </div>
              
            </div>
          </a>
          </div>
          <?php 
          } //end of while
          ?>
        </div>  <!-- end of class row --> 
        <?php 
        } // end of else got quizzes
        ?>

        <button type="button" class="btn btn-primary"><a style="color:white;" 
		href = 'createQuiz.php?module_id=<?= $module_id; ?>'>Create quiz</a></button>
        <button class='btn btn-default'><a href = 'tutordashboard.php'>Back</a></button>

		
		
		<br/><br/>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
    </div> <!-- content wrapper --> 
	
	
	
  </div> <!-- app content --> 


<?php 
} //end of else 
?>


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


