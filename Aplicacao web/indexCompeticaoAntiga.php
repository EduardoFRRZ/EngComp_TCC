<?php
include("orm.php");

$login_cookie = $_COOKIE['login'];

$campeonatos = $database->select(
	"campeonato",
	"*",
	["AND" => [
		"juiz_id" => $login_cookie
	]]
);


?>
<?php include("header.php") ?>

<h4 align="center">Consultar Competição Antiga</h4>

<div class="row">

	<div class="form-group">
		<label for="exampleFormControlSelect1">Selecione a competição</label>
		<select class="form-control" id="exampleFormControlSelect1" onchange="navigateTo(this)">
			<option selected disabled>Choose here</option>

			<?php foreach ($campeonatos as $campeonato) { ?>
				<option value="<?php echo ($campeonato["id"]) ?>">
					<?php echo ($campeonato["Nome"]) ?>
				</option>

			<?php	} ?>
		</select>
	</div>

</div>
<br>

<?php include("footer.php") ?>

<script>
	let url = "indexCompeticaoAntigaValue.php";

	function navigateTo(e) {
		window.location.href = url + "?id=" + e.value;

	}
</script>