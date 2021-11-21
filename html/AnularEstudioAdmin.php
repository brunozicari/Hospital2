<?php

//html
?>


<!DOCTYPE html>
<html>
<head>
	<title>Anular Estudio</title>
	<link rel="stylesheet" type="text/css" href="../css/fondo.css">
	<link rel="stylesheet" type="text/css" href="../css/paciente.css">
</head>
<body>

	<h1>¿Está seguro de que desea anular el estudio?</h1>
	<li>Estudio: <?= $this->estudio['nom_estudio'] ?></li>
	<li>Descripción: <?= $this->estudio['desc_estudio'] ?></li>
	<li>Paciente: <?= $this->paciente ?></li>
	<li>Dia: <?= date("d-m-Y",strtotime($this->turno['fecha'])) ?></li>
	<li>Hora: <?= date("H:i",strtotime($this->turno['hora'])) ?></li>
    <a href="./AnularTurno.php?id=<?= $this->turno['turno_id'] ?>"><button>Anular</button></a>
	<a href="./VolverAlMenuPrincipal.php"><button>Cancelar</button></a>
</body>
</html>

