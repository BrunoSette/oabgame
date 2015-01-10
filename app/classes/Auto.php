<?php

class Auto {

    private function toUpper($var)
    {
        return str_replace('\' ', '\'', ucwords(str_replace('\'', '\' ', strtolower($var))));
    }

    public function post_cadastra_tudo_infusion()
    {
        $sql = "SELECT nome, email, localizacao FROM tb_usuario";
        $stmt = DB::prepare($sql);
        $stmt->execute();

        echo "<pre>";

        while($res = $stmt->fetch())
        {   
            $params = array( "nome" => $res->nome,
                         "email" => $res->email,
                         "localizacao" => $res->localizacao
                       );

            cadastrarInFusion($params);
        }
    }

    public function post_edita_nome()
    {
        $sql = "SELECT nome, email FROM tb_usuario";
        $stmt = DB::prepare($sql);
        $stmt->execute();

        while($res = $stmt->fetch())
        {   
            $nome = explode(" ", $res->nome);

            $novoNome = "";
            $limit = count($nome);

            for ($i= 0; $i < $limit; $i++)
            { 
                $novoNome .= $this->toUpper($nome[$i]);

                if ($i != $limit - 1)
                    $novoNome .= " ";
            }

            $sql = "UPDATE tb_usuario SET nome = '$novoNome' WHERE email = '$res->email'";
            $stmtUsuario = DB::query($sql);
        }
    }

    public function post_faceId()
    {
        $sql = "SELECT foto_profile, email FROM tb_usuario";
        $stmt = DB::prepare($sql);
        $stmt->execute();

        echo "<pre />";

        while($res = $stmt->fetch())
        {   
            $id = explode("/", $res->foto_profile);
            $id = intval($id[3]);
            
            $sql = "UPDATE tb_usuario SET face_id = $id WHERE email = '$res->email'";
            $stmtUsuario = DB::query($sql);
        }

        return true;
    }

    public function get_user()
    {
        return $_SESSION;
    }
}

?>