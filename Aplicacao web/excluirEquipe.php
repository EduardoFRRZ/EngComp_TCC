<?php

	include_once("orm.php");

	// $nome = $_POST['nome'];
	
	$database->delete("equipe", [ "AND" => [
		"id[>]" => 0
	]]);
	
	// $redirect = "http://localhost:8000/";
 	// header("location:$redirect");
