<?php

//html
?>


<!DOCTYPE html>
<html>
<head>
	<title>Estudios</title>
	<link rel="stylesheet" type="text/css" href="../css/fondo.css">
</head>
<body>

	<h1>Estudios</h1>


	<table>
		<tr><th>Nombre</th><th>Descripción</th><th>Precio</th><th></th></tr>

		<?php foreach($this->estudios as $e) { ?>
		<tr><td><?= $e['nom_estudio'] ?></td> <td><?= $e['desc_estudio'] ?></td><td><?= $e['precio'] ?></td><td><a href="SacarTurnoEstudio.php?id=<?= $e['estudio_id'] ?>">Sacar Turno</a></td></tr>
		<?php } ?>

	</table>
	<a href="./MenuPrincipalPaciente.php"><button>Volver</button></a>
</body>
</html>

