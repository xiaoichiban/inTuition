


<?php


include('session.php');
$thisuser = $_SESSION['login_user'];
$thisusername = $_SESSION['username'];





if (isset($_GET['id'])) { 
  	
	$id = $_GET['id'];
	
	
	
	// check if exists
	$sql = "SELECT * FROM video t WHERE t.id = '$id';";
	$result = $db->query($sql);
	
	// if does not exists
	if ($result->num_rows == 0) {
		echo "<h3> No Such Video. Nothing to Delete </h3>";
		return;
	}
	
	

	// all is good
	echo"<center><div class='container'>";
	echo "<h3 style='color:red'>Are you sure you want to delete this video ?</h3>";

	/*
	//$sql = "SELECT t.id , t.user_id, t.username,  t.tweetbody, t.category , t.photo , t.timestamp 
	//		FROM tweet t WHERE t.id = '$id' ";
	//$result = $db->query($sql);
	*/

	
	$row = $result->fetch_assoc();

	
	echo "<p align='center'>"
	.$row["id"].
	"<br/>"
	.$row["description"].
	"<br/>"
	.$row["name"].
	"<br/>"
	.$row["datetimestamp"].
	" ";


					
					
			
			
	echo "
		<div align='center'>
		<form action='./deleteVideoProcess.php' method='post'>
		
		<a href='videoList.php'>No, Do Not Delete</a> 
		
		&nbsp;&nbsp;&nbsp;
		
		<input type='hidden' id='id' name='id' value='$id'>
		<button type='submit' name='Delete' value='Delete' class='btn btn-danger' >
		<i class='fa fa-trash'></i> 
		Confirm Delete
		</button>
		</form>
		</div>
	";
		
	echo"</div></center>";

}


else {
	echo "<h3 align='center'> Nothing to Show </h3>";
}





?>