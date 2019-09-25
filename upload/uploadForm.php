<?PHP
// require_once("./include/membersite_config.php");

// if(!$fgmembersite->CheckLogin()) { $fgmembersite->RedirectToURL("login.php"); exit; }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Untitled Document</title>
<meta charset="utf-8"/>
</head>
<body>
<p></p>
<form action="upload_file.php" method="post" enctype="multipart/form-data"><label for="file">Filename:</label> <input type="file" name="file" id="file" /> <br />Name the Video: <input type="text" name="videoname" /> <br /> <input type="submit" name="submit" value="Submit" />
</form>
</body>
</body>
</html>