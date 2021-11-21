<?php
//html
?>

<!DOCTYPE html>
<html>
<head>
	<title>Estudio</title>
	<link rel="stylesheet" type="text/css" href="../css/fondo.css">
</head>
<body>
<h2>Nuevo estudio:</h2>
<form id="formulario" method="post">
	<label for="nombre">Nombre:</label><br>
	<input type="text" id="nombre" name="nombre" required="required"><br>
	<label for="descripcion">Descripción:</label><br>
	<input type="text" id="descripcion" name="descripcion" required="required"><br>
	<label for="precio">Precio:</label><br>
	<input type="number" id="precio" name="precio" required="required"><br><br>
	<label for="horario">Horario:</label><br>
	<select name="horario" id="horario" required="required">
		<option value="m">Mañana</option>
		<option value="t">Tarde</option>
	</select> 
  <input type="submit" value="Enviar"></input>
</form> 
<br></br>
<table>
	<tr><th>Nombre</th><th>Descripción</th><th>Precio</th><th>Horario</th></tr>

	<?php foreach($this->estudios as $e) { ?>
	<tr><td><?= $e['nom_estudio']?></td> <td><?= $e['desc_estudio']?></td><td><?= $e['precio'] ?></td><td><?php if($e['horario']=='t') echo("Tarde"); else echo('Mañana'); ?></td></tr>
	<?php } ?>
</table>


<br/>
<a href="./MenuPrincipalAdministracion.php"><button>Volver</button></a>

</body>
</html>