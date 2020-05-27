<?php

?>

<?php include("header.php") ?>
<div class="container">
	<form class="p-5" method="POST" action="registerPost.php">

		<p class="h4 mb-4 text-center">Registrar</p>

		<input type="text" autocomplete="username" name="username" class="form-control mb-4" placeholder="Usuário">

		<input type="text" autocomplete="current-password" name="password" class="form-control mb-4" placeholder="Senha">

		<button class="btn btn-info btn-block my-4" type="submit">Registrar</button>
		<div class="text-center">
			<p>ou faça o login <a href="login.php">aqui</a></p>

		</div>

	</form>
</div>

<?php include("footer.php") ?>