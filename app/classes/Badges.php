<?php

class Badges {

    public function post_concede_badge($params)
    {
        $usuario = $_SESSION['FBID'];

        $sql = "SELECT * FROM `tb_badges_usuario` WHERE `badge` = $params->badge AND `usuario` = $usuario ";
        $stmt = DB::prepare($sql);
        $stmt->execute();

        $res = $stmt->fetch();

        if (!$res)
        {
            $sql = "INSERT INTO tb_badges_usuario (usuario, badge) 
                VALUES 
                (
                    " . $usuario . ", 
                    " . $params->badge . "
                ) ";

            $stmtUsuario = DB::query($sql);

            return true;
        }

        return false;
    }
}

?>