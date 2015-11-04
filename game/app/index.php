<?php
session_start();

require 'config.php';
require 'DB.php';

require 'Slim/Slim.php';
require 'classes/isdk/isdk.php';
require 'includes/utilities.php';
require 'classes/Swift/lib/swift_required.php';
require 'lib/mautic/lib/Mautic/MauticApi.php';



\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array(
    'debug' => true
    ));

$app->contentType("application/json");

$app->error(function ( Exception $e = null) use ($app) {
         echo '{"error":{"text":"'. $e->getMessage() .'"}}';
        });

$app->get('/:controller/:action(/:parameter)', function ($controller, $action, $parameter = null) use($app) {

            include_once "classes/{$controller}.php";
            $classe = new $controller();

            $parameter = $app->request()->get();

            $retorno = call_user_func_array(array($classe, "get_" . $action), array($parameter));
            echo '{"result":' . json_encode($retorno) . '}';
            DB::close();
        });

//POST não possui parâmetros na URL, e sim na requisição

$app->post('/:controller/:action', function ($controller, $action) use ($app){
            $request = json_decode(\Slim\Slim::getInstance()->request()->getBody());
            include_once "classes/{$controller}.php";
            $classe = new $controller();
            $retorno = call_user_func_array(array($classe, "post_" . $action), array($request));
            echo '{"result":' . json_encode($retorno) . '}';
            DB::close();
        });


$app->run();

?>