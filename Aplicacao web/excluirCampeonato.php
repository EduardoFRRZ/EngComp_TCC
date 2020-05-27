<?php

	include_once("orm.php");

	// $nome = $_POST['nome'];
	
	$database->delete("campeonato", [ "AND" => [
		"id[>]" => 0
	]]);
	
	// $redirect = "http://localhost:8000/";
 	// header("location:$redirect");
