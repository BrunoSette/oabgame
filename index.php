<?php
session_start(); 

if (isset($_SESSION['FBID']))
{
    include_once 'sistema.php';   
} else { 
    include_once 'login.php';
} 
?>