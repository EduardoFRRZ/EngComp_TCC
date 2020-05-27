<?php

	include("consulta.php");

	// while($dado = $con->fetch_array()){

	// 	$id = $dado["Id"];
	//	$nome = $dado["Nome"];
	//	$inicio = $dado["Inicio"];
	//	$fim = $dado["Fim"];
	//	$ferias = $dado["Ferias"];
	//	$nivel = $dado["Nivel"];
	//	$uid = $dado["uid"];
	 //}
	$ruid = $_GET['uid'];
	$consulta = "select * from funcionarios where uid ='$ruid'";
	$con = $mysqli->query($consulta) or die($mysqli->error);

	$dado = $con->fetch_array();

	$id = $dado["Id"];
	$nome = $dado["Nome"];
	$inicio = $dado["Inicio"];
	$fim = $dado["Fim"];
	$ferias = $dado["Ferias"];
	$nivel = $dado["Nivel"];
	$uid = $dado["uid"];

	date_default_timezone_set('America/Sao_Paulo');
    $horaCorrente = date('H:i:s', time());

    //if ($horaCorrente > $inicio && $horaCorrente < $fim ) {
		
		if($ferias == 0){
			$retorno = $nivel;
		}else{
			$retorno = 0;
		}	

	//}else{
	//		$retorno = 0;
	//}

	echo $retorno;

	//echo retorna($horaCorrente, $inicio, $fim);

	//echo $nome;

	



///////////////////////////////////////////////////////////

	function retorna($horaCorrente, $inicio, $fim){

		if ($horaCorrente > $inicio && $horaCorrente < $fim ) {
			
			if($ferias == 0){
				$retorno = $nivel;
			}

		}else{
			$retorno = 0;
		}

		return $retorno;
	}

	
?>