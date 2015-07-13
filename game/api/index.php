<?php
require 'config.php';
require 'DB.php';

require 'Slim/Slim.php';
require 'classes/isdk/isdk.php';
require 'includes/utilities.php';
require 'classes/Swift/lib/swift_required.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array('debug' => true));

$app->contentType("application/json");

$app->error(function ( Exception $e = null) use ($app) {
         echo '{"error":{"text":"'. $e->getMessage() .'"}}';
        });

$user_id = NULL;

/**
 * Adding Middle Layer to authenticate every request
 * Checking if the request has valid api key in the 'Authorization' header
 */
function authenticate(\Slim\Route $route)
{
    // Getting request headers
    $headers = apache_request_headers();
    $response = array();
    $app = \Slim\Slim::getInstance();

    if (isset($headers['Authorization']))
    {
        include_once "classes/Usuario.php";

        $api_key = $headers['Authorization'];
        $isValid = Usuario::isValidApiKey($api_key);

        if (!$isValid)
        {
            $response["error"] = true;
            $response["message"] = "Acesso negado. Chave inválida!";
            echoRespnse(401, $response);
            $app->stop();
        } 
        else
        {
            global $user_id;
            $user_id = Usuario::getUserId($api_key);
        }
    }
    else
    {
        $response["error"] = true;
        $response["message"] = "Erro. A chave não foi passada.";
        echoRespnse(400, $response);
        $app->stop();
    }
}

/**
 * Usuário API
 * Esta sessão é responsável por fornecer chamadas para gerenciar usuários.
 **/

$app->post('/registro/email', function() use ($app){
    $response = array();

    $data = json_decode(\Slim\Slim::getInstance()->request()->getBody());

    include_once "classes/Usuario.php";
    $Usuario = new Usuario;

    $ret = $Usuario->register($data);

    if($ret == USUARIO_CADASTRADO)
    {
        $response["error"] = false;
        $response["message"] = "Usuário registrado com sucesso!";

        echoRespnse(201, $response);
    }
    else
    {
        if($ret == USUARIO_EXISTENTE)
        {
            $response["error"] = true;
            $response["message"] = "Desculpe, este e-mail já está cadastrado.";
        }
        else if($ret == ERRO_CADASTRO)
        {
            $response["error"] = true;
            $response["message"] = "Desculpe, ocorreu ao efetuar cadastro, tente novamente mais tarde.";
        }
        else if($ret == EMAIL_INVALIDO)
        {
            $response["error"] = true;
            $response["message"] = "Formato de e-mail inválido.";
        }
        else if($ret == SENHA_INVALIDA)
        {
            $response["error"] = true;
            $response["message"] = "Formato de senha inválido. A senha deve possuir entre 6 e 20 caracteres.";
        }

        echoRespnse(400, $response);
    }
});

$app->post('/registro/facebook', function() use ($app){
    $response = array();

    $data = json_decode(\Slim\Slim::getInstance()->request()->getBody());

    include_once "classes/Usuario.php";
    $Usuario = new Usuario;

    $ret = $Usuario->facebookRegister($data);

    if($ret == USUARIO_CADASTRADO)
    {
        $response["error"] = false;
        $response["newreg"] = true; 
        $response["message"] = "Usuário registrado com sucesso!";
    }
    else if($ret == USUARIO_EXISTENTE)
    {
        $user = $Usuario->getUserByEmail($data->email);

        $response['error'] = false;
        $response["newreg"] = false; 
        $response['nome'] = $user['nome'];
        $response['email'] = $user['email'];
        $response['foto'] = $user['foto_profile'];
        $response['genero'] = $user['genero'];
        $response['pontuacao'] = $user['pontuacao_geral'];
        $response['moedas'] = $user['pontuacao'];
        $response['nivel'] = $user['nivel'];
        $response['qtd_vidas'] = $user['qtd_vidas'];
        $response['api_key'] = $user['api_key'];
    }
    else if($ret == ERRO_CADASTRO)
    {
        $response["error"] = true;
        $response["message"] = "Desculpe, ocorreu ao efetuar cadastro, tente novamente mais tarde.";
    }

    echoRespnse(200, $response);
});

$app->post('/login', function() use ($app){
    $response = array();

    $data = json_decode(\Slim\Slim::getInstance()->request()->getBody());

    include_once "classes/Usuario.php";
    $Usuario = new Usuario;

    if($Usuario->checkLogin($data))
    {
        $user = $Usuario->getUserByEmail($data->email);

        $response['error'] = false;
        $response['nome'] = $user['nome'];
        $response['email'] = $user['email'];
        $response['foto'] = $user['foto_profile'];
        $response['genero'] = $user['genero'];
        $response['pontuacao'] = $user['pontuacao_geral'];
        $response['moedas'] = $user['pontuacao'];
        $response['nivel'] = $user['nivel'];
        $response['qtd_vidas'] = $user['qtd_vidas'];
        $response['api_key'] = $user['api_key'];
    }
    else
    {
        $response['error'] = true;
        $response['message'] = 'Erro ao efetuar login. Dados incorretos.';
    }

    echoRespnse(200, $response);
});

