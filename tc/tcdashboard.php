<?php
include '../config.php';
include '../session.php';
?>

<html>
  <head>
    <title>Dashboard</title>
  </head>


<body>
  
  
<p><a href="tcTutorManagement.php">My Tutors</a></p>

<p><a href="tcModuleManagement.php">My Modules</a></p>

<p><a href="">Chat (i think no need chat ah >> coz teacher already have chat) </a></p>

<p><a href="">My Profile</a></p>
	

<p>  <a href="logout.php">Logout</a></p>



<?php
session_start();
echo "Logged in As:<br/>";
echo "user_id=".$_SESSION['user_id']."<br/>";
echo "username=".$_SESSION['username']."<br/>";
echo "login_user=".$_SESSION['login_user']."<br/>";
?>  
	
	
	
  </body>
</html>


<!-- List of methods -->
<!--
Adding a module by tc
Remove a module by tc
Register student
Remove student
View students - TC
-->

<!-- Adding a module by tc -->
<?php

  $description = mysqli_real_escape_string($db, $_POST['description']);
  $tc = mysqli_real_escape_string($db, $_POST['tc']);
  $tutor = mysqli_real_escape_string($db, $_POST['tutor']);
  $status = mysqli_real_escape_string($db, $_POST['status']);

  $sql = "INSERT INTO module (description, tc, tutor, datetimestamp, status)
  VALUES ($description, $tc, $tutor, NOW(), $status)";

  if ($db->query($sql) === TRUE) {
      echo $description . " created successfully!";
  } else {
      echo "Error: " . $sql . "<br>" . $db->error;
  }
?>

<!-- Remove a module by tc -->
<?php

  $description = mysqli_real_escape_string($db, $_POST['description']);
  $tc = mysqli_real_escape_string($db, $_POST['tc']);
  $tutor = mysqli_real_escape_string($db, $_POST['tutor']);

  $sql = "DELETE FROM module WHERE description = '$description' AND tc = '$tc' AND tutor = '$tutor'";
  $result = mysqli_query($db,$sql);
  $count = mysqli_num_rows($result);

  if ($count == 1) {
    if ($db->query($sql) === TRUE) {
        echo $description. " has been removed successfully!";
    }
    else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
  }
  else {
   echo "Unable to find the module for deletion";
  }
?>

<!-- Register student -->
<?php

  // $id = mysqli_real_escape_string($db, $_POST['id']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $module_id = mysqli_real_escape_string($db, $_POST['moduleId']);

  $sql = "SELECT * FROM student WHERE username = '$username'";
  $result = mysqli_query($db,$sql);
  $count = mysqli_num_rows($result);

  if($count == 1) {
    $sql = "INSERT INTO enroll (student, mod_id, datetimestamp)
    VALUES ($username, $module_id, NOW())";

    if ($db->query($sql) === TRUE) {
        echo $student . " successfully added to " . $module_id;
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
  }
?>

<!-- Remove student -->
<?php

  $username = mysqli_real_escape_string($db, $_POST['username']);
  $module_id = mysqli_real_escape_string($db, $_POST['moduleId']);

  $sql = "SELECT * FROM student WHERE username = '$username'";
  $result = mysqli_query($db,$sql);
  $count = mysqli_num_rows($result);

  if($count == 1) {
    $sql = "DELETE FROM enroll WHERE student = '$username' AND mod_id = '$module_id'";
    $result = mysqli_query($db,$sql);

    if ($db->query($sql) === TRUE) {
        echo $student . " successfully removed from " . $module_id;
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
  }
?>

<!-- View students -->
<?php

  $tc = mysqli_real_escape_string($db, $_POST['tc']);

  $sql = "SELECT s.id, s.username, e.datetimestamp, m.tutor FROM TC, module m, enroll e, student s WHERE TC.username = m.tc AND m.id = e.mod_id AND e.student = s.username AND TC.username = '$tc'";

  $res=$db->query($sql);
  $result = mysqli_query($db,$sql);
  $count = mysqli_num_rows($result);

  if($count >= 1) {
    while($row=$res->fetch_assoc()){
        echo 'id:  '.$row["s.id"];
        echo 'username:  '.$row["s.username "];
        echo 'tutor:  '.$row["m.tutor"];
        echo 'Registered Date:  '.$row["e.datetimestamp"];
    }
  }
?>
