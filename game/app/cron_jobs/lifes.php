<?php
require '../config.php';
require '../DB.php';

date_default_timezone_set("Brazil/East");

$rightNow = date("Y-m-d H:i:s"); 

$stmtUsuario = DB::query("UPDATE tb_usuario SET qtd_vidas = qtd_vidas + 1, ultima_vida = '" . $rightNow ."' WHERE qtd_vidas < 3");
$stmtLog = DB::query("INSERT INTO tb_vidas_cron (hora) VALUES ('".$rightNow ."')");
if(!$stmtLog) die(mysql_error());

// criando um log

$file = fopen("log.txt", "a+");
$text = "Concedendo vidas aos usuarios às: " . date("Y-m-d H:i:s") . "\n";
fwrite($file, $text);
fclose($file);

?>