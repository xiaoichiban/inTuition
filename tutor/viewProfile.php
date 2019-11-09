<?php

include '../config.php';
include '../session.php';


$username = $_GET['username'];

$sql = "SELECT * FROM account WHERE username = '$username'; ";
$result = mysqli_query($db, $sql);
$account = mysqli_fetch_row($result);
if (mysqli_num_rows($result) != 1) {
  echo "invalid tutor $tutor_id";
}

$sql = "SELECT * FROM tutor WHERE username = '$username'; ";
$result = mysqli_query($db, $sql);
$tutor = mysqli_fetch_row($result);
if (mysqli_num_rows($result) != 1) {
  echo "invalid tutor $tutor_id";
}

?>

<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container emp-profile">
    <div class="row">
      <div class="col-md-4">
        <div class="profile-img">
          <img src="../profilepics/<?php echo $account[7] ?>" alt="Profile picture"/>
            <!-- <a href="editProfilePicture.php">Change Photo</a> -->
          <div class="file btn btn-lg btn-primary">
            <button onclick="location.href = 'editProfilePicture.php';">Change Photo</button>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="profile-head">
          <h5>
            <?php echo $account[1] ?>
          </h5>
          <h6>
            Tutor
          </h6>
          <p class="proile-rating">RANKINGS : <span>8/10</span></p>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">My Experience</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-2">
        <input type="submit" class="profile-edit-btn" name="btnAddMore" onclick="location.href = 'editProfile.php?username=$username';" value="Edit Profile"/>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="profile-work">
          <p>WORK LINK</p>
          <a href="">Website Link</a><br/>
          <a href="">Bootsnipp Profile</a><br/>
          <a href="">Bootply Profile</a>
          <p>SKILLS</p>
          <a>Mathematics (Primary School)</a><br/>
          <a>Mathematics (Secondery School)</a><br/>
        </div>
      </div>
      <div class="col-md-8">
        <div class="tab-content profile-tab" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
              <div class="col-md-6">
                <label>Name</label>
              </div>
              <div class="col-md-6">
                <p><?php echo $account[3] ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Email</label>
              </div>
              <div class="col-md-6">
                <p><?php echo $account[6] ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Tuition Centre</label>
              </div>
              <div class="col-md-6">
                <p><?php echo $tutor[2] ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Date Registered</label>
              </div>
              <div class="col-md-6">
                <p><?php echo $account[9] ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Status</label>
              </div>
              <div class="col-md-6">
                <p><?php echo $account[10] ?></p>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
              <div class="col-md-6">
                <label>Experience</label>
              </div>
              <div class="col-md-6">
                <p>Expert</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Hourly Rate</label>
              </div>
              <div class="col-md-6">
                <p>$70/hr</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Total Modules Taught</label>
              </div>
              <div class="col-md-6">
                <p>8</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>English Level</label>
              </div>
              <div class="col-md-6">
                <p>Expert</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Last Seen Availability</label>
              </div>
              <div class="col-md-6">
                <p><?php echo $account[5] ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label>Your Bio</label><br/>
                <p>"<?php echo $account[4] ?>"</p>
              </div>
            </div>
          </div>
        </div>
        <br/>
        <div style="float:right" class="col-md-4">
          <input type="submit" class="profile-edit-btn" name="btnAddMore" onclick="location.href = 'tutordashboard.php';" value="Back"/>
        </div>
      </div>
    </div>
  </div>
</body>
<style>
body{
  background: -webkit-linear-gradient(left, #3931af, #00c6ff);
}
.emp-profile{
  padding: 3%;
  margin-top: 3%;
  margin-bottom: 3%;
  border-radius: 0.5rem;
  background: #fff;
}
.profile-img{
  text-align: center;
}
.profile-img img{
  width: 70%;
  height: 100%;
}
.profile-img .file {
  position: relative;
  overflow: hidden;
  margin-top: -20%;
  width: 70%;
  border: none;
  border-radius: 0;
  font-size: 15px;
  background: #212529b8;
}
.profile-img .file input {
  position: absolute;
  opacity: 0;
  right: 0;
  top: 0;
}
.profile-head h5{
  color: #333;
}
.profile-head h6{
  color: #0062cc;
}
.profile-edit-btn{
  border: none;
  border-radius: 1.5rem;
  width: 70%;
  padding: 2%;
  font-weight: 600;
  color: #6c757d;
  cursor: pointer;
}
.proile-rating{
  font-size: 12px;
  color: #818182;
  margin-top: 5%;
}
.proile-rating span{
  color: #495057;
  font-size: 15px;
  font-weight: 600;
}
.profile-head .nav-tabs{
  margin-bottom:5%;
}
.profile-head .nav-tabs .nav-link{
  font-weight:600;
  border: none;
}
.profile-head .nav-tabs .nav-link.active{
  border: none;
  border-bottom:2px solid #0062cc;
}
.profile-work{
  padding: 14%;
  margin-top: -15%;
}
.profile-work p{
  font-size: 12px;
  color: #818182;
  font-weight: 600;
  margin-top: 10%;
}
.profile-work a{
  text-decoration: none;
  color: #495057;
  font-weight: 600;
  font-size: 14px;
}
.profile-work ul{
  list-style: none;
}
.profile-tab label{
  font-weight: 600;
}
.profile-tab p{
  font-weight: 600;
  color: #0062cc;
}
</style>