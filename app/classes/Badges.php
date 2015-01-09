<?php

class Badges {

    public function post_concede_badge($params)
    {
        $usuario = $_SESSION['FBID'];

        $sql = "INSERT INTO tb_badges_usuario (usuario, badge) 
                VALUES 
                (
                    " . $usuario . ", 
                    " . $params->badge . "
                ) ";

        $stmtUsuario = DB::query($sql);

        return true;
    }
}

?>