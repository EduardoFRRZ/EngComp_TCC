<?php

?>

<?php include("header.php") ?>
<div class="container">
	<form class="p-5" method="POST" action="loginPost.php">

		<p class="h4 mb-4 text-center">Login</p>

		<input type="text" autocomplete="username" name="username" class="form-control mb-4" placeholder="Usuário">

		<input type="password" autocomplete="current-password" name="password" class="form-control mb-4" placeholder="Senha">

		<!-- <div class="d-flex justify-content-between">
			<div>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
					<label class="custom-control-label" for="defaultLoginFormRemember">Remember me</label>
				</div>
			</div>
			<div>
				<a href="">Forgot password?</a>
			</div>
		</div> -->

		<button class="btn btn-info btn-block my-4" type="submit">Login</button>

		<div class="text-center">
			<p>ou registre-se <a href="register.php">aqui</a></p>

		</div>

	</form>
</div>

<?php include("footer.php") ?>