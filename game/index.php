<?php
session_start(); 

if (isset($_SESSION['FBID'])){
	var_dump(stripos($_SERVER['SERVER_PROTOCOL'],'https');
	// if(stripos($_SERVER['SERVER_PROTOCOL'],'https') === false){
		 // header("Location: https://www.aprovagame.com.br/game/#_=_");
	}
}


if (isset($_SESSION['FBID'])) include_once 'sistema.php';   

else include_once 'login.php';

?>