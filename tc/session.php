<?php
   include('config.php');
   session_start();
   ob_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select username from account where username = '$user_check' ;");
   

   //$row = mysqli_fetch_assoc($ses_sql);
   
   $row = mysqli_fetch_array($ses_sql);
   
   $login_session = $row['username'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:loginPlease.php");
   }
?>