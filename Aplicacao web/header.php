<?php

try {
	if (isset($_COOKIE['login']))
		$login_cookie = $_COOKIE['login'];

	$url = $_SERVER['REQUEST_URI'];
	$isLoginOrRegister = strpos($url, "/login.php") !== false || strpos($url, "/register.php") !== false;
	$isIndex = $url == "/index.php";

	if ($isLoginOrRegister == false && isset($login_cookie) == false)
		header("Location:login.php");

	if ($isLoginOrRegister == true && isset($login_cookie) == true)
		header("Location:index.php");
} catch (Exception $e) {
	$er = $e->getMessage();
	header("Location:login.php");
}

?>

<!DOCTYPE html>
<html>

<head>
	<!-- <meta charset="utf-8">
		<title>Conexão com Banco</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<meta charset="utf-8">
	<title>CCDC</title>
</head>

<body>

	<!-- <body background="img/fundo.jpg"> -->

	<!-- Image and text -->
	<!-- <nav class="navbar navbar-light bg-danger">
  			<a class="navbar-brand" href="#">
    			<img src="img/logo.png" width="70" height="30">
    			<span>Computerized Control for Drone Competition (CCDC).</span> 
			  </a>
		</nav>
		 -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="navbar-nav">
			<?php
			if ($isLoginOrRegister == false) {
				echo ("<a class='nav-item nav-link active' href='index.php'>Home <span class='sr-only'>(current)</span></a>");
				echo ("<a class='nav-item nav-link' href='indexEquipe.php'>Equipe</a>");
				echo ("<a class='nav-item nav-link' href='indexCampeonato.php'>Competição</a>");
				echo ("<a class='nav-item nav-link' onclick='logout()' href='#'>Sair</a>");
			}
			?>
			<?php
			if ($isLoginOrRegister == true) {
				echo ("<div class='navbar-brand navbar-right' href='#'>");
				echo ("<img src='img/logo.png' width='70' height='30'>");
				echo ("<span>Computerized Control for Drone Competition (CCDC).</span></div>");
			}
			?>
			
		</div>
	</nav>

	<br>

	<script>
		function logout() {
			deleteCookie('login');
			location.reload();
		}

		function deleteCookie(cname) {
			var d = new Date(); //Create an date object
			d.setTime(d.getTime() - (1000 * 60 * 60 * 24)); //Set the time to the past. 1000 milliseonds = 1 second
			var expires = "expires=" + d.toGMTString(); //Compose the expirartion date
			window.document.cookie = cname + "=" + "; " + expires; //Set the cookie with name and the expiration date

		}
	</script>
	<div class="container">