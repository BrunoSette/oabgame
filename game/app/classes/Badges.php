<?php

class Badges {

    public function post_concede_badge($params) {
        $usuario = $_SESSION['FBID'];
        
        $stmt = DB::prepare("SELECT * FROM `tb_badges_usuario` WHERE `badge` = $params->badge AND `usuario` = $usuario ");
        $stmt->execute();
        $res = $stmt->fetch();

        // Usuário já possui o badge. return.
        if ($res) return false;

        // Usuario não possui o badge. Atribua badge a ele.
        $sql = "INSERT INTO tb_badges_usuario (usuario, badge) 
            VALUES 
            (
                " . $usuario . ", 
                " . $params->badge . "
            ) ";

        $stmtUsuario = DB::query($sql);

        return true;
    }

    public function post_badge($param)
    {
        $usuario = $_SESSION['FBID'];

        $sql = "SELECT * FROM `tb_badges_usuario` WHERE `badge` = $param->badge AND `usuario` = $usuario ";
        $stmt = DB::prepare($sql);
        $stmt->execute();

        $res = $stmt->fetch();

        if (!$res) return true;

        return false;
    }
}

?>