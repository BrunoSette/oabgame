<?php
session_start(); 

if (isset($_SESSION['FBID'])){
	if($_SERVER['HTTP_X_FORWARDED_PROTO'] == 'http'){
		 header("Location: https://www.provasdaoab.com.br/aprovagame/game/#_=_");
	}
}


if (isset($_SESSION['FBID'])) include_once 'sistema.php';   

else include_once 'login.php';

?>