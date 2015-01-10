<?php
require 'src/facebook.php'; 
require 'app/config.php';
require 'app/DB.php';
require 'app/classes/Usuario.php';
require 'app/classes/isdk/isdk.php';
require 'app/includes/utilities.php';

$facebook = new Facebook(array(
  'appId'  => '604815266237503',   
  'secret' => 'bf44e169874255d0facd3f48d0cd2981', 
  'cookie' => true,	
));

$user = $facebook->getUser();

if ($user)
{
  try
  {        
    $user_profile = $facebook->api('/me', 'GET');
    $fbid = $user_profile['id'];                 
    $fbuname = $user_profile['username'];  
    $fbfullname = $user_profile['name']; 
    $femail = $user_profile['email'];
    $birthday = $user_profile['birthday'];
    $location = $user_profile['location']['name'];
    $picture =  "http://graph.facebook.com/".$fbid."/picture";
    $gender = $user_profile['gender'];
       
    $usuario = new Usuario();

    if (!$usuario->get_face_profile($femail, $birthday, $location, $picture, $gender))
    {
      if($usuario->post_face_register(array($fbid, $fbuname, $fbfullname, $femail, $birthday, $location, $picture, $gender)))
      {         
        $_SESSION['USERNAME'] = $fbuname;
        $_SESSION['FULLNAME'] = $fbfullname;
        $_SESSION['EMAIL'] =  $femail;   
        $_SESSION['BIRTHDAY'] =  $birthday;
        $_SESSION['LOCATION'] =  $location;
        $_SESSION['PICTURE'] =  $picture;

        $facebook->api("/me/feed", "post", array(
          'message' => "Que tal um jogo grátis de perguntas e respostas para animar sua preparação para a OAB? 
                        Eu já estou jogando, experimente você também!",
          'name' => "Provas da OAB Game",
          'link' => "http://www.estudandoonline.com.br/game",
          'picture' => "http://www.estudandoonline.com.br/game/img/logo-blue.png"
        ));
      }
    }
    else
    { 
      $friends = $facebook->api('/me/friends');
      //$usuario->post_store_friendlist($friends['data']);

      $_SESSION['USERNAME'] = $fbuname;
      $_SESSION['FULLNAME'] = $fbfullname;
      $_SESSION['EMAIL'] =  $femail;   
      $_SESSION['BIRTHDAY'] =  $birthday;
      $_SESSION['LOCATION'] =  $location;
      $_SESSION['PICTURE'] =  $picture;
      $_SESSION['FRIENDS'] =  $friends;

      $_SESSION['MOEDAS'] = $usuario->get_pontuation($femail);
      $_SESSION['PONTUACAO'] = $usuario->get_pontuation_geral($femail);
    }         
  }
  catch (FacebookApiException $e)
  {
   error_log($e);
   $user = null;
  }
}

if ($user)
{
	header("Location: .");
}
else
{
 $loginUrl = $facebook->getLoginUrl(array(
		'scope'		=> 'email, public_profile, user_location, user_birthday', 
		));
 header("Location: ".$loginUrl);
}
?>
