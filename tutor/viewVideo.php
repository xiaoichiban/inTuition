<html>
<head>
  <title>Dashboard</title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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

  include './layout/sidebar.php';

  $id = null;
  $subs = "blank.vtt";

  // print_r($_GET);
  if(isset($_GET["id"])) {
    $id = $_GET["id"];
    // echo "$id";

    $sql = "SELECT mod_id FROM video WHERE filename = '$id'; ";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_row($result);
  }


  if(isset($_GET["subs"])) {
    $subs = $_GET["subs"];

    if ($subs==''){
      $subs = "blank.vtt";
    }
    // echo "$subs";
  }
  else{
    $subs = "blank.vtt";
  }


  if($id == null || $id =='' ){
    return;
  }

  $sqlQuery = "SELECT * from video v  WHERE v.filename = '$id';";

	$result = mysqli_query($db, $sqlQuery);
	$row = mysqli_fetch_assoc($result);

  //poster='loads3.gif'
  ?>

  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-wrapper-before"></div>
      <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
          <h3 class="content-header-title">Video</h3>
        </div>
      </div>

      <div class="content-body">
        <div class="row">
          <div class="col-12">
            <div class="card">

              <div class="card-content">
                <div class="card-body">

                  <?php

                  $name = $row['name'];
									$description = $row['description'];

                  echo "
                  <center>
                  <h3><b>Title: $name</b></h3><br/>
									<h5>$description</h5>
                  <video
                  id='myVideo'
                  name='myVideo'
                  controls
                  style='width:640px;height:360px;'
                  >

                  <source src='./video/$id'  />
                  <track src='./video/$subs' label='English subtitles'
                  kind='subtitles' srclang='en' default></track>
                  </video>

                  </center>
                  <br/><br/> ";
                  ?>
                </div>
              </div>
            </div> <!-- end of card -->
          </div> <!-- end of col-12 -->
        </div> <!-- end of row -->
      </div> <!-- end of content body -->

      <button  class='btn btn-primary' onclick='goBack()'>Back</button>
      <script>function goBack() {window.history.back();}</script>

    </div> <!-- content wrapper -->
  </div> <!-- app content -->
<!-- BEGIN VENDOR JS-->
  <script src="./layout/theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN CHAMELEON  JS-->
  <script src="./layout/theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>
  <script src="./layout/theme-assets/js/core/app-lite.js" type="text/javascript"></script>
  <!-- END CHAMELEON  JS-->
</body>
</html>
