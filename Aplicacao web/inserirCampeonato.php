<?php

	include_once("orm.php");
	$login_cookie = $_COOKIE['login'];

	$nome = $_POST['nome'];
	
	$database->insert("campeonato", [ "Nome" => $nome , "juiz_id" => $login_cookie]);
	
	// $redirect = "http://localhost:8000/";
 	// header("location:$redirect");
