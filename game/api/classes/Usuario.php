<?php

class Usuario {

    private function atualiza_acesso($id)
    {
        $sql = "UPDATE tb_usuario SET qtd_acessos = qtd_acessos + 1 WHERE id = $id";
        $stmtUsuario = DB::query($sql);
    }

    private function usuarioExiste($email)
    {
        $stmt = DB::prepare("SELECT id FROM tb_usuario WHERE (email = :email)");
        $stmt->bindParam("email", $email);
        $stmt->execute();

        return $stmt->fetch();
    }

    private function generateApiKey()
    {
        return md5(uniqid(rand(), true));
    }

    public static function getVidas($usuario)
    {
        $stmtUser = DB::prepare("SELECT qtd_vidas FROM tb_usuario WHERE id = :id");
        $stmtUser->execute(array(":id" => $usuario));
        
        return (int)$stmtUser->fetch()->qtd_vidas;
    }

    public static function perdeuVida($usuario)
    {
        $lifes = self::getVidas($usuario);

        if($lifes > 0)
        {
            $sql = "UPDATE tb_usuario SET qtd_vidas = qtd_vidas - 1 WHERE id = $usuario";
            $stmtUsuario = DB::query($sql);

            return ($lifes - 1);
        }
        else return false;
    }

    // cadastra novo usuario via formulario
    public function register($usuario)
    {
        if($usuario->email != "" && $usuario->senha != "")
        {
            if(!filter_var($usuario->email, FILTER_VALIDATE_EMAIL)) return EMAIL_INVALIDO;

            $passwordLen = strlen($usuario->senha);
            if($passwordLen < 6 || $passwordLen > 20) return SENHA_INVALIDA;

            if(!$this->usuarioExiste($usuario->email))
            {
                $today = DB::dateToMySql(date("Y/m/d"));
                $api_key = $this->generateApiKey();

                $stmt = DB::prepare("INSERT INTO tb_usuario (nome, email, senha, api_key, ultimo_acesso, pontuacao, pontuacao_geral, qtd_acessos, via_fb, via_email, nivel) VALUES
                            (?, ?, ?, ?, ?, 100, 1500, 0, 0, 1, 1)");

                $stmt->execute(array($usuario->nome, $usuario->email, md5($usuario->senha), $api_key, $today));

                $id = DB::lastInsertId();

                cadastrarInFusion(array( 
                                    "nome" => $usuario->nome,
                                    "email" => $usuario->email
                                ));

                if($id) return USUARIO_CADASTRADO;
                
                else return ERRO_CADASTRO;
            }
            else
                return USUARIO_EXISTENTE;
        }
        else
            return ERRO_CADASTRO;
    }
    
    // cadastra novo usuario via facebook login api
    public function facebookRegister($usuario)
    {
        if($usuario->email != "" && $usuario->faceid != "")
        {
            if (!$this->usuarioExiste($usuario->email))
            {
                $today = DB::dateToMySql(date("Y/m/d"));
                $api_key = $this->generateApiKey();
                $dataNascimento = DB::dateToMySql($usuario->data_nascimento);

                $sql = "INSERT INTO tb_usuario 
                            (
                                face_id, 
                                nome, 
                                email, 
                                senha, 
                                foto_profile, 
                                localizacao, 
                                aniversario, 
                                genero, 
                                data_cadastro,
                                api_key, 
                                pontuacao, 
                                pontuacao_geral,
                                qtd_acessos, 
                                via_fb, 
                                via_email, 
                                nivel
                            ) 
                            VALUES  (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 100, 1500, 0, 1, 0, 1)";

                $stmt = DB::prepare($sql);
                $stmt->execute(array(
                                $usuario->faceid, 
                                $usuario->nome, 
                                $usuario->email, 
                                md5($usuario->email), 
                                $usuario->foto, 
                                $usuario->localizacao,
                                $dataNascimento,
                                $usuario->genero,
                                $today, 
                                $api_key
                            ));

                $id = DB::lastInsertId();

               cadastrarInFusion(array( 
                                "nome" => $usuario->nome,
                                 "email" => $usuario->email,
                                 "localizacao" => $usuario->localizacao
                               ));

                if($id) return USUARIO_CADASTRADO;
                
                else return ERRO_CADASTRO;
            }
            else
                return USUARIO_EXISTENTE;
        }
        else
            return ERRO_CADASTRO;
    }

    // login do usuário
    public function checkLogin($usuario)
    {
        if($usuario->email != "" && $usuario->senha != "")
        {
            $stmt = DB::prepare("SELECT id, senha FROM tb_usuario WHERE email = :mail");
            $stmt->bindParam("mail", $usuario->email);
            $stmt->execute();

            $info = $stmt->fetch();

            $password = $info->senha;
            $id = $info->id;

            if ($password)
            {
                if($password == md5($usuario->senha))
                {
                    $this->atualiza_acesso($id); // usuario efetuou login

                    return true;
                }
                else
                    return false;
            }
            else
                return false;
        }
        else
            return false;
    }

    public function getUserByEmail($email)
    {
        $stmt = DB::prepare("SELECT nome, email, foto_profile, genero, pontuacao_geral, pontuacao, nivel, qtd_vidas, api_key FROM tb_usuario WHERE email = :mail");
        $stmt->bindParam("mail", $email);
        $stmt->execute();

        $user = (array) $stmt->fetch();

        return $user;
    }

    public static function isValidAPIKey($api_key)
    {
        if($api_key != "")
        {
            $stmt = DB::prepare("SELECT count(id) AS results FROM tb_usuario WHERE api_key = :key");
            $stmt->bindParam("key", $api_key);
            $stmt->execute();

            return ($stmt->fetch()->results > 0);
        }
        else
            return false;
    }

    // obtem o ID do usuário a partir da chave da API
    public static function getUserId($api_key)
    {
        $stmt = DB::prepare("SELECT id FROM tb_usuario WHERE api_key = :key");
        $stmt->bindParam("key", $api_key);
        $stmt->execute();

        $id = $stmt->fetch()->id;

        return $id;
    }

    // obtem o perfil completo do usuário
    public function userProfile($id)
    {
        $stmt = DB::prepare("SELECT face_id, nome, email, localizacao, genero, pontuacao AS moedas, pontuacao_geral AS pontuacao, nivel, qtd_vidas, data_cadastro FROM tb_usuario WHERE id= :user");
        $stmt->bindParam("user", $id);
        $stmt->execute();
        $user = $stmt->fetch();

        $user->foto_profile = null; 
        $user->data_cadastro = DB::dateFromMySql($user->data_cadastro);

        if ($user->face_id) // pega foto maior do usuario
        {
            $link = "http://graph.facebook.com/" . $user->face_id . "/picture?redirect=0&height=200&type=normal&width=200";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $link
            ));
            $resp = curl_exec($curl);
            $resp = json_decode($resp, true);

            $user->foto_profile = $resp['data']['url'];   
        }

