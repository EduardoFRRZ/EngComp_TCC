<?php

include_once("orm.php");

$nome = $_POST['nome'];

$s = $database->insert("equipe", ["Nome" => $nome]);
$redirect = "http://localhost:8000/inserirEquipe.php";
// header("location:$redirect");
