<html>
  <head>
    <title>Dashboard</title>
  </head>
  <body>
  <center>
    <p><a href="searchmodules.php">Search Modules</a></p>
    <p><a href="viewstudentmodules.php">My Modules</a></p>
    <p><a href="">Chat</a></p>
    <p><a href="">My Profile</a></p>
    <p><a href="complain.php">Feedback</a></p>
    <p><a href="viewtimetable.php">My Timetable</a></p>
    <p><a href="logout.php">Logout</a></p>

	<br/>



<?php
session_start();
include 'config.php';
echo "Logged in As:<br/>";
$user_id=$_SESSION['user_id'];
$username=$_SESSION['username'];
echo "$username<br/>";
$login_user=$_SESSION['login_user'];
$sql = "SELECT * FROM notification WHERE receiver = '$username' AND isRead = '0';";
$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) > 0){
  $sql1 = "SELECT COUNT(*) FROM notification WHERE receiver='$username' and isRead = '0' GROUP BY receiver;";
  $result1 = mysqli_query($db,$sql1);
  $row1 = mysqli_fetch_row($result1);
  while ($row = mysqli_fetch_row($result)){
    echo "Notifications(".$row1[0].")";
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




	</center>
  </body>
</html>