$app->get('/perfil', 'authenticate', function() {
    global $user_id;
    $response = array();

    include_once "classes/Usuario.php";
    $Usuario = new Usuario;

    $profile = $Usuario->userProfile($user_id);

    if($profile)
    {
        $response['error'] = false;
        $response['data'] = $profile;
    }
    else
    {
        $response['error'] = true;
        $response['message'] = 'Acorreu um erro ao processar sua solicitação. Tente novamente mais tarde.';
    }

    echoRespnse(200, $response);
});

$app->get('/conquistas', 'authenticate', function() {
    global $user_id;
    $response = array();

    include_once "classes/Usuario.php";
    $badges = Usuario::badges($user_id);

    if($badges)
    {
        $response['error'] = false;
        $response['data'] = $badges;
    }
    else
    {
        $response['error'] = true;
        $response['message'] = 'Acorreu um erro ao processar sua solicitação. Tente novamente mais tarde.';
    }

    echoRespnse(200, $response);
});

$app->get('/valores', 'authenticate', function() {
    global $user_id;
    $response = array();

    include_once "classes/Usuario.php";
    $info = Usuario::valores($user_id);

    if($info)
    {
        $response['error'] = false;
        $response['data'] = $info;
    }
    else
    {
        $response['error'] = true;
        $response['message'] = 'Acorreu um erro ao processar sua solicitação. Tente novamente mais tarde.';
    }

    echoRespnse(200, $response);
});

$app->get('/vidas', 'authenticate', function() {
    global $user_id;
    $response = array();

    include_once "classes/Usuario.php";

    $response['error'] = false;
    $response['data'] = Usuario::getVidas($user_id);

    echoRespnse(200, $response);
});

$app->post('/moedas', 'authenticate', function(){
    global $user_id;
    $response = array();

    $moedas = json_decode(\Slim\Slim::getInstance()->request()->getBody())->moedas;

    include_once "classes/Usuario.php";

    if(Usuario::updateCash($user_id, $moedas))
    {
        $response['error'] = false;
        $response['message'] = 'Moedas atualizadas com sucesso.';
    }
    else
    {
        $response['error'] = true;
        $response['message'] = 'Acorreu um erro ao processar sua solicitação. Tente novamente mais tarde.';
    }

    echoRespnse(200, $response);
});

$app->post('/pontuacao', 'authenticate', function(){
    global $user_id;
    $response = array();

    $pontuacao = json_decode(\Slim\Slim::getInstance()->request()->getBody())->pontuacao;

    include_once "classes/Usuario.php";

    if(Usuario::updatePontuation($user_id, $pontuacao))
    {
        $response['error'] = false;
        $response['message'] = 'Pontuação atualizada com sucesso.';
    }
    else
    {
        $response['error'] = true;
        $response['message'] = 'Erro ao efetuar sua solicitação. Tente novamente.';
    }

    echoRespnse(200, $response);
});

$app->post('/nivelatualizar', 'authenticate', function(){
    global $user_id;
    $response = array();

    include_once "classes/Usuario.php";

    if(Usuario::updateLevel($user_id))
    {
        $response['error'] = false;
        $response['message'] = 'Nivel atualizado com sucesso.';
    }
    else
    {
        $response['error'] = true;
        $response['message'] = 'Erro ao efetuar sua solicitação. Tente novamente.';
    }

    echoRespnse(200, $response);
});

$app->post('/perdeuvida', 'authenticate', function(){
    global $user_id;
    $response = array();

    include_once "classes/Usuario.php";

    $retorno = Usuario::perdeuVida($user_id);

    if($retorno != -1)
    {
        $response['error'] = false;
        $response['data'] = array("vidas" => $retorno);
    }
    else
    {
        $response['error'] = true;
        $response['message'] = 'Erro ao efetuar sua solicitação. O usuario não possui vidas.';
    }

    echoRespnse(200, $response);
});

/**
 * Questões API
 * Esta sessão é responsável por fornecer chamadas para lidar com questões.
 **/

$app->post('/rodada', 'authenticate', function(){
    global $user_id;
    $response = array();

    include_once "classes/Questoes.php";
    include_once "classes/Usuario.php";

    $convidado = json_decode(\Slim\Slim::getInstance()->request()->getBody())->convidado;
    $concurso = json_decode(\Slim\Slim::getInstance()->request()->getBody())->concurso;

    //$round = new Questoes;
    $info = Questoes::newRound($user_id, $convidado, $concurso);

    if($info)
    {
        $response['error'] = false;
        $response['data'] = $info;
    }
    else
    {
        $response['error'] = true;
        $response['message'] = 'Você não possui vidas suficientes.';
    }

    echoRespnse(200, $response);
});

