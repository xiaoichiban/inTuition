<?php
include('config.php');





$sql2 = "SELECT * FROM video";
$result2 = mysqli_query($db, $sql2);
echo 
"<table style='width:100%' border='1'>" .
"<tr>
<th>xxx</th>
<th>xxx</th>
<th>xxx</th>
<th>xxx</th>
<th>xxx</th>
<th>xxx</th>
</tr>";


while ($row = mysqli_fetch_assoc($result2)) {
  echo 
  "<tr>
  <th><a href = 'viewVideo.php?id=".$row['filename']."&subs=".$row['subtitles']."'>View</a></th>
  <th>". $row['id']."</th>
  <th>". $row['mod_id']."</th>
  <th>". $row['filename']."<br/>". $row['subtitles']."</th>
  <th>". $row['name']."<br/>". $row['description']."</th>
  <th>". $row['datetimestamp']."</th>
  </tr>";
}
echo "</table>";







?>
