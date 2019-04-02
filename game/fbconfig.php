<?php
session_start();

require 'app/config.php';
require 'app/DB.php';
require 'app/classes/Usuario.php';
require 'app/includes/utilities.php';
require 'app/vendor/autoload.php';

$currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$currentUrl = "https://www.oabgame.com.br/game/fbconfig.php";

$facebook = new \Facebook\Facebook([
    'app_id' => '604815266237503',
    'app_secret' => 'bf44e169874255d0facd3f48d0cd2981',
    'default_graph_version' => 'v3.2',
]);

$helper = $facebook->getRedirectLoginHelper();

// try {
    $accessToken = $helper->getAccessToken();
// } catch (Facebook\Exceptions\FacebookResponseException $e) {
//     // When Graph returns an error
//     echo 'Graph returned an error: ' . $e->getMessage();
//     exit;
// } catch (Facebook\Exceptions\FacebookSDKException $e) {
//     // When validation fails or other local issues
//     echo 'Facebook SDK returned an error: ' . $e->getMessage();
//     exit;
// }


if (!isset($accessToken)) {
  if ($helper->getError()) {
      header('HTTP/1.0 401 Unauthorized');
      echo "Error: " . $helper->getError() . "\n";
      echo "Error Code: " . $helper->getErrorCode() . "\n";
      echo "Error Reason: " . $helper->getErrorReason() . "\n";
      echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    $permissions = ['email', 'public_profile', 'user_location', 'user_birthday'];

    $loginUrl = $helper->getLoginUrl($currentUrl, $permissions);
    header("Location: " . urldecode($loginUrl));
  }
} else {
  var_dump($accessToken);die();
}
?>
