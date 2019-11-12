<?php
   session_start();
   include('config.php');
   
   if( $_SESSION['login_user'] == null || $_SESSION['admin'] == null ){
      header("location:loginAdmin.html");
   }
?>

<script src='https://kit.fontawesome.com/a076d05399.js'></script>