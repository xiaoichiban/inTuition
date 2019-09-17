 
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Change Password</b></div>
				
            <div style = "margin:30px">
               
               <form action = "changePasswordProcess.php" method = "post">
                  
				  
				  <label>Old Password :</label><input type = "password" name = "oldpass" class = "box"   required  /><br /><br />
				  
				  
				  <label>New Password :</label><input type = "password" name = "newpass" class = "box"  required  /><br /><br />
				  
				  
                  <label>Confirm New Password  :</label><input type = "password" name = "confirmnewpass" class = "box" required  /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
				  
				  <br>
				  <br>
				  
				  <a href="welcome.php"> CANCEL </a>
				  
				  
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"></div>
					
            </div>
				
         </div>
			
      </div>