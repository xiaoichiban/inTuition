<!-- To use this, just provide module id as mod_id in URI parameter -->

<?php
include('config.php');

$mod_id = $_GET['mod_id'];


$sql2 = "SELECT * FROM file WHERE mod_id = $mod_id";
$result2 = mysqli_query($db, $sql2);
echo
"<table style='width:100%' border='1'>" .
"<tr>
<th>File ID</th>
<th>Module ID</th>
<th>File Name</th>
<th>Description</th>
<th>Date</th>
<th></th>
</tr>";


while ($row = mysqli_fetch_assoc($result2)) {
  echo
  "<tr>
  <th>". $row['id']."</th>
  <th>". $row['mod_id']."</th>
  <th>". $row['filename']."</th>
  <th>". $row['name']."<br/>". $row['description']."</th>
  <th>". $row['datetimestamp']."</th>
  <th><a href = 'downloadFileProcess.php?filename=".$row['filename']."'>Download</a></th>
  </tr>";
}
echo "</table><br/><br/>";

?>

<?php
  echo "<h3><a href = 'viewmodule.php?module_id=".$mod_id."'>Back</a></h3>";
?>
