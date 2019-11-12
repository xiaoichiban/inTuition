
<?php

include('session.php');

?>

<center>
<table border='2' width='40%'>
<tr> <br/> </tr>

<th> 
<h3>
Create Announcement
<i class='fas fa-hamburger' style='font-size:20px'></i>
</h3>
</th>
<tr><td>
<a href="welcome.php"><b><font color='green'> << BACK HOME <<</font> </b></a>
<br>
</td></tr>
</table>
</center>

<br><br><br>



<div align='center'>
<form action="announceCreateProcess.php" method="post">
<b>Topic</b>
<br>
<input type="text" name="topic" size="48" required>
<br>
<br><br><br>
<b>Body</b>
<br>
<textarea rows="4" cols="50" name="body" required></textarea>
<br>
<input type="submit" value="Create" />
</form>
</div>




