<?php
session_start();

require 'app/config.php';
require 'app/DB.php';
require 'app/classes/Usuario.php';
require 'app/includes/utilities.php';
require 'app/vendor/autoload.php';

$currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// $currentUrl = str_replace('fbconfig', 'fb-callback', $currentUrl);

$facebook = new \Facebook\Facebook([
    'app_id' => '604815266237503',
    'app_secret' => 'bf44e169874255d0facd3f48d0cd2981',
    'default_graph_version' => 'v2.10',
]);

$helper = $facebook->getRedirectLoginHelper();

$permissions = ['email', 'public_profile', 'user_location', 'user_birthday'];

$loginUrl = $helper->getLoginUrl($currentUrl, $permissions);
// var_dump(htmlspecialchars($loginUrl));die();
header("Location: " . urlencode($loginUrl));
?>
