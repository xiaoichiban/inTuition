<?php

include('session.php');
$thisuser = $_SESSION['login_user'];
date_default_timezone_set("Singapore");
$date = date('Y-m-d');
$complain_id = $_GET['complain_id'];

//$bidresult="";
//$resultstatus="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment = mysqli_escape_string($db, $_POST['comment']);

    $update = "UPDATE complain SET comment='$comment', status='closed' WHERE complain_id = '$complain_id';";

    if (mysqli_query($db, $update)) {
        header("Location: viewcomplain.php?complain_id=$complain_id");
    } else {
        $resultstatus = 'unsuccessful';
    }
}

$sql = "SELECT * FROM complain WHERE complain_id = '$complain_id'; ";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_row($result);
if (mysqli_num_rows($result) != 1) {
    echo " invalid complain $complain_id";
} else {
    $title = $row[1];
    $content = $row[2];
}

if ($row[7] == null) { //no comments
    echo "
	<form action='replycomplain.php?complain_id=$complain_id' method = 'post'>
	<table style='width:100%' border='1'>
	<tr><th>title</th><th>". $title ."</th></tr>
	<tr><th>content</th><th>". $content ."</th></tr>
	<tr><th>comment</th><th><input type = 'text' name = 'comment' id = 'comment'/></th></tr>
	</table>

	<input type = 'submit' value = 'update'/>
</form>$resultstatus";
} else { //show previous comment
    echo "
	<form action='replycomplain.php?complain_id=$complain_id' method = 'post'>
	<table style='width:100%' border='1'>
	<tr><th>title</th><th>". $title ."</th></tr>
	<tr><th>content</th><th>". $content ."</th></tr>
	<tr><th>comment</th><th><input type = 'text' name = 'comment' value='$row[7]' id = 'comment'/></th></tr>
	</table>

	<input type = 'submit' value = 'update'/>
</form>$resultstatus";
}
?>
