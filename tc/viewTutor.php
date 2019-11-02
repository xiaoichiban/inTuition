<?php
include('../session.php');
$thisuser = $_SESSION['login_user'];
$date = date('Y-m-d');
$tutor_id = $_GET['tutor_id'];

$sql = "SELECT * FROM tutor WHERE id = '$tutor_id'; ";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_row($result);
if (mysqli_num_rows($result) != 1) {
  echo "invalid tutor $tutor_id";
}
else {
  echo
  "<table style='width:100%' border='1'>" .
  "<tr><th>Tutor ID</th><th>" . $row[0] . "</th></tr>" .
  "<tr><th>Username</th><th>" . $row[1] . "</th></tr>" .
  "<tr><th>TC Owner</th><th>" . $row[2] . "</th></tr>" .
  "<tr><th>Number of Modules Taught</th><th>" . mysqli_fetch_row(mysqli_query($db, "SELECT COUNT(*) FROM module, tutor where module.tutor = tutor.username AND tutor.id = '$tutor_id';"))[0] . "</th></tr>" .
  "</table><br>";
}
?>

<form method="post" action="deleteTutorProcess.php">
    <input type="hidden" name="tutor_id" value="<?php echo $tutor_id; ?>">
    <input type="submit" onclick="return confirm('Are you sure to delete Tutor <?php echo $tutor_id?>?')" name="submit" value="Delete Tutor">
</form>

<?php
    echo "<h3><a href = 'tcTutorManagement.php'>Back</a></h3>";
?>
