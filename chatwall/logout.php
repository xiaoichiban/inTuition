<?php

//logout.php
//session_start();

include('session.php');

session_destroy();
header('location:../login.php');

?>