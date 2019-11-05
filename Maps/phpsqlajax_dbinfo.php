
<?php

// require("phpsqlajax_dbinfo.php");



// Opens a connection to a MySQL server
// Set the active MySQL database




function parseToXML($htmlStr)
{
	$xmlStr=str_replace('<','&lt;',$htmlStr);
	$xmlStr=str_replace('>','&gt;',$xmlStr);
	$xmlStr=str_replace('"','&quot;',$xmlStr);
	$xmlStr=str_replace("'",'&#39;',$xmlStr);
	$xmlStr=str_replace("&",'&amp;',$xmlStr);
	return $xmlStr;
}


/*
// Opens a connection to a MySQL server
$connection=mysqli_connect ('localhost', "admin", "admin");
if (!$connection) {
  die('Not connected : ' . mysqli_error());
}

$database = "petdb";

// Set the active MySQL database
$db_selected = mysqli_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_error());
}
*/


$link = mysqli_connect("127.0.0.1", "admin", "admin", "petdb");

// Select all the rows in the markers table
$query = "SELECT * FROM markers WHERE 1";
$result = mysqli_query($link , $query);
if (!$result) {
  die('Invalid query: ' . mysqli_error());
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind=0;
// Iterate through the rows, printing XML nodes for each
while ($row = @mysqli_fetch_assoc($result)){
  // Add to XML document node
  echo '<marker ';
  echo 'id="' . $row['id'] . '" ';
  echo 'username="' . parseToXML($row['username']) . '" ';
  echo 'address="' . parseToXML($row['address']) . '" ';
  echo 'lat="' . $row['lat'] . '" ';
  echo 'lng="' . $row['lng'] . '" ';
  echo 'type="' . $row['type'] . '" ';
  echo '/>';
  $ind = $ind + 1;
}

// End XML file
echo '</markers>';



?>