<?php include("header.php") ?>

<?php
include("orm.php");

$login_cookie = $_COOKIE['login'];

$datas = $database->select(
	"campeonato",
	"*",
	["AND" => [
		"juiz_id" => $login_cookie
	]]
);


?>


<h4 align="center">Nova Competição</h4>

<div class="row">

	<div class="form-group">
		<label for="exampleFormControlSelect1">Selecione o Campeonato</label>
		<select class="form-control" id="exampleFormControlSelect1" onchange="navigateTo(this)">
			<option selected disabled>Selecione</option>

			<?php foreach ($datas as $data) { ?>
				<option value="<?php echo ($data["id"]) ?>">
					<?php echo ($data["Nome"]) ?>
				</option>

			<?php	} ?>
		</select>
	</div>

</div>
<br>

<?php include("footer.php") ?>

<script>
	let url = "indexNovaCompeticaoValue.php";

	function navigateTo(e) {
		window.location.href = url + "?id=" + e.value;

	}

	// $('#exampleFormControlSelect1').change(function() {
	// 	var value = $(this).val();
	// 	window.location.href = url + "/" + value;
	// });
</script>