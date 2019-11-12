<?php
include 'config.php';
include 'session.php';
?>



<center>

<table border='2' width='40%'>
<tr> <br/> </tr>
<th> <h3>
ADMINISTRATOR @ INTUITION FORUM
<i class='fas fa-hamburger' style='font-size:20px'></i>
</h3></th>
<tr><td>
<a href="welcome.php"><b><font color='green'> << BACK HOME <<</font> </b></a>
</td></tr>
</table>

</center>






   <body bgcolor = "#FFFFFF">
   
   
   
   <br/>
   <br/>
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Search Users</b></div>
				
            <div style = "margin:30px">
               
               <form action = "searchUsersResults.php" method = "post">
                  <label>Search Users :</label>
				  <input type = "text" name = "search" class = "box"/>
				  <br />
				  <br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
			   <br><br>
			   <small>search * to view all users</small>
			   
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"></div>
					
            </div>
				
         </div>
			
      </div>