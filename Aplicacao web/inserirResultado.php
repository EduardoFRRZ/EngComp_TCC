<?php
include_once("orm.php");
$_POST = json_decode(file_get_contents('php://input'), true);

$arco_1 = $_POST['arco_1'];
$arco_2 = $_POST['arco_2'];
$placa = $_POST['placa'];
$golf = $_POST['golf'];
$cronometro = $_POST['cronometro'];
$equipe_id = $_POST['equipe_id'];
$campeonato_id = $_COOKIE['campeonatoId'];
$campeonato_juiz_id = $_COOKIE['campeonato_juiz_id'];

$s = $database->insert("resultados", [
    "arco_1" => $arco_1, "arco_2" => $arco_2, "placa" => $placa,
    "golf" => $golf, "cronometro" => $cronometro, "equipe_id" => $equipe_id,
    "campeonato_id" => $campeonato_id, "campeonato_juiz_id" => $campeonato_juiz_id
]);

$s->rowCount();

// $redirect = "http://localhost:8000/";
// header("location:$redirect");
