
<?php
include('session.php');
?>


<!DOCTYPE html>


<head>
		<title> 7chan </title>
		<link rel="shortcut icon" type="image/x-icon" href="../lightbulb.ico">
		<meta charset="utf-8">
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  		<script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>



</head>





<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 5px 5px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #4CAF50;
  color: white;
}
</style>



<body>

<div class="topnav">

  <a class="active"  href="myprofile.php">
<text style=" color:white" >
<b> <?php  echo $_SESSION['login_user']; ?>  </b> </text>

<?php
$thisusername = $_SESSION['login_user'];
$SQLstatement = "SELECT profilepic FROM account WHERE username = '$thisusername' LIMIT 1";
$result = $db->query($SQLstatement) or die(mysql_error());
$row = $result->fetch_assoc();
// print_r($row);
$profilepicture = $row["profilepic"];
echo "<img src = './profile/$profilepicture' class='rounded-circle'  height='30px'  width='30px' /> <br/>";
?>
</a>


  <a href="#home"> | about |</a>

</div>






<style>
body {
  font-family: "Lato", sans-serif;
}
.sidenav {
  height: 100%;  width: 0;  position: fixed;  z-index: 1;  top: 0;  left: 0;
  background-color: #111;  overflow-x: hidden;  transition: 0.5s;  padding-top: 60px;
}
.sidenav a {
  padding: 8px 8px 8px 32px;  text-decoration: none;  font-size: 15px;
  color: #818181;  display: block;  transition: 0.3s;
}
.sidenav a:hover {  color: #f1f1f1;}

.sidenav .closebtn {
  position: absolute;  top: 0;  right: 25px;  font-size: 36px;  margin-left: 50px;
}

@media screen and (max-height: 450px) {
.sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 4px 4px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  margin: 4px 2px;
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
  cursor: pointer;
  width: 180px;
}

.button1 {
  background-color: white;
  color: black;
}

.button1:hover {
  background-color: #4CAF50;
  color: white;
  font-weight: bold;
}

.button2 {
  background-color: white;
  color: black;
  border: 2px solid #008CBA;
}

.button2:hover {
  background-color: #008CBA;
  color: white;
  font-weight: bold;
}

.button3 {
  background-color: white;
  color: black;
  border: 2px solid #f44336;
}

.button3:hover {
  background-color: #f44336;
  color: white;
  font-weight: bold;
}

.button4 {
  background-color: white;
  color: black;
  border: 2px solid #e7e7e7;
}

.button4:hover {
	background-color: #e7e7e7;
	font-weight: bold;
}

.button5 {
  background-color: white;
  color: black;
  border: 2px solid #555555;
}

.button5:hover {
  background-color: #555555;
  color: cyan;
	font-weight: bold;
}

.button6 {
  background-color: white;
  color: black;
  border: 2px solid #e7e7e7;
}

.button6:hover {
	background-color: SlateBlue;
	color: white;
	font-weight: bold;
}

.button7 {
  background-color: white;
  color: black;
}

.button7:hover {
	background-color: #3c3c3c;
	color: cyan;
	font-weight: bold;
}

.btnAAA {
  background-color: DodgerBlue;
  border: none;
  color: white;
  padding: 12px 50px;
  font-size: 16px;
  cursor: pointer;
}

/* Darker background on mouse-over */
.btnAAA:hover {
  background-color: RoyalBlue;
}

#rcorners2 {
  border-radius: 25px;
  border: 2px solid #73AD21;
  padding: 20px;
  width: 80%;
}


#rcorners3 {
  border-radius: 25px;
  border: 2px solid darkblue;
  padding: 20px;
  width: 80%;
}

p {
	word-break: break-all;
	font-family: verdana;
}

body {
  background-color: #FED7B0;
}


</style>












<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="index.php"><button class="button button7">  All Tweets  </button>  </a>
  <a href="myFeed.php"><button class="button button1">  My Personal Feed  </button>  </a>
  <a href="searchTweets.php"><button class="button button2">Search Tweets</button> </a>
  <a href="categories.php"><button class="button button2">Tweet Categories</button> </a>
  <a href="createTweet.php"><button class="button button2">Create Tweet </button></a>
  <a href="myTweet.php"><button class="button button5">My Tweets </button></a>
  <a href="myProfile.php"><button class="button button5">My Profile </button></a>
  <a href="editProfile.php"><button class="button button5">Edit Profile </button></a>
  <a href="changePassword.php"><button class="button button5"> Change Password </button></a>
  <a href="chatwall.php"><button class="button button6">Chat Wall</button></a>
  <br/>
  <a href="logout.php"><button class="button button3">Logout </button></a>
</div>






<br/>


<!---<span><text style="color:white;font-weight:bold;font-size:25px;" > &nbsp;&nbsp;&#9776; menu  </text></span><br/>-->
<button class="btnAAA" onclick="openNav()"><i class="fa fa-bars"></i>  Menu</button>


<br/>


<br/>





<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
