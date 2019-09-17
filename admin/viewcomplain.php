<?php
include('session.php');
$thisuser = $_SESSION['login_user'];

date_default_timezone_set("Singapore");
$date = date('Y-m-d');
$complain_id = $_GET['complain_id'];

$sql = "SELECT * FROM complain WHERE complain_id = '$complain_id'; ";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_row($result);
if (mysqli_num_rows($result) != 1) {
    echo " invalid complain $complain_id";
} 
else {
    if ($row[7] == NULL) 
    {
        echo
        "<table style='width:100%' border='1'>" .
        "<tr><th>title</th><th>" . $row[1] . "</th></tr>" .
        "<tr><th>content</th><th>" . $row[2] . "</th></tr>" .
        "<tr><th>user</th><th>" . $row[3] . "</th></tr>" .
        "<tr><th>status</th><th>" . $row[6] . "</th></tr>" .
        "</table>";
    }
    else
    {
        echo
        "<table style='width:100%' border='1'>" .
        "<tr><th>title</th><th>" . $row[1] . "</th></tr>" .
        "<tr><th>content</th><th>" . $row[2] . "</th></tr>" .
        "<tr><th>user</th><th>" . $row[3] . "</th></tr>" .
        "<tr><th>status</th><th>" . $row[6] . "</th></tr>" .
        "<tr><th>comment</th><th>" . $row[7] . "</th></tr>" .
        "</table>";
    }

    echo "<h3><a href = 'replycomplain.php?complain_id=$complain_id'>Add or Edit Comment</a></h3>";
}
?>
<h3><a href = "searchcomplain.php">Back</a></h3>