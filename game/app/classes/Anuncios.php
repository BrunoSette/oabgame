<?php

class Anuncios {

    /*
    * Verifica se é o primeiro acesso do dia do usuário. Caso não haja 
    * usuário logado retorna false.
    * @return bool
    * @date 30/12
    */
    public function get_dia_acesso() {
        if(!isset($_SESSION['FBID']))
            return false;

        $stmt = DB::prepare("SELECT ultimo_acesso FROM tb_usuario WHERE (id = ?)");
        $stmt->execute(array($_SESSION['FBID']));
        $res = $stmt->fetch();

        $date = explode("-", $res->ultimo_acesso);
        $today = explode("/", date("Y/m/d"));

        $newToday = "$today[0]-$today[1]-$today[2]";

        if ($date[0] != $today[0] || $date[1] != $today[1] || $date[2] != $today[2]) {
            // Atualiza a pontução do usuário e data do ultimo acesso
            $stmtUsuario = DB::query("UPDATE tb_usuario SET pontuacao = pontuacao + 10, ultimo_acesso = '$newToday' WHERE email = '".$_SESSION["EMAIL"]."'");

            return true;
        }

        return false;
    }
}

?>