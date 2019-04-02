<?php
session_start(); 
require 'app/config.php';
require 'app/DB.php';
require 'app/classes/Usuario.php';
require 'app/includes/utilities.php';
require 'app/vendor/autoload.php';

$facebook = new \Facebook\Facebook([
    'app_id' => '604815266237503',
    'app_secret' => 'bf44e169874255d0facd3f48d0cd2981',
    'default_graph_version' => 'v3.2',
]);

if(isset($_GET['code'])){
	$facebook->setDefaultAccessToken($_GET['code']);

	$response = $facebook->get('/me');

	var_dump($response);die();
} else {	
    if (isset($_SESSION['FBID'])) include_once 'sistema.php';
    else include_once 'login.php';
}

// if (isset($_SESSION['FBID'])){
// 	if($_SERVER['HTTP_X_FORWARDED_PROTO'] == 'http'){
// 		 header("Location: https://www.oabgame.com.br/game/#_=_");
// 	}
// }


// if (!isset($accessToken)) {
	
// 	if (isset($_SESSION['FBID'])) include_once 'sistema.php';   
	
// 	else include_once 'login.php';
// } else {
// 	var_dump($accessToken);
// 	die('aqui');
// }

?>