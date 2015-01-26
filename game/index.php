<?php
session_start(); 

$erro_acesso = false;

if (isset($_SESSION['FBID']) && isset($_SESSION["PREMIUM"])) include_once 'sistema.php';   

else
{
	$erro_acesso = true;
	include_once 'login.php';
}

?>