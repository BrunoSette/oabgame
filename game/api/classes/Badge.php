<?php
	
class Badge
{
	public static function insertBadge($id, $badge)
    {
        $stmt = DB::prepare("SELECT count(id) AS results FROM tb_badges_usuario WHERE usuario = :user AND badge = :badge");
        $stmt->bindParam("user", $id);
        $stmt->bindParam("badge", $badge);
        $stmt->execute();

        $hasBadge = false;
        if(((int)$stmt->fetch()->results) > 0) $hasBadge = true;

        if(!$hasBadge)
        {
            $today = DB::dateToMySql(date("Y/m/d"));

            $stmt = DB::prepare("INSERT INTO tb_badges_usuario (usuario, badge, data)VALUES (?, ?, ?)");
            $stmt->execute(array($id, $badge, $today));

            return true;
        }
        else
            return false;
    }

    public static function all()
    {
        
    }
}

?>