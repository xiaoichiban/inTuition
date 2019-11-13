<?php
session_start();
?>

<html>
<head>
  <title>Create Module</title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
          <h3 class="content-header-title">Create A Module</h3>
        </div>
      </div>

      <div class="content-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">

                <form action="createModuleProcess.php" method="post">
                  <b>Name</b>
                  <br>
                  <input type="text" style="width: 50%; display: inline;" class="form-control" placeholder="Module Name" name="name" size="48">
                  <br><br>
                  <b>Description</b>
                  <br>
                  <textarea style="width: 50%; display: inline;" class="form-control" placeholder="Short Module Description" rows="4" cols="50" name="description"></textarea>
                  <br>
                  <br>
                  <b>Class Day</b>
                  <br>

					<select
						style="width: 50%; display: inline;" class="form-control"
						name="day">
            <option value='0'>SUN</option>
					  <option value='1'>MON</option>
					  <option value='2'>TUES</option>
					  <option value='3'>WED</option>
					  <option value='4'>THURS</option>
					  <option value='5'>FRI</option>
            <option value='6'>SAT</option>
					</select>






                  <br>
                  <br>
                  <b>Class Start Time</b>
                  <br>
                  <input type="number" style="width: 50%; display: inline;"
				  class="form-control" placeholder="Class start timing" name="start"
				  min="0800" max="2230">
                  <br>
                  <br>
                  <b>Class End Time</b>
                  <br>
                  <input type="number" style="width: 50%; display: inline;"
				  class="form-control" placeholder="Class end timing" name="end"
				  min="0830" max="2300">
                  <br>
                  <br>


				  <?php


				      $thisTC = $_SESSION['username'];
                      $sqlQuery = "SELECT username from tutor where tc_owner = '$thisTC' ";
                      $result = mysqli_query($db, $sqlQuery);
                      $count = mysqli_num_rows($result);

                      $hidden = '';

                      if ($count < 1){
                        echo "<br/><p> You have no Tutors here;</p>";
                        $hidden = 'hidden';
                      }


                      else {
                        echo "<br/><label for='tutor'><b>Module Tutor</b></label><br/>";
                        echo "<select id='tutor'  required class='form-control'
						style='width: 50%; display: inline;' name='tutor'
						>";

                        while ($row = mysqli_fetch_assoc($result)) {
                          $tutor = $row['username'];
                          echo "<option value='$tutor'>$tutor</option>";
                        }
                        echo "</select>";
                      }






				  ?>




                  <br>
                  <br>

				  <b>Status</b>
                  <br>
                  <input type="text"
					  id="status"
					  name="status"
					  style="width: 50%; display: inline;"
					  class="form-control"
					  value="active"
					  disabled="true">

				  <br><br>


                  <div class="row pl-1">
                    <div class="card" style="background: none;">
                        <input type="submit" class="btn btn-dark" value="Create" />
                    </div>
                  </div>



                </form>





              </div> <!-- card header -->
            </div> <!-- card -->
          </div> <!-- col-12 -->
        </div> <!-- row -->

      </div>
      <a class='btn btn-secondary' href = 'tcModuleManagement.php'>Back to Module List</a>
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
