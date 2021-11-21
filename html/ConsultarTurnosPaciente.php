<?php
//html
?>

<!DOCTYPE html>
<html>
<head>
	<title>Consulta de Turnos</title>
	<link rel="stylesheet" type="text/css" href="../css/fondo.css">
</head>
<body>
<h1>Próximos turnos para: <?= $this->usuario['nombre']?> <?= $this->usuario['apellido']?></h1>
<br/>
	<table>
		<tr><th>Fecha</th><th>Hora</th><th>Profesional</th><th>Consultorio</th><th></th></tr>

		<?php foreach($this->turnos as $t) { ?>
		<tr><td><?= date("d-m-Y", strtotime($t['fecha']))?></td> <td><?= date("H:i", strtotime($t['hora']))?></td><td><?= $t['nombre'] ?> <?= $t['apellido'] ?></td><td><?= $t['consultorio'] ?></td><td><a href="./ConfirmarAnulacionTurno.php?id=<?= $t['turno_id'] ?>">Anular Turno</a></td></tr>
		<?php } ?>
	</table>

<h1>Próximos estudios para: <?= $this->usuario['nombre']?> <?= $this->usuario['apellido']?></h1>
<br/>
	<table>
		<tr><th>Fecha</th><th>Hora</th><th>Estudio</th><th></th></tr>

		<?php foreach($this->estudios as $e) { ?>
		<tr><td><?= date("d-m-Y", strtotime($e['fecha']))?></td> <td><?= date("H:i", strtotime($e['hora']))?></td><td><?= $e['nom_estudio'] ?></td><td><a href="./ConfirmarAnulacionEstudio.php?id=<?= $e['turno_id'] ?>">Anular Turno</a></td></tr>
		<?php } ?>
	</table>


<a href="./CerrarSesion.php"><button>Cerrar Sesión</button></a>

<a href='./MenuPrincipalAdministracion.php'><button>Volver al Menú Principal</button></a>
</body>
</html>
