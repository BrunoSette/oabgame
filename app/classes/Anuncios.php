<?php

class Anuncios {

    /*
    * Verifica se o usuário já verificou um determinado anuncio [constante por enquanto]. Se visualizou true, cc false
    * @return bool
    * @date 26/12
    */
    public function get_user_anuncio()
    {
        $sql = "SELECT qtd_acessos FROM tb_usuario WHERE (id = ?)";
        $stmt = DB::prepare($sql);
        $stmt->execute(array($_SESSION['FBID']));

        $res = $stmt->fetch();

        if($res->qtd_acessos > 1)
        {
            $sql = "SELECT * FROM tb_anuncios_usuario WHERE (id_usuario = ? AND id_anuncio = ?)";
            $stmt = DB::prepare($sql);
            $stmt->execute(array($_SESSION['FBID'], 1));

            $res = $stmt->fetch();

            if ($res)
            {
                return true;
            }
            else
            {
                $usuario = $_SESSION['FBID'];
                $sql = "INSERT INTO tb_anuncios_usuario (id_usuario, id_anuncio)  VALUES ('$usuario',  1) ";
                $stmt = DB::query($sql);

                return false;
            }
        }

        return true;
    }

    /*
    * Cadastra opinião do usuário na enquete
    * @return object
    * @date 26/12
    */
    public function post_register($params)
    {
        $usuario = $_SESSION['FBID'];

        $sql = "INSERT INTO tb_enquete (id_usuario, resposta, comentario)  VALUES 
                ('$usuario',
                '$params->ans',
                '$params->comment') ";
    
        $stmt = DB::query($sql);

        return $params;
    }

    /*
    * Verifica se é o primeiro acesso do dia do usuário
    * @return bool
    * @date 30/12
    */
    public function get_dia_acesso()
    {
        $sql = "SELECT ultimo_acesso FROM tb_usuario WHERE (id = ?)";
        $stmt = DB::prepare($sql);
        $stmt->execute(array($_SESSION['FBID']));

        $res = $stmt->fetch();

        $date = explode("-", $res->ultimo_acesso);
        $today = explode("/", date("Y/m/d"));

        $newToday = "$today[0]-$today[1]-$today[2]";

        if ($date[0] != $today[0] || $date[1] != $today[1] || $date[2] != $today[2])
        {
            // atualiza a pontução do usuário e data do ultimo acesso
            $sql = "UPDATE tb_usuario SET pontuacao = pontuacao + 10, ultimo_acesso = '$newToday' WHERE email = '".$_SESSION["EMAIL"]."'";
            $_SESSION['PONTUACAO'] += 10;
            $stmtUsuario = DB::query($sql);

            return true;
        }

        return false;
    }
}

?>