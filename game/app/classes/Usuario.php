<?php

class Usuario {

    /*  Incrementa a quantidade de acessos do usuário e atualiza a 
    data de ultimo acesso. */
    private function atualiza_acesso() {
        DB::query("UPDATE tb_usuario SET qtd_acessos = qtd_acessos + 1 WHERE id = {$_SESSION["FBID"]} ");
    }

    public function get_premium() {
        $sql = "SELECT status_pagamento FROM tb_usuario WHERE email = :mail";
        $stmt = DB::prepare($sql);
        $stmt->bindParam("mail", $_SESSION["EMAIL"]);
        $stmt->execute();
        $status = $stmt->fetch();
        
        return $status->status_pagamento;
    }

    public function post_perdeu_vida() {
        $sql = "UPDATE tb_usuario SET qtd_vidas = qtd_vidas - 1 WHERE id = {$_SESSION["FBID"]} AND status_pagamento = 0";
        $stmtUsuario = DB::query($sql);
    }

    public function get_lifes() {
        $stmt = DB::prepare("SELECT qtd_vidas FROM tb_usuario WHERE id = {$_SESSION["FBID"]}");
        $stmt->execute();
        $res = $stmt->fetch();

        return $res;
    }

    public function get_profile() {
        $stmt = DB::prepare("SELECT * FROM tb_usuario WHERE (email=:user_email)");
        $stmt->bindParam("user_email", $_SESSION["EMAIL"]);
        $stmt->execute();

        $user = $stmt->fetch();

        $stmt = DB::prepare("SELECT badge FROM tb_badges_usuario WHERE usuario = {$_SESSION["FBID"]} AND badge != '0'");
        $stmt->execute();

        $res = $stmt->fetchall();

        $user->badges = $res;
        $user->larger_foto_profile = null; 
        $user->data_cadastro = implode("/", array_reverse(explode("-", $user->data_cadastro)));   

        // Pega imagem maior do usuario
        if ($user->face_id) {
            $link = "https://graph.facebook.com/" . $user->face_id . "/picture?redirect=0&height=200&type=normal&width=200";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $link
            ));
            $resp = curl_exec($curl);
            $resp = json_decode($resp, true);

