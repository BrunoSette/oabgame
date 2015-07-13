<?php

class Anuncios {

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