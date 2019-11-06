<?php
include('session.php');
$username = $_SESSION['login_user'];
$date = date('Y-m-d');
$module_id = $_GET['module_id'];

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
  echo "<h3>Module details</h3>";
  echo
  "<table style='width:100%' border='1'>" .
  "<tr><th>module_id</th><th>" . $row[0] . "</th></tr>" .
  "<tr><th>module_name</th><th>" . $row[1] . "</th></tr>" .
  "<tr><th>description</th><th>" . $row[2] . "</th></tr>" .
  "<tr><th>offered by</th><th>" . $row[3] . "</th></tr>" .
  "<tr><th>tutored by</th><th>" . $row[4] . "</th></tr>" .
  "<tr><th>number of students</th><th>" . mysqli_fetch_row(mysqli_query($db, "SELECT COUNT(*) FROM enroll where mod_id = '$module_id';"))[0] . "</th></tr>" .
  "</table>";

  echo "<h3><a href = 'fileUploadedList.php?mod_id=".$row[0]."'>Module Uploaded Files</a></h3>";

  echo "<h3>Available quizzes</h3>";
  $sql2 = "SELECT * FROM quiz WHERE moduleid = '$module_id';";
    $result2 = mysqli_query($db, $sql2);
    if (mysqli_num_rows($result2) == 0) {
      echo "<h3>There are no quizzes for this module.</h3>";
    } else {

      echo "<table style='width:60%' border='1'>" .
          "<tr><th></th>" .
          "<th>Quiz title</th></tr>" ;

      while ($row1 = mysqli_fetch_row($result2)) {
        
        echo "<tr>
          <th><a href = 'viewquiz.php?quizid=".$row1[0]."'>View</a></th>
          <th>". $row1[1]."</th></tr>";
        } 
    }
    echo "</table>";

echo "<h3><a href = 'viewstudentmodules.php'>Back</a></h3>";

  $sql3 = "SELECT * FROM enroll WHERE mod_id = '$module_id' AND student = '$username'";
  $result3 = mysqli_query($db, $sql3);
  $row3 = mysqli_fetch_row($result3);
  if (mysqli_num_rows($result3) != 1) {
    echo "invalid module $module_id";
  }
  else{
    if ($row3[3] == 'pending'){
      $confirm="return confirm('Are you sure?');";
      echo"<form action = 'deregistermoduleprocessing.php?module_id=$row3[2]' method = 'post' onSubmit='$confirm'>
      <input type = 'submit' value = ' Deregister ' />
      </form>";
    }
  }

}

?>
