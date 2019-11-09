<?php


   session_start();
   include('config.php');
   
  
   if( $_SESSION['login_user'] == null || $_SESSION['admin'] == null ){
      header("location:loginAdmin.html");
   }
?>