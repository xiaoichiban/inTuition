<html>
<head>
  <title>Tutor Dashboard</title>

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
session_start();
include './layout/config.php';
include './layout/sidebar.php';

?>

<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-wrapper-before"></div>
      <div class="content-header">
        <div class="content-header-left col-md-4 col-12 mb-2">
          <h3 class="content-header-title">All My Videos</h3>
        </div>

        <div class="content-body">

		
		
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
		
		
		
		
          <div class="row">
            

              <div class="col-lg-4 col-md-12">
				
				
				<p> <br/> </p>
				
				
				<?php 
					$thistutor = $_SESSION['username'];
					$sqlQuery = "SELECT v.mod_id ,  v.name , v. description , v. filename , v.subtitles , v.datetimestamp
					from video v , module m WHERE v.mod_id = m.id AND m.tutor = '$thistutor';";
					$result = mysqli_query($db, $sqlQuery);
					
					while ($row = mysqli_fetch_assoc($result)) {
						
						$subs = $row['subtitles'];
						$vid  = $row['filename'];
						
						echo "Module ID=".$row['mod_id'] . "<br/>";
						echo "Video Name=".$row['name'] . "<br/>";
						echo "Video Desc=".$row['description'] . "<br/>";
						echo "Filename=".$row['filename'] . "<br/>";
						echo "Subs=".$row['subtitles'] . "<br/>";
						echo "Date Time=".$row['datetimestamp'] . " <br/>";
						echo "<a style='color:red' href='viewVideo.php?id=$vid&subs=$subs'> 
						<b>WATCH VIDEO</b></a> <br/><br/><br/>";
						
						
						
						
					}	
					
				?>
				
				
				
				
				
				
				
				
				
              </div> 
			  
			  <!-- end of the whole module card --> 



          </div> <!-- div row -->
        </div> <!-- content body -->

      </div>
    </div> <!-- content-wrapper --> 
  </div> <!-- app content --> 


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
