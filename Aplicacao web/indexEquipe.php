<?php
include("orm.php");

// $datas = $database->select("equipe", ["id", "Nome"]);


?>
<?php include("header.php") ?>

<h4 align="center">Cadastrar Equipe</h4>

<div class="row">

	<form id="formId">
		<div class="form-group">
			<label for="exampleInputEmail1">Informe o nome da equipe</label>
			<input type="text" class="form-control" id="exampleInputEmail1" name="nome">
		</div>
		<button onclick="cadastrar()" class="btn btn-primary">Cadastrar</button>
		<!-- <button class="btn btn-primary">Próximo</button> -->
	</form>

</div>
<br>

<?php include("footer.php") ?>

<script>
	let url = "inserirEquipe.php";

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