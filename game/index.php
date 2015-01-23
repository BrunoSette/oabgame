<?php
session_start(); 

if (isset($_SESSION['FBID']) && isset($_SESSION["PREMIUM"])) include_once 'sistema.php';   

else include_once 'login.php';

?>