<?php
session_start(); 

if ($_SERVER['HTTPS'] != "on") {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    //header("Location: $url");
    exit;
}

if (isset($_SESSION['FBID'])){
	if($_SERVER['HTTP_X_FORWARDED_PROTO'] == 'http'){
		 header("Location: https://www.oabgame.com.br/game/#_=_");
	}
}

if (isset($_SESSION['FBID'])) include_once 'sistema.php';   

else include_once 'login.php';

?>