            $user->larger_foto_profile = $resp['data']['url'];   
        }

        return $user;
    }

    // Verifica se ha email passado por parametro cadastrado no banco de dados
    public function get_face_profile($email, $aniversario, $localizacao, $foto, $genero) {
        $sql = "SELECT email, id, localizacao, foto_profile, aniversario, genero FROM tb_usuario WHERE (email=:user_email)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam("user_email", $email);
        $stmt->execute();
        $user = $stmt->fetch();

        if (!$user) return false;

        $_SESSION['FBID'] = $user->id;
        if ($user->foto_profile == "" || $user->genero == "") {
            $parts = explode('/', $aniversario);
            $aniversario  = "$parts[2]-$parts[0]-$parts[1]";

            $sql = "UPDATE tb_usuario SET 
                    aniversario = '$aniversario',
                    foto_profile = '$foto',
                    localizacao = '$localizacao',
                    genero = '$genero',
                    via_fb = 1
                    WHERE email = '$email' ";

            $stmtUsuario = DB::query($sql);
        }

        $this->atualiza_acesso();

        return true;
    }

    public function post_login($usuario) {
        $stmt = DB::prepare("SELECT * FROM tb_usuario WHERE (email=:login and senha=:senha)");
        $stmt->bindParam("login", $usuario->email);
        $stmt->bindParam("senha", md5($usuario->senha));
        $stmt->execute();

        $db_usuario = $stmt->fetch();
        var_dump($db_usuario);
        
        // if (!$db_usuario)
        //     return false;
        
        // $_SESSION['FBID'] = $db_usuario->id;
        // $_SESSION['FULLNAME'] = $db_usuario->nome;
        // $_SESSION['EMAIL'] = $db_usuario->email;
        // $_SESSION['PICTURE'] =  $db_usuario->foto_profile;

        // if ($db_usuario->status_pagamento)
        //     $_SESSION['PREMIUM'] = $db_usuario->status_pagamento;

        // var_dump($_SESSION);
        // var_dump($db_usuario);

        // $this->atualiza_acesso();

        // return $db_usuario;

        return true;
    }

    public function post_recupera($data) {
        $stmt = DB::prepare("SELECT * FROM tb_recupera_senha WHERE (code=:api_key)");
        $stmt->bindParam("api_key", $data->api);
        $stmt->execute();

        $db_usuario = $stmt->fetch();

        if ($db_usuario) {
            $sql = "UPDATE tb_usuario SET senha = '".md5($data->senha)."' WHERE id = $db_usuario->usuario ";
            $stmtUsuario = DB::query($sql);   

            $resposta = array("code" => 202,
                              "message" => "Senha alterada com sucesso.");
        }
        else {
            $resposta = array("code" => 404,
                              "message" => "Código de acesso inválido.");
        }

        return $resposta;
    }

    public function post_esqueci($data) {
        $sql = "SELECT id, nome FROM tb_usuario WHERE (email=:user_email)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam("user_email", $data->email);
        $stmt->execute();

        $db_usuario = $stmt->fetch();

        if ($db_usuario) {
            $code = (string)$db_usuario->id . substr((string)md5(time()), 0, 8);

            $sql = "INSERT INTO tb_recupera_senha (usuario, code) 
                VALUES 
                (
                    '" . $db_usuario->id . "', 
                    '" . $code ."'
                )"; 

            $stmtUsuario = DB::query($sql);

            $Mensagem = '
                            <br/>
                            Você esqueceu sua senha para acessar nossa plataforma? Acesse o link abaixo para alterá-la (copie e cole em seu navegador):<br>
                            <br>
                            <br>
                            <div>
                            <p style="color: #fff">https://www.provasdaoab.com.br/aprovagame/game/recupera?api_key='.$code.'</p>
                            </div>
                            <br />
                            <br />
                            <div>
                            Caso não tenha feito esta solicitação, desconsidere este e-mail.
                            </div>
                            <div>

                            <br>                                                                         
                            <br/>
                        ';

            $transport = Swift_SmtpTransport::newInstance('smtp.mandrillapp.com', 587);
            $transport->setUsername('BrunoSette');
            $transport->setPassword('_J7RRVN_BJqYWq1rxuaa7g');
            $swift     = Swift_Mailer::newInstance($transport);

            // Cabeçalho
            $subject   = "AprovaGame";
            $from      = array('questoes@provasdaoab.com.br'  => 'AprovaGame' );
            $to        = array( $data->email => $db_usuario->nome); 

            $html = CorpoEmail("AprovaGame", $db_usuario->nome, $Mensagem);

            $message = Swift_Message::newInstance();
            $headers = $message->getHeaders();
            $headers->addTextHeader('Subject', 'Recuperação de senha');
            $headers->addTextHeader('X-MC-Track', 'opens, clicks_htmlonly');
            $headers->addTextHeader('X-MC-GoogleAnalytics', 'provasdaoab.com.br');

            $message->setFrom($from);
            $message->setBody($html, 'text/html');
            $message->setTo($to);
            $recipients = $swift->send($message, $failures);

            $resposta = array(
                    "code" => 202,
                    "message" => "As informações para recuperação de sua senha foram enviadas para seu e-mail."
                );

        }
        else {
            $resposta = array(
                    "code" => 404,
                    "message" => "E-mail informado não encontra-se cadastrado em nossa base de dados."
                );
        }

        return $resposta;
    }

    // cadastra novo usuario via formulario
    public function post_register($usuario) {
        $sql = "SELECT id FROM tb_usuario WHERE (email=:login)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam("login", $usuario->email);
        $stmt->execute();

        $db_usuario = $stmt->fetch();

        if($db_usuario) return false;

        $today = explode("/", date("Y/m/d"));
        $newToday = "$today[0]-$today[1]-$today[2]";

        $sql = "INSERT INTO tb_usuario (nome, email, senha, pontuacao, pontuacao_geral, qtd_acessos, ultimo_acesso, via_fb, via_email, nivel, qtd_vidas) VALUES 
        ('$usuario->nome', '$usuario->email', '" . md5($usuario->senha) . "', 100, 1500, 0, '$newToday', 0, 1, 1, 10) ";

        $stmtUsuario = DB::query($sql);

        $id = DB::lastInsertId();

        $_SESSION['FBID'] = $id;
        $_SESSION['FULLNAME'] = $usuario->nome;
        $_SESSION['EMAIL'] = $usuario->email;

        subscribeMailChimp($usuario->email, $usuario->nome);

        return $id;
    }
    
    // cadastra novo usuario via facebook login api
    public function post_face_register($usuario) {  
        if (isset($usuario[3]) && $usuario[3] != " ") {
            $parts = explode('/', $usuario[4]);
            $date  = "$parts[2]-$parts[0]-$parts[1]";

            $today = explode("/", date("Y/m/d"));
            $newToday = "$today[0]-$today[1]-$today[2]";

            $sql = "INSERT INTO tb_usuario (face_id, nome, email, senha, pontuacao, pontuacao_geral, foto_profile, localizacao, aniversario, genero, qtd_acessos, ultimo_acesso, via_fb, via_email, nivel, qtd_vidas) 
                    VALUES 
                    (
                        $usuario[0],
                        '$usuario[2]', 
                        '$usuario[3]', 
                        '" . md5($usuario[3]) . "', 
                        100,
                        1500,
                        '$usuario[6]',
                        '$usuario[5]',
                        '$date',
                        '$usuario[7]',
                        1,
                        '$newToday',
                        1,
                        0,
                        1,
                        10
                    ) ";

           $stmtUsuario = DB::query($sql);
           $id = DB::lastInsertId();
           $_SESSION['FBID'] = $id;

           subscribeMailChimp($usuario->email, $usuario->nome);

           return $id;
        }

        return false;
    }

    // desloga usuario
    public function get_logout() {
        $_SESSION["FBID"] = NULL;
        $_SESSION["USERNAME"] = NULL;
        unset($_SESSION['FBID']);
        unset($_SESSION['USERNAME']);
    }

    // retorna moedas do usuario
    public function get_pontuation($email) {
        $stmt = DB::prepare("SELECT pontuacao FROM tb_usuario WHERE email=:mail");
        $stmt->bindParam("mail", $email);
        $stmt->execute();

        $pontuacao = $stmt->fetch();
        return $pontuacao->pontuacao;
    }

    // Retorna pontucao do usuario
    public function get_pontuation_geral($email) {
        $stmt = DB::prepare("SELECT pontuacao_geral FROM tb_usuario WHERE email=:mail");
        $stmt->bindParam("mail", $email);
        $stmt->execute();

        $pontuacao = $stmt->fetch();
        return $pontuacao->pontuacao_geral;
    }

    // Incrementa moedas do usuario
    public function post_pontuation($pontuation) {
        $sql = "UPDATE tb_usuario SET pontuacao = pontuacao + ({$pontuation->pontuation}) WHERE email = '".$_SESSION["EMAIL"]."'";
        $stmtUsuario = DB::query($sql);
        return true;
    }

    // Incrementa pontuacao do usuario
    public function post_pontuation_geral($pontuation) {
        $sql = "UPDATE tb_usuario SET pontuacao_geral = pontuacao_geral + 100 WHERE email = '".$_SESSION["EMAIL"]."'";
        $stmtUsuario = DB::query($sql);
        return true;
    }

    /*
    * Insere no banco de dados uma questão efetuada por um usuário determinado
    * @return bool
    * @date 28/12
    */
    public function post_do_question($params) {
        $usuario = $_SESSION['FBID'];

        $today = explode("/", date("Y/m/d"));
        $newToday = "$today[0]-$today[1]-$today[2]";

        $sql = "INSERT INTO tb_questao_usuario (usuario, questao, acertou, marcou, data) 
                VALUES 
                (
                    '" . $usuario . "', 
                    '" . $params->questao . "', 
                    '" . $params->user_acertou . "',
                    '" . $params->user_resposta . "',
                    '" . $newToday . "'
                ) ";

        $stmtUsuario = DB::query($sql);

        if ($params->user_acertou)
           $sql = "UPDATE tb_questoes_multiplaescolha SET acertos = acertos + 1 WHERE id = $params->questao";
        else
            $sql = "UPDATE tb_questoes_multiplaescolha SET erros = erros + 1 WHERE id = $params->questao";

        $stmtUsuario = DB::query($sql);

        return true;
    }

    /*
    * Retorna o ranking de cinco usuários, incluindo o usuário logado (que solicita ranking)
    * @return array
    * @date 31/12
    */
    public function get_ranking() {
        $sql = "SELECT id, nome, foto_profile, pontuacao_geral AS pontuacao FROM tb_usuario ORDER BY pontuacao DESC";
        $stmt = DB::prepare($sql);
        $stmt->execute();

        $users = array();
        $ret = array();

        $i = $j = $k = 0;
        $myUser;
        while($user = $stmt->fetch()) {
            $nomeCompleto = explode(" ", $user->nome);
            if(count($nomeCompleto) > 1){
                $user->nome = $nomeCompleto[0] . " " . $nomeCompleto[1];
            }
            
            $user->posicao = $i + 1;
            $users[$i] = $user;

            if ($user->id == $_SESSION['FBID']) $myUser = $i;

            $i++;
        }

        if ($myUser == 0) {
            for ($j = $myUser; $j < 5; $j++) { 
                $ret[$k] = $users[$j];
                $k++;
            }
        }
        else if($myUser == 1) {
            $ret[$k] = $users[0];
            $k++;

            for ($j= $myUser; $j < 5; $j++) { 
                $ret[$k] = $users[$j];
                $k++;
            }
        }
        else {
            for ($j= $myUser - 2; $j <= $myUser + 2; $j++) { 
                $ret[$k] = $users[$j];
                $k++;
            }
        }

        return $ret;
    }

    // Retorna nivel do usuario.
    public function get_nivel() {
        $stmt = DB::prepare("SELECT nivel FROM tb_usuario WHERE id = {$_SESSION["FBID"]}");
        $stmt->execute();

        $res = $stmt->fetch();
        return $res->nivel;
    }

    public function post_update_nivel($nivel) {
        DB::query("UPDATE tb_usuario SET nivel = $nivel->novo WHERE email = '".$_SESSION["EMAIL"]."'");
        return true;
    }

    public function get_acertos() {
        $sql = "SELECT COUNT(id) AS acertos FROM tb_questao_usuario WHERE usuario = {$_SESSION["FBID"]} AND acertou = 1 ";
        $stmt = DB::prepare($sql);
        $stmt->execute();

        $res = $stmt->fetch();
        
        return $res->acertos;
    }

    public function post_update($user) {
        $user->notificacoes = $user->notificacoes ? 1 : 0;

        if ($user->nova_senha != "") {
            $sql = "UPDATE tb_usuario SET 
                nome = '$user->nome',
                localizacao = '$user->localizacao',
                aniversario = '$user->aniversario',
                email = '$user->email',
                senha = '". md5($user->nova_senha) ."',
                lembretes = $user->notificacoes,
                WHERE id = {$_SESSION["FBID"]} ";
        }
        else {
            $sql = "UPDATE tb_usuario SET 
                    nome = '$user->nome',
                    localizacao = '$user->localizacao',
                    aniversario = '$user->aniversario',
                    email = '$user->email',
                    lembretes = $user->notificacoes
                    WHERE id = {$_SESSION["FBID"]} ";
        }

        //DB::query($sql);

        echo ($sql);

        return true;
    }
}

?>