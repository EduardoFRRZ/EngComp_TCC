<?php
include("orm.php");

$login_cookie = $_COOKIE['login'];
$campeonatoId = $_GET['id'];
setcookie("campeonatoId", $campeonatoId);
setcookie("campeonato_juiz_id", $login_cookie);


$equipes = $database->select(
	"equipe",
	"*"
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

<h4 align="center">Área de competição</h4>

<div class="row">

	<div class="form-group">
		<label for="exampleFormControlSelect1">Selecione a equipe a participar</label>
		<div class="row">
			<div class="col">
				<select class="form-control" id="exampleFormControlSelect1" onchange="btnEnable()">
					<option selected disabled>Selecione</option>

					<?php foreach ($equipes as $equipe) { ?>
						<option value=" <?php echo ($equipe["id"]) ?> ">
							<?php echo ($equipe["Nome"]) ?>
						</option>

					<?php	} ?>
				</select>
			</div>
			<div class="row">

				<button id="btnStart" class="btn btn-primary " type="button" onclick="start()" disabled>
					<span id="bntSpan" hidden class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
					Start
				</button>
			</div>
		</div>
	</div>

	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Arco 1</th>
				<th scope="col">Arco 2</th>
				<th scope="col">Placa</th>
				<th scope="col">Golf</th>
				<th scope="col">Cronômetro (ms)</th>
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








	<!-- <form id="formId">
		<div class="form-group">
			<label for="exampleInputEmail1">Informe o nome da equipe</label>
			<input type="text" class="form-control" id="exampleInputEmail1" name="nome">
		</div>
		<button onclick="cadastrar()" class="btn btn-primary">Cadastrar</button>
		<button class="btn btn-primary">Próximo</button> -->
	<!-- </form>  -->

</div>
<br>

<?php include("footer.php") ?>


<!-- <script src="pahojs/paho-mqtt.js" type="text/javascript"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.js" type="text/javascript"></script>


<script>
	let topicPubArco1 = "tcc/drone/arco1";
	let topicPubArco2 = "tcc/drone/arco2";
	let topicPubPlaca = "tcc/drone/placa";
	let topicPubGolf = "tcc/drone/golf";
	let topicPubCronometro = "tcc/drone/cronometro";

	let data = {
		arco_1: undefined,
		arco_2: undefined,
		placa: undefined,
		golf: undefined,
		cronometro: undefined,
		equipe_id: undefined
	}

	function conn() {
		console.log('conn');

		let client = new Paho.MQTT.Client("broker.mqttdashboard.com", Number(8000), "/mqtt", "edu"); // link do broker

		client.onMessageArrived = function(message) {
			let attribute;
			if (message.destinationName == topicPubArco1)
				attribute = 'arco_1';
			if (message.destinationName == topicPubArco2)
				attribute = 'arco_2';
			if (message.destinationName == topicPubPlaca)
				attribute = 'placa';
			if (message.destinationName == topicPubGolf)
				attribute = 'golf';
			if (message.destinationName == topicPubCronometro)
				attribute = 'cronometro';

			data[attribute] = message.payloadString;
			if (attribute != 'cronometro')
				data[attribute] = message.payloadString == "OK";

			// console.log("Message Arrived: " + message.destinationName + " > " + message.payloadString, data);

			let condicao = data.arco_1 != undefined && data.arco_2 != undefined && data.placa != undefined && data.golf != undefined && data.cronometro != undefined && data.equipe_id != undefined

			if (condicao) {
				console.log(data);

				inserir();
			}
		}

		client.onConnectionLost = function(responseObject) {
			console.log("Connection Lost: " + responseObject.errorMessage);
		}

		// Called when the connection is made
		function onConnect() {
			console.log("Connected!");
			client.subscribe("tcc/drone/#");
		}

		// Connect the client, providing an onConnect callback
		client.connect({
			onSuccess: onConnect
		});
	}

	function inserir() {

		fetch('inserirResultado.php', {
			method: 'post',
			body: JSON.stringify(data)
		}).then(function(response) {
			console.log(response);
			location.reload();
		}).then(function(data) {
			console.log(data);
		});
	}

	function start() {
		var e = document.getElementById("exampleFormControlSelect1");
		var equipeId = e.options[e.selectedIndex].value;
		data.equipe_id = equipeId;

		conn(); //Aqui se conecta ao broker para receber as informações
		console.log('click');

		document.getElementById("bntSpan").hidden = false;
	};

	function btnEnable() {
		document.getElementById('btnStart').disabled = false;
	}
</script>