<?php include_once 'generar_horario.php'; ?>
<html>
<head>
	<meta charset="utf-8">
	<html lang="es">
	<title class="name-group"><?php print strtoupper($horario->getNombre()); ?></title>
	<link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body>
	<div class="container" style="margin-top: 20px; padding-top: 20px; ">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-sm table-striped">
				<caption class="name-group">Horario <?php print strtoupper($horario->getNombre()); ?></caption>
				<thead class="thead-light">
					<tr>
						<th scope="col" style="width: 15%;">Materia</th>
						<th scope="col" style="width: 15%;">Profesor</th>
						<th scope="col" style="width: 10%;">Grupo</th>
						<th scope="col">Lunes</th>
						<th scope="col">Martes</th>
						<th scope="col">Miercoles</th>
						<th scope="col">Jueves</th>
						<th scope="col">Viernes</th>
						<th scope="col">Sabado</th>
					</tr>
				</thead>
				<tbody>
					<?php print($horario->mostrar()); ?>
				</tbody>
			</table>

		</div>
	</div>
	<script src="js/jquery-3.3.1.js" ></script>
	<script src="js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>