        return (array)$user;
    }

    // obtem badges conquistados pelo usuário
    public static function badges($id)
    {
        $stmt = DB::prepare("SELECT badge FROM tb_badges_usuario WHERE usuario = :user");
        $stmt->bindParam("user", $id);
        $stmt->execute();

        $badges = array();
        while($res = $stmt->fetch()) $badges[] = (int)$res->badge;

        return $badges;
    }

    // obtem moedas e pontuacao do usuario
    public static function valores($id)
    {
        $stmt = DB::prepare("SELECT pontuacao AS moedas, pontuacao_geral AS pontuacao FROM tb_usuario WHERE id = :user");
        $stmt->bindParam("user", $id);
        $stmt->execute();

        return (array)$stmt->fetch();
    }

    // incrementa moedas do usuario
    public static function updateCash($usuario, $moedas)
    {
        $stmt = DB::query("UPDATE tb_usuario SET pontuacao = pontuacao + $moedas WHERE id = $usuario");
        
        if($stmt) return true;
        else return false;
    }

    // incrementa pontuacao do usuario
    public static function updatePontuation($usuario, $pontuacao)
    {
        $stmt = DB::query("UPDATE tb_usuario SET pontuacao_geral = pontuacao_geral + $pontuacao WHERE id = $usuario");
        
        if($stmt) return true;
        else return false;
    }

    public static function updateLevel($usuario)
    {
        $stmt = DB::query("UPDATE tb_usuario SET nivel = nivel + 1 WHERE id = $usuario");
        
        if($stmt) return true;
        else return false;
    }

    public static function rankingGeral($usuario)
    {
        $sql = "(
                    SELECT id, nome, pontuacao_geral, foto_profile FROM tb_usuario 
                    WHERE 
                    pontuacao_geral > (SELECT pontuacao_geral from tb_usuario WHERE id = $usuario) 
                    order by pontuacao_geral ASC LIMIT 4
                )
                UNION
                (
                    SELECT id, nome, pontuacao_geral, foto_profile from tb_usuario WHERE id = $usuario
                )
                UNION 
                (
                    SELECT id, nome, pontuacao_geral, foto_profile FROM tb_usuario 
                    WHERE 
                    pontuacao_geral < (SELECT pontuacao_geral from tb_usuario WHERE id = $usuario) 
                    order by pontuacao_geral DESC LIMIT 4
                )";
        $stmt = DB::prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();

        $myUser = -1;
        $qtdUsers = count($users);

        for($i = 0; $i < $qtdUsers; $i++)
        {  
            if($users[$i]->id == $usuario)
            {
                $myUser = $i;
                break;
            }
        }

        $inicio = $fim = $myUser;

        if($myUser == 0)
        {
            $fim += 5;
        }
        else if($myUser == 1)
        {
            $inicio -= 1; $fim += 4;
        }
        else if($myUser == $qtdUsers - 1)
        {
            $inicio -= 4; $fim += 1;
        }
        else if($myUser == $qtdUsers - 2)
        {
            $inicio -= 3; $fim += 2;
        }
        else
        {
            $inicio -= 2; $fim += 3;
        }

        $ret = array();
        for($i = $inicio; $i < $fim; $i++) $ret[] = $users[$i];

        return $ret;
    }
}
?>