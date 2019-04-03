<?php
    if(!session_id()) {
        session_start();
    }

require 'app/config.php';
require 'app/DB.php';
require 'app/classes/Usuario.php';
require 'app/includes/utilities.php';
require 'app/vendor/autoload.php';

$currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $currentUrl = "https://www.oabgame.com.br/game/fbconfig.php";
$fb = new \Facebook\Facebook([
    'app_id'  => '604815266237503',
    'app_secret' => 'bf44e169874255d0facd3f48d0cd2981',
    'default_graph_version' => 'v3.2',
]);

try {
    $helper = $fb->getRedirectLoginHelper();
    if(isset($_SESSION['fb_access_token'])){
        $accessToken = $_SESSION['fb_access_token'];
    }else{
        $accessToken = $helper->getAccessToken($currentUrl);
    }
} catch (Exception $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
}

    if(isset($accessToken)){
        if(isset($_SESSION['fb_access_token'])){
            $fb->setDefaultAccessToken($_SESSION['fb_access_token']);
        }else{
            // Put short-lived access token in session
            $_SESSION['fb_access_token'] = (string) $accessToken;
            
            // OAuth 2.0 client handler helps to manage access tokens
            $oAuth2Client = $fb->getOAuth2Client();
            
            // Exchanges a short-lived access token for a long-lived one
            $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['fb_access_token']);
            $_SESSION['fb_access_token'] = (string) $longLivedAccessToken;
            
            // Set default access token to be used in script
            $fb->setDefaultAccessToken($_SESSION['fb_access_token']);
        }
        
        // Redirect the user back to the same page if url has "code" parameter in query string
        if(isset($_GET['code'])){
            header("Location: " . $currentUrl);
        }
        
        // Getting user's profile info from Facebook
        try {
            $graphResponse = $fb->get('/me?fields=name,first_name,last_name,email,link,gender,picture,id,birthday, location');
            $user_profile = $graphResponse->getGraphUser();
            
            $fbid = $user_profile->getId();
            $fbuname = '';
            $fbfullname = $user_profile->getName();
            $femail = $user_profile->getEmail();
            $birthday = $user_profile->getBirthday();
            $location = $user_profile->getLocation()->getName();
            $picture =  "https://graph.facebook.com/".$fbid."/picture";
            $gender = $user_profile->getGender();
            
            $usuario = new Usuario();
            
            if (!$usuario->get_face_profile($femail, $birthday, $location, $picture, $gender)){
                if($usuario->post_face_register(array($fbid, $fbuname, $fbfullname, $femail, $birthday, $location, $picture, $gender)))
                {
                    $_SESSION['USERNAME'] = $fbuname;
                    $_SESSION['FULLNAME'] = $fbfullname;
                    $_SESSION['EMAIL'] =  $femail;
                    $_SESSION['BIRTHDAY'] =  $birthday;
                    $_SESSION['LOCATION'] =  $location;
                    $_SESSION['PICTURE'] =  $picture;
                }
            } else {
                
                $friends = $fb->get("/".$fbid."/friends");
                
                $_SESSION['USERNAME'] = $fbuname;
                $_SESSION['FULLNAME'] = $fbfullname;
                $_SESSION['EMAIL'] =  $femail;
                $_SESSION['BIRTHDAY'] =  $birthday;
                $_SESSION['LOCATION'] =  $location;
                $_SESSION['PICTURE'] =  $picture;
                $_SESSION['FRIENDS'] =  $friends;
                
//                if ($usuario->isPremium($femail)) {
//                    $_SESSION['PREMIUM'] = true;
//
//                }
                $_SESSION['MOEDAS'] = $usuario->get_pontuation($femail);
                $_SESSION['PONTUACAO'] = $usuario->get_pontuation_geral($femail);
            }
            header("Location: .");
            
        } catch(Exception $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            session_destroy();
//            header("Location: ./");
            exit;
        }
    } else {
        $permissions = ['email', 'public_profile', 'user_location', 'user_birthday'];
        
        $loginUrl = $helper->getLoginUrl($currentUrl, $permissions);
        header("Location: " . urldecode($loginUrl));
    }
?>
