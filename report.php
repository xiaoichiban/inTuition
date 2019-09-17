<!DOCTYPE html>
<html>



	    
<?php 
include'session.php';
include("topheader.php");
?>


<body>
<?php 
include("topbody.php");
?>

		
<br/>
        
		
		
		<br/>
		
		
        <div align='center'>
        <form action="report.php" method="post">
                
				<br/>
				<fieldset>
                <h3 align='center'>Title: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="title" id="title" autofocus required></h3>
                <h3 align='center'>Problem: &nbsp;<input type="textfield" name="problem" id="problem" required></h3>
				
				
				
                <input type="submit" value="Submit" name="submit" style='font-family:Old Standard;font-size: 18px'>
				</fieldset>
				
            </div>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_SESSION['login_user'];
            $title = $_POST['title'];
            $problem = $_POST['problem'];
            $date = date("Y-m-d");
            $time = date("h:i:sa");
            $sql = "INSERT INTO complain(title, content, complainer_name, complain_date, complain_time, status)"
                    . "VALUES('$title', '$problem', '$username', '$date', '$time', 'open');";
            $results = mysqli_query($db, $sql);
            if ($results) {
                echo "<script type = 'text/javascript'> alert ('Thank you for your report!!')</script>";
            } else {
                echo "<script type = 'text/javascript'> alert ('Error in Submission! Please try again!')</script>";
            }
            echo '<script>window.location.href = "welcome.php";</script>';
            exit();
        }
        ?>
        <div align='center'><h3><a href = 'welcome.php' style='font-family:Old Standard;font-size: 18px'>Back</a></h3></div>
    </body>
</html>

