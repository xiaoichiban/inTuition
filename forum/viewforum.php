<?php
include 'config.php';
include 'session.php';
?>

<head>
	<title>View Forum</title>
	<link rel="shortcut icon" type="image/x-icon" href="../lightbulb.ico">
</head>

<table border='0' width='100%' background="./../background.png" style="color:white;">

	<th>
		<td>
			<br/>
		</td>
	</th>


	<th> <h2>INTUITION FORUM</h2></th>
	<tr>
		<td>

		</td>
	</tr>

	<tr>
		<td>
			<br/>
		</td>
	</tr>


</table>



<br/>

<a width="200px" class="btn btn-dark" href="../router.php">
	<b><font> BACK TO MAIN APP</font> </b></a>
	&nbsp; &nbsp;
	<a width="200px" class="btn btn-success" href="forum.php">
		<b><font color='white'> <i class="fa fa-fighter-jet" aria-hidden="true"></i> Main </font> </b></a>
		&nbsp; &nbsp;
		<a width="200px" class="btn btn-success" href="createNewThread.php">
			<b><font color='white'><i class="fa fa-plus-circle" aria-hidden="true"></i> newThread </font> </b></a>





			<center>



				<br/>


				<?php
				$string = $_SERVER['QUERY_STRING'];
				$token = strtok($string, "=");
				$token = strtok(" ");
				$id =  $token;

				$query = "SELECT creator,datetimestamp,topic,body,status FROM thread WHERE id='$id';" ;
				$result = mysqli_query($db, $query);

				if (mysqli_num_rows($result) < 1){
					echo"<br/><center> No Such Forum , Try Another One</center>";
					return;
				}

				$row = mysqli_fetch_row($result);
				$statusVar = $row[4];

				if ($statusVar != 'ok'){
					echo"<br/><br/><center><h3 style='color:red;'>Oops, looks like the administrator has banned this thread!";
					echo"<br/><br/>You can drop us an email if you think it was unfair</h3></center>";
					return;

				}


				$topix = $row[2];

				echo "<h3><font color='blue'>Topic:: $topix  </font> </h3>";
				echo "<b>$row[3]</b><br/>";
				echo "<br/>";
				echo"<font color='green'>Creator: $row[0] </font> <br/>
				<font color='green'>Date & Time: $row[1]</font>";






				$query2 = "SELECT poster,datetimestamp,body FROM reply WHERE threadid='$id';" ;

				$result2 = mysqli_query($db, $query2);

				if (mysqli_num_rows($result2) < 1){

					echo"<br/><br/><center> (There Are No Replies Yet) <br/> Be the first one to reply !</center>";
				}

				else {
					echo "<br/>";
					echo "<br/>";
					echo "<br/>";
					echo "<div class='col-md-6'>";
					echo"<table class='table' border='1' >
					<tr class='bg-primary' style='color:white;'>
					<th width='70%'>Reply</th>
					<th width='10%'>Responder</th>
					<th width='20%'>Date & Time</th>
					</tr>";

					while ($row2 = mysqli_fetch_row($result2)) {
						echo"<tr>";
						echo"<td>";echo "$row2[2]";echo"</td>";
						echo"<td>";echo "$row2[0]";echo"</td>";
						echo"<td>";echo "$row2[1]";echo"</td>";
						echo"</tr>";
					}
					echo"</table>";
					echo"</div>";
				}





				echo"
				<div class='col-md-6'><br/><br/><h3> REPLY :: </h3>
				<form method='post' action='replyforum.php'>
				<input class='form-control' type='hidden' name='id' value='$id'>
				<textarea class='form-control' name='reply' rows='3' cols='80' required ></textarea>
				<br/>
				<input class='bg-primary' style='color:white;' type='submit' value='Submit reply' /> </form> </div>"


				?>


			</center>


			<br/>
			<br/>
			<br/>
