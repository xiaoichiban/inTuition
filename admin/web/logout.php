<?php
   session_start();
   
   if(session_destroy() == TRUE) {
      header("Location: ../../login.html");
   }
?>