$app->post('/corrigir', 'authenticate', function(){
    global $user_id;
    $response = array();

    include_once "classes/Questoes.php";
    include_once "classes/Usuario.php";

    $data = json_decode(\Slim\Slim::getInstance()->request()->getBody());
    $info = Questoes::doQuestions($data->cod_rodada, $data->questoes, $user_id);

    if($info)
    {
        $response['error'] = false;
        $response['data'] = $info;
    }
    else
    {
        $response['error'] = true;
        $response['message'] = 'Acorreu um erro ao processar sua solicitação. Tente novamente mais tarde.';
    }

    echoRespnse(200, $response);
});

$app->get('/rodadas', 'authenticate', function() use ($app){
    global $user_id;
    $response = array();

    include_once "classes/Questoes.php";

    $info = Questoes::getRodadas($user_id);

    if($info)
    {
        $response['error'] = false;
        $response['data'] = $info;
    }
    else
    {
        $response['error'] = true;
        $response['message'] = 'Acorreu um erro ao processar sua solicitação. Tente novamente mais tarde.';
    }

    echoRespnse(201, $response);
});

$app->get('/comentarios', 'authenticate', function() use ($app){
    global $user_id;
    $response = array();

    include_once "classes/Questoes.php";

    $questao = (int)$app->request()->get('questao');
    $pagina = (int)$app->request()->get('pagina');

    $info = Questoes::questaoComentarios($questao, $pagina);

    if($info)
    {
        $response['error'] = false;
        $response['data'] = $info;
    }
    else
    {
        $response['error'] = true;
        $response['message'] = 'Acorreu um erro ao processar sua solicitação. Tente novamente mais tarde.';
    }

    echoRespnse(201, $response);
});

$app->post('/comentario', 'authenticate', function(){
    global $user_id;
    $response = array();

    include_once "classes/Questoes.php";

    $data = json_decode(\Slim\Slim::getInstance()->request()->getBody());
    $info = Questoes::insereComentario($data);

    if($info)
    {
        $response['error'] = false;
        $response['message'] = 'Comentário inserido com sucesso.';
    }
    else
    {
        $response['error'] = true;
        $response['message'] = 'Acorreu um erro ao processar sua solicitação. Tente novamente mais tarde.';
    }

    echoRespnse(201, $response);
});

$app->post('/like', 'authenticate', function(){
    global $user_id;
    $response = array();

    include_once "classes/Questoes.php";

    $comentario = json_decode(\Slim\Slim::getInstance()->request()->getBody())->comentario;
    $info = Questoes::likeComentario($comentario);

    if($info)
        $response['error'] = false;
    else
    {
        $response['error'] = true;
        $response['message'] = 'Acorreu um erro ao processar sua solicitação. Tente novamente mais tarde.';
    }

    echoRespnse(200, $response);
});

$app->get('/ranking_geral', 'authenticate', function() {
    global $user_id;
    $response = array();

    include_once "classes/Usuario.php";
    $info = Usuario::rankingGeral($user_id);

    $response['error'] = false;
    $response['data'] = $info;

    echoRespnse(200, $response);
});

$app->get('/tempo_vida', 'authenticate', function() {
    global $user_id;
    $response = array();

    include_once "classes/Questoes.php";
    $time = Questoes::getLifeTime();

    $response['error'] = false;
    $response['data'] = $time;

    echoRespnse(200, $response);
});

$app->get('/concursos', 'authenticate', function() {
    global $user_id;
    $response = array();

    include_once "classes/Questoes.php";
    
    $response['error'] = false;
    $response['data'] = Questoes::getConcursos();

    echoRespnse(200, $response);
});

/**
 * Badges API
 * Esta sessão é responsável por fornecer chamadas para gerenciar badges
 **/

$app->post('/badge', 'authenticate', function(){
    global $user_id;
    $response = array();

    $badge = json_decode(\Slim\Slim::getInstance()->request()->getBody())->badge;

    include_once "classes/Badge.php";

    if(Badge::insertBadge($user_id, $badge))
    {
        $response['error'] = false;
        $response['message'] = 'Badge atribuido com sucesso.';
    }
    else
    {
        $response['error'] = true;
        $response['message'] = 'O usuário já possui este badge.';
    }

    echoRespnse(201, $response);
});


/**
 * Echoing json response to client
 * @param String $status_code Http response code
 * @param Int $response Json response
 */
function echoRespnse($status_code, $response)
{
    $app = \Slim\Slim::getInstance();
    $app->status($status_code);
    $app->contentType('application/json');

    echo json_encode($response);
}

$app->run();

?>