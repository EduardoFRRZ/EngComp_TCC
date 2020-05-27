<?php
include("orm.php");

$datas = $database->select("campeonato", ["id", "Nome"]);
?>

<?php include("header.php") ?>

<h4 align="center">Cadastrar Competição</h4>

<div class="row">

	<form id="formId">
		<div class="form-group">
			<label for="exampleInputEmail1">Informe o nome da competição</label>
			<input type="text" class="form-control" id="exampleInputEmail1" name="nome">
		</div>
		<button onclick="cadastrar()" type="submit" class="btn btn-primary">Cadastrar</button>
	</form>

</div>


<?php include("footer.php") ?>

<script>
	let url = "inserirCampeonato.php";

	$("#formId").submit(function(e) {
		e.preventDefault();
	});

	function cadastrar() {
		var form = new FormData(document.getElementById('formId'));
		fetch(url, {
			method: "POST",
			body: form
		}).then(res => {
			alert(res.statusText);
			location.reload();
		}).catch(err => {
			console.log(err);
		});
	}
</script>