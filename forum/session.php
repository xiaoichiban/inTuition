<?php
   include('config.php');
   session_start();
   ob_start();
   
   /*
   $user_check = $_SESSION['login_user'];
   $ses_sql = mysqli_query($db,"select username from account where username = '$user_check' ;");

   //$row = mysqli_fetch_assoc($ses_sql);
   $row = mysqli_fetch_array($ses_sql);
   */
   
   $login_session = $_SESSION['username'];
   
   if(!isset($_SESSION['username'])){
      header("location:../login.php");
   }
?>


<link rel="stylesheet" 
href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
crossorigin="anonymous">

<link rel="stylesheet" 
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">