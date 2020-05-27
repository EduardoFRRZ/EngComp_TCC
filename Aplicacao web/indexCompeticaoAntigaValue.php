<?php
include("orm.php");

$login_cookie = $_COOKIE['login'];
$campeonatoId = $_GET['id'];


$campeonatos = $database->select(
	"campeonato",
	"*",
	["AND" => [
		"juiz_id" => $login_cookie
	]]
);

$resultados = $database->select(
	"resultados",
	"*",
	["AND" => [
		"campeonato_juiz_id" => $login_cookie,
		"campeonato_id" => $campeonatoId
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
				<option value=" <?php echo ($campeonato["id"]) ?> ">
					<?php echo ($campeonato["Nome"]) ?>
				</option>

			<?php	} ?>
		</select>
	</div>

	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Arco 1</th>
				<th scope="col">Arco 2</th>
				<th scope="col">Placa</th>
				<th scope="col">Golf</th>
				<th scope="col">Cronômetro</th>
				<th scope="col">Equipe</th>
				<th scope="col">Campeonato</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($resultados as $resultado) { ?>
				<tr>

					<th scope="row"><?php echo $resultado["id"]; ?></th>
					<td><?php echo $resultado["arco_1"]; ?></td>
					<td><?php echo $resultado["arco_2"]; ?></td>
					<td><?php echo $resultado["placa"]; ?></td>
					<td><?php echo $resultado["golf"]; ?></td>
					<td><?php echo $resultado["cronometro"]; ?></td>
					<td><?php
						$equipe = $database->select(
							"equipe",
							"*",
							["AND" => [
								"id" => $resultado['equipe_id']
							]]
						);
						echo $equipe[0]["Nome"];
						?></td>

					<td><?php
						$campeonato = $database->select(
							"campeonato",
							"*",
							["AND" => [
								"id" => $resultado['campeonato_id']
							]]
						);
						echo $campeonato[0]["Nome"];
						?></td>
				</tr>

			<?php } ?>

		</tbody>
	</table>

</div>
<br>

<?php include("footer.php") ?>

<script>
	let url = "indexCompeticaoAntigaValue.php";

	function navigateTo(e) {
		window.location.href = url + "?id=" + e.value;
	}
</script>