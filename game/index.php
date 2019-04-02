<?php
session_start(); 
require 'app/config.php';
require 'app/DB.php';
require 'app/classes/Usuario.php';
require 'app/includes/utilities.php';
require 'app/vendor/autoload.php';


if(isset($_GET['code'])){
    try {
        $token = str_replace('#_=_', '', $_GET['code']);
        $facebook = new \Facebook\Facebook([
            'app_id' => '604815266237503',
            'app_secret' => 'bf44e169874255d0facd3f48d0cd2981',
            'default_graph_version' => 'v3.2',
        ]);

        $res = $facebook->get('/me', $token);

    var_dump($res);die();

} catch (Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}


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