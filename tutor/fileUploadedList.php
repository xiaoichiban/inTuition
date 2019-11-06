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
  <th><a href = 'deleteFile.php?mod_id=".$row['mod_id']."&filename=".$row['filename']."'>Remove</a></th>
  </tr>";
}
echo "</table><br/><br/>";

?>

<form action="uploadFileProcess.php" method="post" enctype="multipart/form-data">
    File Name:
    <input type="text" name="name"><br/>
    File Description:
    <input type="text" name="description"><br/>
    Select PDF File to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="hidden" name="mod_id" value="<?php $mod_id ?>">
    <input type="submit" value="Upload Image" name="submit">
</form>

<?php
  echo "<h3><a href = 'viewmodule.php?module_id=".$mod_id."'>Back</a></h3>";
?>
