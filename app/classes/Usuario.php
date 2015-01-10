<?php

class Usuario {

    private function atualiza_acesso()
    {
        $sql = "UPDATE tb_usuario SET qtd_acessos = qtd_acessos + 1 WHERE id = {$_SESSION["FBID"]} ";
        $stmtUsuario = DB::query($sql);
    }

    public function get_profile()
    {
        die('foi');
        $sql = "SELECT * FROM tb_usuario WHERE (email=:user_email)";
        $stmt = DB::prepare($sql);

        $stmt->bindParam("user_email", $_SESSION["EMAIL"]);
        $stmt->execute();

        $user = $stmt->fetch();

        return $user;
    }

    // Verifica se ha email passado por parametro cadastrado no banco de dados
    public function get_face_profile($email, $aniversario, $localizacao, $foto, $genero)
    {
        $sql = "SELECT email, id, localizacao, foto_profile, aniversario, genero FROM tb_usuario WHERE (email=:user_email)";
        $stmt = DB::prepare($sql);

        $stmt->bindParam("user_email", $email);
        $stmt->execute();

        $user = $stmt->fetch();

        if ($user)
        {
            $_SESSION['FBID'] = $user->id;
            
            if ($user->foto_profile == "" || $user->genero == "")
            {
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

            // incrementa a quantidade de acessos do usuário e atualiza a data de ultimo acesso.
            $this->atualiza_acesso();

            return true;
        }
        
        return false;
    }

    // verifica se usuario existe
    public function post_login($usuario)
    {
        $sql = "SELECT * FROM tb_usuario WHERE (email=:login and senha=:senha)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam("login", $usuario->email);
        $stmt->bindParam("senha", md5($usuario->senha));
        $stmt->execute();

        $db_usuario = $stmt->fetch();

        if ($db_usuario)
        {
            $_SESSION['FBID'] = $db_usuario->id;
            $_SESSION['FULLNAME'] = $db_usuario->nome;
            $_SESSION['EMAIL'] = $db_usuario->email;
            $_SESSION['MOEDAS'] = $db_usuario->pontuacao;
            $_SESSION['PONTUACAO'] = $db_usuario->pontuacao_geral;

            // incrementa a quantidade de acessos do usuário e atualiza a data de ultimo acesso.
            $this->atualiza_acesso();

            return $db_usuario;
        }
        else
        {
            return false;
        }
    }

    // cadastra novo usuario via formulario
    public function post_register($usuario)
    {
        $sql = "SELECT id FROM tb_usuario WHERE (email=:login)";
        $stmt = DB::prepare($sql);
        $stmt->bindParam("login", $usuario->email);
        $stmt->execute();

        $db_usuario = $stmt->fetch();

        if(!$db_usuario)
        {
            $today = explode("/", date("Y/m/d"));
            $newToday = "$today[0]-$today[1]-$today[2]";

            $sql = "INSERT INTO tb_usuario (nome, email, senha, pontuacao, pontuacao_geral, qtd_acessos, ultimo_acesso, via_fb, via_email, nivel) VALUES 
            ('$usuario->nome', '$usuario->email', '" . md5($usuario->senha) . "', 100, 1500, 0, '$newToday', 0, 1, 1) ";

            $stmtUsuario = DB::query($sql);

            $id = DB::lastInsertId();

            $params = array( "nome" => $usuario->nome,
                         "email" => $usuario->email,
                         "localizacao" => $usuario->localizacao
                       );

            cadastrarInFusion($params);

            $_SESSION['FBID'] = $id;
            $_SESSION['FULLNAME'] = $usuario->nome;
            $_SESSION['EMAIL'] = $usuario->email;
            $_SESSION['MOEDAS'] = 100;
            $_SESSION['PONTUACAO'] = 1500;

            return $id;
        }
        else
        {
            return false;
        }
    }
    
    // cadastra novo usuario via facebook login api
    public function post_face_register($usuario)
    {  
        if (isset($usuario[3]) && $usuario[3] != " ")
        {
            $parts = explode('/', $usuario[4]);
            $date  = "$parts[2]-$parts[0]-$parts[1]";

            $today = explode("/", date("Y/m/d"));
            $newToday = "$today[0]-$today[1]-$today[2]";

            $sql = "INSERT INTO tb_usuario (nome, email, senha, pontuacao, pontuacao_geral, foto_profile, localizacao, aniversario, genero, qtd_acessos, ultimo_acesso, via_fb, via_email, nivel) 
                    VALUES 
                    (
                        '$usuario[2]', 
                        '$usuario[3]', 
                        '" . md5($usuario[3]) . "', 
                        100,
                        1500,
                        '$usuario[6]',
                        '$usuario[5]',
                        '$date',
                        '$usuario[7]',
                        0,
                        '$newToday',
                        1,
                        0,
                        1
                    ) ";

            $params = array( "nome" => $usuario[2],
                             "email" => $usuario[3],
                             "localizacao" => $usuario[5]
                           );

           cadastrarInFusion($params);

           $stmtUsuario = DB::query($sql);
           $id = DB::lastInsertId();
           $_SESSION['FBID'] = $id;
           $_SESSION['MOEDAS'] = 100;
           $_SESSION['PONTUACAO'] = 1500;

           return $id;
        }
        else
            return false;
    }

    // desloga usuario
    public function get_logout()
    {
        $_SESSION["FBID"] = NULL;
        $_SESSION["USERNAME"] = NULL;
        unset($_SESSION['FBID']);
        unset($_SESSION['USERNAME']);
    }

    // retorna moedas do usuario
    public function get_pontuation($email)
    {
        $sql = "SELECT pontuacao FROM tb_usuario WHERE email=:mail";
        $stmt = DB::prepare($sql);
        $stmt->bindParam("mail", $email);
        $stmt->execute();

        $pontuacao = $stmt->fetch();
        
        return $pontuacao->pontuacao;
    }

    // retorna pontucao do usuario
    public function get_pontuation_geral($email)
    {
        $sql = "SELECT pontuacao_geral FROM tb_usuario WHERE email=:mail";
        $stmt = DB::prepare($sql);
        $stmt->bindParam("mail", $email);
        $stmt->execute();

        $pontuacao = $stmt->fetch();
        
        return $pontuacao->pontuacao_geral;
    }

    // incrementa moedas do usuario
    public function post_pontuation($pontuation)
    {
        $sql = "UPDATE tb_usuario SET pontuacao = pontuacao + ({$pontuation->pontuation}) WHERE email = '".$_SESSION["EMAIL"]."'";
        $_SESSION['MOEDAS'] += $pontuation->pontuation;
        $stmtUsuario = DB::query($sql);
        return true;
    }

    // incrementa pontuacao do usuario
    public function post_pontuation_geral($pontuation)
    {
        $sql = "UPDATE tb_usuario SET pontuacao_geral = pontuacao_geral + 100 WHERE email = '".$_SESSION["EMAIL"]."'";
        $_SESSION['PONTUACAO'] += 100;
        $stmtUsuario = DB::query($sql);
        return true;
    }

    /*
    * Insere no banco de dados uma questão efetuada por um usuário determinado
    * @return bool
    * @date 28/12
    */
    public function post_do_question($params)
    {
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
    public function get_ranking()
    {
        $sql = "SELECT id, nome, foto_profile, pontuacao FROM tb_usuario ORDER BY pontuacao DESC";
        $stmt = DB::prepare($sql);
        $stmt->execute();

        $users = array();
        $ret = array();

        $i = $j = $k = 0;
        $myUser;
        while($user = $stmt->fetch())
        {
            $nomeCompleto = explode(" ", $user->nome);
            $user->nome = $nomeCompleto[0] . " " . $nomeCompleto[1];
            $user->posicao = $i + 1;

            $users[$i] = $user;

            if ($user->id == $_SESSION['FBID']) $myUser = $i;

            $i++;
        }

        if ($myUser == 0)
        {
            for ($j = $myUser; $j < 5; $j++)
            { 
                $ret[$k] = $users[$j];
                $k++;
            }
        }
        else if($myUser == 1)
        {
            $ret[$k] = $users[0];
            $k++;

            for ($j= $myUser; $j < 5; $j++)
            { 
                $ret[$k] = $users[$j];
                $k++;
            }
        }
        else
        {
            for ($j= $myUser - 2; $j <= $myUser + 2; $j++)
            { 
                $ret[$k] = $users[$j];
                $k++;
            }
        }

        return $ret;
    }

    public function get_ranking_friends(){
        $friends = $_SESSION['FRIENDS'];

        $ids = array();
        foreach ($friends['data'] as $key => $friend) {
            array_push($ids,$friend['id']);
        }
        $ids = implode(",", $ids);

        $sql = "SELECT nome, pontuacao_geral as pontuacao, foto_profile as foto FROM tb_usuario WHERE face_id IN ($ids) ORDER BY pontuacao_geral ASC";


        $stmt = DB::prepare($sql);
        $stmt->execute();

        $res = $stmt->fetchall();
        return $res;
    }

    public function post_store_friendlist($data)
    {
        $today = explode("/", date("Y/m/d"));
        $newToday = "$today[0]-$today[1]-$today[2]";

        foreach ($data as $value)
        {
            $picture = "https://graph.facebook.com/" . $value["id"] . "/picture";

            $sql = "INSERT INTO tb_amigos (usuario, amigo, foto_amigo, nome_amigo, via, data_amizade) 
                    VALUES 
                    (
                        {$_SESSION['FBID']}, 
                        {$value["id"]}, 
                        '$picture', 
                        '".$value["name"]."',
                        1,
                        '$newToday'
                    ) ";

            $stmtUsuario = DB::query($sql);
        }

        return true;
    }

    // retorna nivel do usuario
    public function get_nivel()
    {
        $sql = "SELECT nivel FROM tb_usuario WHERE id = {$_SESSION["FBID"]}";
        $stmt = DB::prepare($sql);
        $stmt->execute();

        $res = $stmt->fetch();
        
        return $res->nivel;
    }

    public function post_update_nivel($nivel)
    {
        $sql = "UPDATE tb_usuario SET nivel = $nivel->novo WHERE email = '".$_SESSION["EMAIL"]."'";
        $stmtUsuario = DB::query($sql);
        return true;
    }

    public function get_acertos()
    {
        $sql = "SELECT COUNT(id) AS acertos FROM tb_questao_usuario WHERE usuario = {$_SESSION["FBID"]} AND acertou = 1 ";
        $stmt = DB::prepare($sql);
        $stmt->execute();

        $res = $stmt->fetch();
        
        return $res->acertos;
    }

    public function get_badges()
    {
        $sql = "SELECT badge FROM tb_badges_usuario WHERE usuario = {$_SESSION["FBID"]}";
        $stmt = DB::prepare($sql);
        $stmt->execute();

        $res = $stmt->fetch();
        
        return $res;
    }

}

?>