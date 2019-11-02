<?php
include('session.php');
$thisuser = $_SESSION['login_user'];
$loginlast = $_SESSION['last_login'];
?>

<!DOCTYPE html>
<html>
    


	    
<?php 
// include("topheader.php"); 
?>


<body>
	
	
<?php 
//include("topbody.php"); 
?>

		
		
		
		
		
        <div class="header">
            <?php
            $username = $_SESSION['login_user'];
            $sql = "SELECT avatar_path FROM account WHERE username = '$username';";
            $result = mysqli_query($db, $sql);
            $row = mysqli_fetch_assoc($result);
            echo '<h1>Welcome, ' . $username . '&nbsp;&nbsp;&nbsp;<img src = "/pets/img/account/' . $row['avatar_path'] . '" style="height:40px;"></h1>';
            ?>
        </div>
        <div class="row">
            <div class="column">
                <img src ="background.jpg">

            </div>
            <div class="column">
                <div class ="imagecontainer">
                <img src ="handshake.png" style="height:175px;">
                </div>
            </div>

            <div class="column">
                <b><p style="text-align:right"> Last Login ::  <?php echo $loginlast; ?>  </p></b>
                <?php
                $query7 = "SELECT datetimestamp, topic, body FROM announcement ORDER BY datetimestamp DESC LIMIT 5;";
                $result7 = mysqli_query($db, $query7);
                echo "<br/><br/>";

                echo"<h3> Announcements</h3>";

                echo"<table style='background-color:#D7DBDD;padding: 15px;'>";

                while ($row = mysqli_fetch_row($result7)) {

                    echo"<tr>";
                    echo"<td>";
                    echo "<b>$row[1]</b>";
                    echo"</td>";
                    echo"<td align='right'>";
                    echo substr($row[0], 0, 19);
                    echo"</td></tr>";
                    echo"<tr><td colspan='2' style='padding-bottom: 15px;'>";
                    echo "$row[2]";
                    echo"</td>";
                    echo"</tr>";
                }
                echo "</table>"
                ?>
            </div>
        </div>
    </body>
</html> 