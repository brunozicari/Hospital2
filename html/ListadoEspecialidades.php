<?php

//html
?>


<!DOCTYPE html>
<html>
<head>
	<title>Nuestras Especialidades</title>
	<link rel="stylesheet" type="text/css" href="../css/fondo.css">
</head>
<body>

	<h1>Seleccione la especialidad Especialidades</h1>
		<?php foreach($this->especialidades as $e) { ?>
		<li><a href="ListadoMedicos.php?especialidad_id=<?= $e['especialidad_id'] ?>"><?= $e['nom_especialidad'] ?></a></li>
		<?php } ?>

	<a href="./MenuPrincipalPaciente.php"><button>Volver</button></a>

</body>
</html>

