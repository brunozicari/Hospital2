<?php

//html
?>


<!DOCTYPE html>
<html>
<head>
	<title>Nuestros Profesionales</title>
	<link rel="stylesheet" type="text/css" href="../css/fondo.css">
</head>
<body>

	<h1>Nuestros Profesionales</h1>


	<table>
		<tr><th>Nombre</th><th>Especialidad</th><th>Horario</th><th>Consultorio</th><th></th><th></th></tr>

		<?php foreach($this->medicos as $m) { ?>
		<tr><td><?= $m['nom_medico'] ?> <?= $m['ape_medico'] ?></td> <td><?= $m['nom_especialidad'] ?></td> <td><?php if($m['horario']=='t') echo("Tarde"); else echo('Mañana'); ?></td> <td><?= $m['consultorio'] ?></td><td><a href="ConsultarAgendaMedico.php?id=<?= $m['dni'] ?>">Consultar Agenda</a></td><td><a href="CambiarConsultorio.php?id=<?= $m['dni'] ?>">Cambiar consultorio</a></td></tr>
		<?php } ?>

	</table>
	<a href="./MenuPrincipalAdministracion.php"><button>Volver</button></a>
</body>
</html>

