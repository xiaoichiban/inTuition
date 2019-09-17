<!DOCTYPE html>
<html>
    
<?php 
include('session.php');

include("topheader.php"); 
?>

    <body>


<?php include("topbody.php"); ?>
		
		
		<br/>
       


	   <div class="row">
            <div class="column">
                <h2>My Profile</h2>
                <hr/>
                
				
				<?php

                $thisuser = $_SESSION['login_user'];
                //error_reporting(E_ALL);
                //ini_set('display_errors', '1');

                $sql1 = "SELECT username, name, email, avatar_path FROM account where username = '$thisuser'; ";
                $result1 = mysqli_query($db, $sql1);
                while ($row1 = mysqli_fetch_row($result1)) {

                    $username = $row1[0];
                    $name = $row1[1];
                    $email = $row1[2];
                    echo '<img src = "/pets/img/account/' . $row1[3] . '" style="width:40%;">';
                    echo "<h3>User Name:&nbsp;";
                    echo $username;
                    echo "</h3><h3>Name:&nbsp;";
                    echo $name;
                    echo "</h3><h3>Email:&nbsp;";
                    echo $email;
                    echo "</h3>";
                    echo "<hr/>";
                    echo "<h3><a href = 'editprofile.php' style='font-family:Old Standard;font-size: 18px'>Edit Profile</a></h3>"
                    . "<h3><a href = 'changephoto.php' style='font-family:Old Standard;font-size: 18px'>Change Photo</a></h3>"
                            . "<h3><a href = 'changepassword.php' style='font-family:Old Standard;font-size: 18px'>Change Password</a></h3>";
                }
                ?>
                <hr/>
            </div>
            <div class="columnright">
                <h2>My Reviews</h2>
                <hr/>
			
			
			</div>
        </div>
        <div align='center'><h3><a href = 'taskcreateform.php' style='font-family:Old Standard;font-size: 18px'>Back</a></h3></div>
    </body>
</html>  

