<?php 
include 'config.php';
include 'session.php';
?>



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




<p id="info-message"> <img src='loads.gif' height='160px' width='160px'> </p>
<script>
  setTimeout(function(){
    document.getElementById('info-message').style.display = 'none';
    /* or
    var item = document.getElementById('info-message')
    item.parentNode.removeChild(item); 
    */
  }, 1500);
</script>





<form action="createNewThreadProcess.php" method="post">
<b>Topic</b>
<br>
<input type="text" name="topic" size="48" required >
<br>
<br><br><br>
<b>Body</b>
<br>
<textarea rows="4" cols="50" name="body" required ></textarea>
<br>
<input type="submit" value="Create" />
</form>

</center>

<br/> <br/>


