<?php
include('layout.php');
?>

<body>  




		
					
	
	
	
						
<?php 

  $dba = mysqli_connect("localhost", "admin", "admin", "petdb");
  
  if (!$dba) {
    die("Connection failed: " . mysqli_connect_error());
	}
					
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
  
// Attempt select query execution
$targetUsername = $_SESSION['username'];
$sql = "SELECT * FROM account WHERE username = '$targetUsername' ";
if($result = mysqli_query($dba, $sql)){
    if(mysqli_num_rows($result) > 0){
        
		$row = mysqli_fetch_array($result);
		
		echo"
		<div class='container'>
		<div class='row'>
		<div class='col'><br/></div>
		<div class='col' style='background-color:".$row['color']."'>
		<h3 align='center'><u>My Profile</u></h3><br/><br/>
		<h5>Logged In As <b>$targetUsername</b></h5>
		";
		
		
		echo "<table class='table' style='background-color:gray ; color:white'>";
		echo "<tr><td align='right' > <b>about_me:</b> </td><td>" . $row['about_me'] . "</td> </tr>";
		echo "<tr><td align='right' > <b>email:</b> </td><td>" . $row['email'] . "</td> </tr>";
		echo "<tr><td align='right' > <b>last_seen:</b> </td><td>" . $row['last_seen'] . "</td> </tr>";
		echo "<tr><td align='right' > <b>profilepic:</b> </td><td>" . $row['profilepic'] . "</td> </tr>";
		echo "</table>";
		
		
		
		echo "<div align='center'><b>profilepic:</b> <br/> <img src='./profile/" 
				. $row['profilepic'] . 
				"' width='220px' height='220px' /> ";

		
		
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} 
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($dba);
}
 
// Close connection
mysqli_close($dba);





		echo " <br/> <br/> <br/>";
	
				
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


		//$targetUsername = $_SESSION['username'];

		// Now get the followers 
		$sql_2 = "SELECT follower  FROM followtable WHERE leader = '$targetUsername';";
		$result_2 = $db->query($sql_2);
		
		echo "<p id='rcorners3'> <u>";
		echo $result_2->num_rows;
		echo " follower(s) </u><br/>";
		
		if ($result_2->num_rows > 0) {
		// output data of each row
			while($row = $result_2->fetch_assoc()) {
				$ooo = $row["follower"];
				echo "&nbsp; <a href='./viewUser.php?username=$ooo'>$ooo</a> &nbsp;";
			}
		
		}
		
		echo " </p><br/> ";
				
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		// Now get the following 
		$sql_3 = "SELECT leader  FROM followtable WHERE follower = '$targetUsername';";
		$result_3 = $db->query($sql_3);
		
		echo "<p id='rcorners2'> <u>";
		echo $result_3->num_rows;
		echo " following(s) </u><br/>";
		
		if ($result_3->num_rows > 0) {
		// output data of each row
			while($row = $result_3->fetch_assoc()) {
				$ooo = $row["leader"];
				echo "&nbsp; <a href='./viewUser.php?username=$ooo'>$ooo</a> &nbsp;";
			}
		
		}
		
		echo " </p><br/> ";

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
		// Now get the tweets 
		$sql_4 = "SELECT *  FROM tweet WHERE username = '$targetUsername';";
		$result_4 = $db->query($sql_4);
		
		echo "<p id='rcorners3'> <u>";
		echo $result_4->num_rows;
		echo " tweet(s) </u> <br/>";
		
		
		if ($result_4->num_rows > 0) {
		// output data of each row
			while($row = $result_4->fetch_assoc()) {
				$ooo = $row["id"];
				echo "&nbsp; <a href='./viewTweet.php?tweetID=$ooo'>$ooo</a> &nbsp;";
			}
		
		}
		
		
		
		echo " </p></div> <br/> <br/>  
		<p align='center'><a href='editProfile.php'>Edit My Profile</a>
		<br/><br/>
		<a href='viewUser.php?username=$targetUsername'>Public View of Myself</a></p> 
		</p> 
		<br/><br/>";

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	

?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    </div>
    
	
	
	<div class='col'>
		<br/>
    </div>
	
	
  </div>
</div>



    </body>  